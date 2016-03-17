<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

class OrdersController extends AppController  {
  var $uses = array('Order','Direccion', 'Producto', 'Banco', 'OrderDetail', 'Envio', 'Carrito', 'Notificacion', 'Tienda','OrderDetailAttr', 'Metodotdc', 'Metodotransferencia');
  public $components = array('Paginator');

  public function checkout()
  {
    CakeSession::delete('precheckoutdata');
    //Consultar si el usuario tiene direccion (enviar a la vista)
    $actualUser = $this->viewVars['actualUser']; 
    $ds_direcciones = $this->Direccion->verificarDireccion($actualUser['Usuario']['id']);  
    $productos_ids =  $this->Session->read('checkout'); //array('27' => 3, '25' => 2, '30' => '4'); 
  
    if(empty($productos_ids))
    {
      return $this->redirect(array('controller' => 'carritos', 'action' => 'view_cart', 'cart'));
    }
    else
    {
      //trae productos
      $ds_productos_tiendas = $this->Producto->getProductosCheckout($productos_ids);
      //$this->log($ds_productos_tiendas);
      $ds_productos = $ds_productos_tiendas[0];
      $ds_tiendas_nocourier = $ds_productos_tiendas[1];
      //agrega factor de mult de courier
      $ds_tiendas = $this->Order->addCantCourier($ds_tiendas_nocourier, $ds_productos);
      //$this->log($ds_tiendas);
      $subtotal = $ds_productos_tiendas[2];
      
      //se suma la cantidad de productos a comprar para guardar en la tabla order
      $sumaCantidadProductos = 0;
      foreach ($productos_ids as $cant_productos) 
      {
        $sumaCantidadProductos = $sumaCantidadProductos  + $cant_productos;
      }
    }
  
    //El parametro 'formCheckout' es recibido a traves del formulario en la vista checkout, de esta manera se 
    //sabe cuando el 'post' viene desde la vista 'checkout' y no de la vista 'view_cart'
    if ($this->request->is('post') && isset($this->request->data['Order']['formCheckout']))
    {
     // $this->log($this->request->data);
      $validaciones_ok = false;
      //validaciones, primero se comprueba que alguna direccion fue seleccionada, luego, 
      //si se cambia el parametro por html en el navegador no se permitira el guardado
      if(isset($this->request->data['Direccion'])) 
      {
        foreach ($ds_direcciones as $direccion) 
        {
          if($this->request->data['Direccion']['id'] == $direccion['Direccion']['id'])
          {
           $validaciones_ok = true;
          }
        }
      }    
      
      //luego se valida los radiobuttons de los courier, se compara el numero de tiendas con el numero
      //de radiobutton seleccionados
      if(!($validaciones_ok && isset($this->request->data['Courier']) && count($ds_tiendas) == count($this->request->data['Courier'])))
      {
        $validaciones_ok = false;
      }

      if($validaciones_ok)
      {
        $this->request->data['Subtotal'] = $subtotal;
        $this->request->data['SumaCantidadProductos'] = $sumaCantidadProductos;

        $ds = $this->request->data['Courier'];
        $totalEnvio = 0;
        foreach ($ds as $key => $courier) 
        {
          //organizar array de envios courier y tienda
          //La info de radiobuttom viene de la forma [tienda_id] = costo-courier
          //[34] = 100-MRW
          $courierData = explode("-", $courier);
          $envio[] = array('tienda_id' => $key,
                            'costoenvio' => $courierData[0],
                            'courier' => $courierData[1]);

          $totalEnvio = $courierData[0] + $totalEnvio;
        }

        $this->request->data['dsProducts'] = $ds_productos;
        $this->request->data['dsEnvio'] = $envio;
        $this->request->data['totalEnvio'] = $totalEnvio;
        $this->request->data['ds_tiendas']= $ds_tiendas;
        
        CakeSession::write('precheckoutdata', $this->request->data);    
        $this->redirect(array('action' => 'place_order'));        
      }
      else
      {
        $this->Session->setFlash(__('Por favor selecciona una dirección y un courier para realizar el envio por tienda.', true), 'flash_bad');
      }
    }

    $this->set(compact('ds_direcciones','ds_productos', 'ds_tiendas', 'bancos', 'subtotal'));
  }

  function place_order()
  {
    $this->layout = 'payment';
  	$precheckoutdata = $this->Session->read('precheckoutdata');
  	$subtotal = $precheckoutdata['Subtotal'];
  	$dsEnvios = $precheckoutdata['dsEnvio'];
  	$totalenvio = $precheckoutdata['totalEnvio'];
  	$ds_tiendas = $precheckoutdata['ds_tiendas'];
  	$total = $subtotal + $totalenvio;
  	$direccion_id = $precheckoutdata['Direccion']['id'];
  	$actualUser = $this->viewVars['actualUser'];
  	$items = $precheckoutdata['SumaCantidadProductos'];
  	$ds_productos = $precheckoutdata['dsProducts'];
  	//leyendo sesion atributos
  	$atributosdata = $this->Session->read('atributos'); 
    $validaciones_ok = false;
    $doCommit = false;
   
  	$this->set(compact('subtotal', 'total', 'totalenvio', 'items'));
  }
 
  function store_pay_order()
  {
  	$this->autoRender = false;
  	$this->response->type('json');
  	$precheckoutdata = $this->Session->read('precheckoutdata');
  	$subtotal = $precheckoutdata['Subtotal'];
  	$dsEnvios = $precheckoutdata['dsEnvio'];
  	$totalenvio = $precheckoutdata['totalEnvio'];
  	$ds_tiendas = $precheckoutdata['ds_tiendas'];
  	$total = $subtotal + $totalenvio;
  	$direccion_id = $precheckoutdata['Direccion']['id'];
  	$actualUser = $this->viewVars['actualUser'];
  	$items = $precheckoutdata['SumaCantidadProductos'];
  	$ds_productos = $precheckoutdata['dsProducts'];
  	//leyendo sesion atributos
  	$atributosdata = $this->Session->read('atributos');
  	$validaciones_ok = false;
  	$doCommit = false;
  
  	if ($this->request->is(array('post', 'put')))
  	{
  		//Viene por TDC
  		if(isset($this->request->data['OrderTDC']))
  		{
  			//Validar form
  			$validaciones_ok = true;
  			$metododePago = 'Instapago';
  			$order_status_pago = '1'; // 0: por aprobar 1: confirmada
  			$envio_status_pago = '2'; // 1: por aprobar 2: confirmado
  		}
  		elseif (isset($this->request->data['OrderTransferencia'])){
  			//Validar form
  			$validaciones_ok = true;
  			$metododePago = 'Transferencia';
  			$order_status_pago = '0';
  			$envio_status_pago = '1';
  		}
  
  		if($validaciones_ok)
  		{
  			$dataSource = $this->Order->getDataSource();
  			$dataSource->begin();
  
  			$dataOrderandRelations = $this->Order->preparardataOrder($actualUser['Usuario']['id'], $direccion_id, $items, $total, $ds_productos, $dsEnvios, $atributosdata, $order_status_pago, $envio_status_pago);
  
  			if($dataOrderandRelations)
  			{
  				if($metododePago == 'Instapago')
  				{
  					//Call Instapago
  					$procesadoInstapago = $this->Order->procesa_instapago($this->Order->id, $this->request->data, $total);
  
  					if($procesadoInstapago['correcto'])
  					{
  						$doCommit = true;
  						$data = array('valor' => 1, 'mensaje' => '');
  					}
  					else
  					{
  						//Si falla la transaccion de instapago por cualquier causa, hacemos rollback
  						$dataSource->rollback();
  						$this->log(array(
  								'Error' => 'Fallo Instapago',
  								'Lugar' => 'Orders::place_order',
  								'procesadoInstapago' => $procesadoInstapago,
  								'Fecha' => Ahora()
  						));
  						$data = array('valor' => 0, 'mensaje' => $procesadoInstapago['mensaje']);
  					}
  				}
  				elseif ($metododePago == 'Transferencia')
  				{
  					$metodoTransferencia = array(
  							'order_id' => $this->Order->id,
  							'banco_id' => $this->request->data['Order']['banco_id'],
  							'referencia' => $this->request->data['Order']['referencia']);
  
  					$saveMetodoTransferencia = $this->Metodotransferencia->save($metodoTransferencia);
  
  					if($saveMetodoTransferencia)
  					{
  						$doCommit = true;
  						//se envia notificaciones a los administradores si hay que confirmar pago
  						$email = new CakeEmail();
  						$email->config('conexion');
  						$email->template('nuevaorderadmin', 'neworder');
  						$email->emailFormat('html');
  						$email->to('mjcanache@gmail.com');
  						$email->from(array('notificaciones@tiviastore.com' => 'TiviaStore'));
  						$email->subject('Pago nuevo');
  						//$email->viewVars(array('datos' => $evento));
  						$envio_ok = $email->send();
  						$data = array('valor' => 1, 'mensaje' => '');
  					}
  					else
  					{
  						$dataSource->rollback();
  						/*$this->Session->setFlash(__('Ocurrio un error en la compra con transferencia, revise los datos'), 'flash_bad');*/
  						$this->log(array(
  								'Error' => 'Fallo Transferencia',
  								'Lugar' => 'Orders::place_order',
  								'metodoTransferencia' => $metodoTransferencia,
  								'Fecha' => Ahora(),
  								'errorModelo' => $this->Metodotransferencia->validationErrors
  						));
  						$data = array('valor' => 0, 'mensaje' => 'Ocurrio un error en la compra con transferencia, revise los datos');
  
  					}
  
  				}
  				 
  				if($doCommit)
  				{
  					$dataSource->commit();
  					//envio de correo para el comprador
  					$this->Notificacion->insertarNotificacionCorreo('ORDER_CLIENTE', $this->Order->id, $actualUser['Usuario']['login'], null);
  
  					//envio de correo para a los dueños de tiendas
  					foreach ($ds_tiendas as $tienda)
  					{
  						$this->Notificacion->insertarNotificacionCorreo('ORDER_VENDEDOR', $this->Order->id, $tienda['Tienda']['login'], null);
  					}
  
  					//se procede actualizar el carrito
  					$productos_cart_ids =  $this->Session->read('cart');
  					foreach (array_keys($this->Session->read('checkout')) as $producto)
  					{
  						unset($productos_cart_ids[$producto]);
  					}
  					 
  					$this->Carrito->saveProduct($productos_cart_ids, 'cart');
  
  					//se actualizan la cantidad en la tabla de productos
  					$this->Producto->ActualizacionDeProductos($this->Session->read('checkout'));
  					//se elimina la session checkout
  					CakeSession::delete('checkout');
  					CakeSession::delete('precheckoutdata');
  					CakeSession::delete('atributos');
  
  					//Envio a la vista
  					/* $this->Session->setFlash(__('Gracias por tu compra.'), 'flash_good');
  
  					return $this->redirect(array('controller' => 'orders', 'action' => 'myordersclient')); */
  					$data = array('valor' => 1, 'mensaje' => 'Gracias por tu compra.');
  				}
  			}
  		}
  		else
  		{
  			$data = 0;
  			/*$this->Session->setFlash(__('Ocurrio un error en la data del formulario'), 'flash_bad');*/
  			$this->log(array(
  					'Error' => 'No guardo la data de tivia',
  					'Lugar' => 'Orders::place_order',
  					'$dataOrderandRelations' => $dataOrderandRelations,
  					'Fecha' => Ahora()
  			));
  			$data = array('valor' => 0, 'mensaje' => 'Ocurrio un error en la data del formulario');
  		}
  	}
  	//$this->set(compact('data')); // se envia resultado a vista
  	return new CakeResponse(array('body' => json_encode($data))); // Se envia respuesta json para agregar array con valor de respuesta y mensaje y usarlo en las notificaciones
  	//$this->render('/Elements/ajax_data', 'ajax');
  }
  
  /**
  * Dashboard compras realizadas de un usuario.
  **/
  public function myordersclient()
  {
    $this->layout = 'dashboard';
    $actualUser = $this->viewVars['actualUser']; 
    $hide_paginatorcount = '';

    //nueva condicion para el paginador
    $orders_ids = $this->Order->find('list', array('conditions' => array('Order.usuario_id' => $actualUser['Usuario']['id']), 'fields' => array('Order.id'), 'recursive' => -1));

    $conditions = array('Envio.order_id' => $orders_ids);  
    $model = 'Envio';  
    $data = $this->dopaginator($conditions, Configure::read('TIVIA_CONFIG.PAGINADOR.LIMITE'), $model);
    $ds_orders = $this->Order->__findDireccion($data);

    //A la vista
    $options = array('all' => 'Todas', 1 => 'Pago por confirmar', 2 => 'Pago confirmado', 3 => 'En camino', 4 => 'Finalizado', 5 => 'Pago incorrecto');
    $parametros = array('type' => 'get', 'controller' => 'Orders','action' => 'paginationhandler');
    $titulo = 'Ordenes recientes';
    $titulo_estadistica = 'Compras realizadas';
    $leyenda = 'TIVIA_CONFIG.STATUS_ORDERSCLIENT';
 
    $this->set(compact('ds_orders', 'titulo', 'titulo_estadistica', 'leyenda', 'parametros', 'hide_paginatorcount', 'options'));
  }

  /**
  * Dashboard ventas de una tienda.
  **/
  public function myordersstore()
  {
    $this->layout = 'dashboard';
    $actualUser = $this->viewVars['actualUser']; 
    $hide_paginatorcount = '';
    
    $conditions = array('Envio.tienda_id' => $actualUser['Tienda']['id']);  

    if($this->request->is('post') and $this->request->data['Order']['status_orden'] != 'all')
    {
      $conditions = array('Envio.tienda_id' => $actualUser['Tienda']['id'], 'Envio.status_pago' => $this->request->data['Order']['status_orden']);      
      $hide_paginatorcount = 'style ="display: none"';
    }

    $model = 'Envio';
    $data = $this->dopaginator($conditions, Configure::read('TIVIA_CONFIG.PAGINADOR.LIMITE'), $model);
    $ds_orders = $this->Order->__findDireccion($data);
    $ds_orders = $this->Usuario->__findNombresDeCliente($ds_orders);
    //A la vista
    $options = array('all' => 'Todas', 1 => 'Pago por confirmar', 2 => 'Listo para envío', 3 => 'Enviado', 4 => 'Finalizado', 5 => 'Pago incorrecto');
    $parametros = array('controller' => 'Orders','action' => 'myordersstore');
    $titulo = 'Pedidos recientes de ' .$actualUser['Tienda']['nombre'];
    $titulo_estadistica = 'Pedidos recibidos';
    $leyenda = 'TIVIA_CONFIG.STATUS_ORDERSSTORE';
   
    $this->set(compact('ds_orders', 'options', 'titulo', 'titulo_estadistica', 'leyenda', 'parametros', 'hide_paginatorcount'));
  }

  /**
  * Recibe por metodo get y procesa el form/filtro de busqueda del dasboard de compras.
  **/
  function paginationhandler()
  {
    $this->redirectToNamed();
    $this->layout = 'dashboard';
    $actualUser = $this->viewVars['actualUser'];
    $params = $this->params['named'];
    $hide_paginatorcount = '';

    $condicion_previa = $this->Order->find('list', array('conditions' => array('Order.usuario_id' => $actualUser['Usuario']['id']), 'fields' => array('Order.id'), 'recursive' => -1));

    if($params['status_orden'] == 'all')
    {
      $conditions = array('Envio.order_id' => $condicion_previa);
    }
    else
    {
      $conditions = array('Envio.order_id' => $condicion_previa, 'Envio.status_pago' => $params['status_orden']);
    }

    $model = 'Envio';
    $data = $this->dopaginator($conditions, Configure::read('TIVIA_CONFIG.PAGINADOR.LIMITE'), $model);
    $ds_orders = $this->Order->__findDireccion($data);
    $ds_orders = $this->Usuario->__findNombresDeCliente($ds_orders);

    $titulo = 'Ordenes recientes';
    $titulo_estadistica = 'Compras realizadas';
    $leyenda = 'TIVIA_CONFIG.STATUS_ORDERSCLIENT';
    $this->request->data['Orders']['status_orden'] = $params['status_orden'];
    $parametros = array('type' => 'get', 'controller' => 'Orders','action' => 'paginationhandler');
    $options = array('all' => 'Todas', 1 => 'Pago por confirmar', 2 => 'Listo para envío', 3 => 'Enviado', 4 => 'Finalizado', 5 => 'Pago incorrecto');

    $this->set(compact('options','ds_orders', 'titulo', 'titulo_estadistica', 'leyenda', 'parametros', 'hide_paginatorcount'));
    $this->params['action'] = 'myordersclient';
    $this->render('myordersclient');
  }

  /**
  * Se utiliza en el el dashboard de compras para poder limpiar la url del primer query del paginador.
  **/
  function redirectToNamed()
  { 
    $urlArray = $this->request['url'];
    unset($urlArray['url']);

    if( !empty($urlArray) ){
        $this->redirect($urlArray, null, true);
    }
  }

  /**
  * Funcion que se llama para paginar. Recibe como parametros las condiciones, el limite y el modelo sobre el cual se paginara
  **/
  function dopaginator($conditions, $limit, $model)
  {
    $this->Paginator->settings = array(
        'conditions' => $conditions,
        'limit' => $limit,
        'order' => array('Envio.created' => 'desc')
      );

    return $this->Paginator->paginate($model);
  }
  
  public function orden_detallada_realizada_modal($order_id, $tienda_id, $metodo_cliente)
  {
    $this->layout = 'modal';
    $ds_order = $this->OrderDetail->findDetailOrderRealizada($order_id, $tienda_id);
    if (!$this->request->data) {      
      $this->request->data = $ds_order;     
    } 
    $this->set(compact('ds_order', 'metodo_cliente'));
  }
  
  public function orden_detallada_recibida_modal($order_id)
  {
    $this->layout = 'modal';
    $actualUser = $this->viewVars['actualUser'];
    $ds_tienda = $this->Tienda->find('all', array('conditions' => array('Tienda.usuario_id' => $actualUser['Usuario']['id']), 'fields' => array('Tienda.id'), 'recursive' => -1));
    $tienda_id = $ds_tienda[0]['Tienda']['id'];
    $ds_order = $this->Order->findDetailOrderRecibida($order_id, $tienda_id);
    //$this->log($ds_order);
    $this->set(compact('ds_order', 'tienda_id'));
  }

  function instapago_payment($data)
  {
 
    $result = $this->Order->callToInstapago();

    $response = json_decode($result);
    // access title of $book object
    $this->log($response->success); // JavaScript: The Definitive Guide 
    $this->log($response->message);
    $this->log($response->id);
    $this->log($response->code);
    $this->log($response->reference);

    $this->log($response);
    $response1 = json_decode($result,true);
    $this->log($response1);

    if($response->success)
    {
      $this->set('voucher',$response1['voucher']);
    }
    return true;
  }

  function modal_form_instapago($total, $items) {
    $this->layout = 'modal-pagos';
    $this->set(compact('total','items'));
  }

  function modal_form_transferencia($total, $items){
    $this->layout = 'modal-pagos';
    $bancos= $this->Banco->find('list', array('fields' =>  array('id' ,'descripcion'), 'order' => 'descripcion ASC'));
    $this->set(compact('total','items', 'bancos'));
  }
}