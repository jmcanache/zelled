<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Order extends AppModel {

	public $useTable = 'order';

  var $actsAs = array('Containable');

	public $hasMany = array(
      'Envio' => array(
          'className' => 'Envio',
          'foreignKey' => 'order_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Pago' => array(
          'className' => 'Pago',
          'foreignKey' => 'order_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'OrderDetail' => array(
          'className' => 'OrderDetail',
          'foreignKey' => 'order_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
  );


  function getParaNotificacion($id)
  {
    $this->recursive = 3;

    $this->Envio->Tienda->unbindmodel(array('hasMany' => array('Producto', 'Seguidor', 'Envio', 'Pago')));
    $this->Envio->unbindmodel(array('belongsTo' => array('Order')));
    $this->unbindmodel(array('hasMany' => array('Pago')));
    $this->OrderDetail->Producto->unbindmodel(array('belongsTo' => array('Categoria', 'Tienda'), 'hasMany' => array('Like', 'OrderDetail', 'Foto')));
    $this->OrderDetail->unbindmodel(array('belongsTo' => array('Order', 'Tienda'))); 

    $ds = $this->findById($id);
    $ds_data =$ds;
    //datos del comprador
    $comprador = ClassRegistry::init('Usuario');
    $comprador->recursive = -1;
    $ds_comprador = $comprador->findById($ds['Order']['usuario_id']);
    $direccion_comprador = ClassRegistry::init('Direccion');
    $ds_direccion_comprador = $direccion_comprador->find('first', array('conditions' => array('Direccion.id' => $ds['Order']['direccion_id']), 'recursive' => 0));
    $banco_comprador = ClassRegistry::init('Banco');
    $ds_banco_comprador = $banco_comprador->findById($ds['Order']['banco_id']);

    $foto = ClassRegistry::init('Foto');
    foreach ($ds_data['OrderDetail'] as $key => $data)
    {
      $thumb = $foto->find('first', array('conditions' => array('Foto.producto_id' => $data['Producto']['id']),'fields' => array('ruta_thumb','producto_id'), 'recursive' => 0));
      $ds['OrderDetail'][$key]['Foto'] = $thumb;
    }

    array_push($ds, $ds_comprador, $ds_direccion_comprador, $ds_banco_comprador);
    return $ds;
  }

  function addCantCourier($ds_tiendas_nocourier, $ds_productos)
  {
    foreach ($ds_tiendas_nocourier as $tienda) {
      
      $count = 0;
      foreach ($ds_productos as $producto) {

        if($producto['Tienda']['id'] == $tienda['Tienda']['id'])
        {
          $count += $producto['Producto']['cantidad'];
        }//endif
  
      }//endforeach inner

      if($count == 0)
      {
        $tienda['Tienda']['courier_mult'] = 1;
      }
      else
      {
         $tienda['Tienda']['courier_mult'] = $count;
      }

      $ds_tienda[] = $tienda;

    } 
     return $ds_tienda;
  }  

  function findOrdersRecibidas($id, $statusOrden)
  { 
    $envio = ClassRegistry::init('Envio');
    if($statusOrden == 'all')
    {
      $statusOrden = array(1,2,3,4,5);
    }
    $ds_envios = $envio->find('all', array('conditions' => array('Envio.tienda_id' => $id), 'recursive' => -1));

    $ds_orders = array();

    foreach ($ds_envios as $ds_envio) 
    {
      $orders = $this->find('all', array('conditions' => array('Order.id' => $ds_envio['Envio']['order_id'], 'Order.status_pago' => $statusOrden), 'contain' => array('OrderDetail' => array('conditions' => array('OrderDetail.tienda_id' => $id )))));
      if(!empty($orders))
      {
        $orders[0]['Order']['cant_productos'] = count($orders[0]['OrderDetail']);
        $ds_orders[] = $orders[0];
      }    
    }
    $ds_order = $this->__findDireccion($ds_orders);
    return $ds_order;
  }


  function findDetailOrderRecibida($order_id, $tienda_id)
  {
    $direccion = ClassRegistry::init('Direccion');
    $usuario = ClassRegistry::init('Usuario');
    $this->Envio->unbindmodel(array('belongsTo' => array('Tienda', 'Order')));
    $this->unbindmodel(array('hasMany' => array('Pago')));
    $this->OrderDetail->unbindmodel(array('belongsTo' => array('Order')));
    $order = $this->find('all', array('conditions' => array('Order.id' => $order_id), 'recursive' => 2));
    foreach ($order[0]['Envio'] as $envio) 
    {
      if($tienda_id == $envio['tienda_id']) 
      { 
        $order[0]['Order']['courier'] = $envio['courier']; 
        break;
      }
    }
    $usuario->recursive = -1;
    $nombreComprador = $usuario->findById($order[0]['Order']['usuario_id']);
    $ds_direccion = $direccion->findById($order[0]['Order']['direccion_id']);
    $ds_order = array_merge($order, $ds_direccion, $nombreComprador);
    return $ds_order;
  }

  function __findDireccion($ds_orders)
  {
    $direccion = ClassRegistry::init('Direccion');
    $orderDetail = ClassRegistry::init('OrderDetail');
    $cont = 0;
    foreach ($ds_orders as $order) 
    {
      $nombre_destinatario = $direccion->findById($order['Order']['direccion_id']);
      $ds_orders[$cont]['Order']['destinatario'] = $nombre_destinatario['Direccion']['nombre_completo'];
      //cantidad de productos por tienda
      $cantidad_productos = $orderDetail->find('all', array('conditions' => array('OrderDetail.order_id' => $order['Order']['id'], 'OrderDetail.tienda_id' => $order['Envio']['tienda_id']), 'recursive' => -1));
      $suma_productos = 0;
      foreach ($cantidad_productos as $cantidad) 
      {
        $suma_productos = $suma_productos + $cantidad['OrderDetail']['cantidad'];
      }
      $ds_orders[$cont]['Envio']['cantidad_productos'] = $suma_productos;
      $cont++;
    }
    return $ds_orders;
  }

  //se llama en Order::place_order, organiza la data de order, orderdetail y envio que se va a salvar.
  function preparardataOrder($usuario_id, $direccion_id, $sumaCantidadProductos, $total, $ds_productos, $dsEnvios, $atributosdata, $order_status_pago, $envio_status_pago)
  {
    //se completan los datos para guardar en la tabla Order
    $order = array(
        'Order' => array(
                          'usuario_id' => $usuario_id,
                          'direccion_id' => $direccion_id,
                          'orden_compra' => 1,
                          'cant_productos' => $sumaCantidadProductos,
                          'total_pagar' => $total,
                          'status_pago' => $order_status_pago));


    foreach ($ds_productos as $infoProducto)
    {
      //en caso de tener guardar atributos de orden
      $ds_orderdetailattr =null;
      if (!empty($atributosdata)) 
      {
        foreach ($atributosdata as $atributodata)
        {
          if($infoProducto['Producto']['id'] == $atributodata['producto_id'])
          {
            $ds_orderdetailattr[] = array(
                                          'atributo' => $atributodata['atributo'],
                                          'valor' => $atributodata['valor']);               
          }
        }
      }

      $ds_orderdetail[] =  array(
                                  'producto_id' => $infoProducto['Producto']['id'],
                                  'tienda_id' => $infoProducto['Tienda']['id'],
                                  'precio_producto' => $infoProducto['Producto']['precio'],
                                  'cantidad' => $infoProducto['Producto']['cantidad'],
                                  'OrderDetailAttr' => $ds_orderdetailattr);
    }

    // por ultimo se procede a guardar los datos correspondientes en la tabla Envio
    foreach ($dsEnvios as $dsEnvio)
    {
      $ds_envio[] = array(
        'tienda_id' => $dsEnvio['tienda_id'],
        'courier' =>  $dsEnvio['courier'],
        'costoenvio' => $dsEnvio['costoenvio'],
        'status_pago' => $envio_status_pago);
    }

    $order['OrderDetail'] =$ds_orderdetail;
    $order['Envio'] = $ds_envio;

    $save = $this->saveAssociated($order, array('deep' => true));
    return $save;
  }

  //Se llama en Orders:place_order, organiza la data que va a instapago y ejecuta la llamada a callToInstapago
  function procesa_instapago($order_id, $data, $amount)
  {
    $dataInstapago = array(
                            'CardHolder' => $data['name'],
                            'CardHolderId' => $data['identificador'],
                            'CardNumber' => $data['card-number'],
                            'CVC' => $data['csc'],
                            'ExpirationDate' => $data['month'] .'/20'. $data['year'],
                            'Amount' => $amount
                            );

    $result = $this->callToInstapago($dataInstapago);
    $respuestaInstapago = json_decode($result,true);

    switch ($respuestaInstapago['code']) 
    {
    case 201:
        $mensaje = 'Pago procesado correctamente';
        $correcto = true;
        break;
    case 400:
        $mensaje = 'El número de tarjeta de crédito no es válido';
        $correcto = false;
        break;
    case 401:
        $mensaje = 'Error de autenticación';
        $correcto = false;
        break;
    case 403:
        $mensaje = 'Pago rechazado por el banco';
        $correcto = false;
        break;
    case 500:
        $mensaje = 'Error interno en el servidor';
        $correcto = false;
        break;
    case 503:
        $mensaje = 'Error en los parámetros de entrada';
        $correcto = false;      
        break;  
    }

    if ($correcto) // EXITO
    {
      $metodo_tdc = ClassRegistry::init('Metodotdc');
      $metodotdc = array(
                    'order_id' => $order_id,
                    'lote' => $respuestaInstapago['reference'],
                    'id_instapago' => $respuestaInstapago['id'],
                    'tipo_tdc' => $data['card-type'],
                    'cedula' => $data['identificador'],
                    'tarjetahabiente' => $data['name']);

      $guardo_ok = $metodo_tdc->save($metodotdc);

      if(!$guardo_ok)
      {
        $this->log(array(
          'Error' => 'Fallo guardar tabla Metodotdc',
          'Lugar' => 'Modelo Order::procesa_instapago',
          '$procesadoInstapago' => $metodotdc,
          'Fecha' => Ahora()
        ));
      }
    }

    return array('respuestaInstapago' => $respuestaInstapago, 'correcto' => $correcto, 'mensaje' => $mensaje);    
  }

  public function callToInstapago($dataInstapago)
  {
    $url = 'https://api.instapago.com/payment';
    $fields = array(
                    "KeyID"         => "A5514105-0FC3-4105-AFAF-B50A06CFF09C", //Llave generada en Instapago
                    "PublicKeyId"   => "e4d4317233592f1aa90281f04f67e523", //Clave recibida en el correo enviada por Instapago
                    "Amount"        => $dataInstapago['Amount'], //Cantidad a pagar
                    "Description"   => "Pago", //Descripcion del pago
                    "CardHolder"    => $dataInstapago['CardHolder'], // Tarjetahabiente
                    "CardHolderId"  => $dataInstapago['CardHolderId'], // CI del tarjetahabiente
                    "CardNumber"    => $dataInstapago['CardNumber'], //Visa ficticia de Instapago
                    "CVC"           => $dataInstapago['CVC'], // Tres numeros del reverso
                    "ExpirationDate" =>$dataInstapago['ExpirationDate'], // Fecha de vencimiento
                    "StatusId"      => "2", // 1: Retener 2: Pagar
                    "IP"            => "127.0.0.1",
                    );

    $request = curl_init($url); // initiate curl object
    curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($fields)); // use HTTP POST to send form data
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
    $post_response = curl_exec($request); // execute curl post and store results in $post_response
    // additional options may be required depending upon your server configuration
    // you can find documentation on curl options at http://www.php.net/curl_setopt
    curl_close ($request); // close curl object
    return $post_response;
  }
}