<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

/**
 * Tienda Controller
 *
 * @property Tienda $Tienda
 * @property PaginatorComponent $Paginator
 */
class TiendasController extends AppController  {

/**
 * Components
 *
 * @var array
 */
	var $uses = array('Usuario', 'Tienda', 'Producto', 'Foto', 'Seguidor', 'Ciudad', 'Provincia', 'Order','Courier','Tiendacourier');
	public $components = array('Imgupload', 'imagenesUtilidades','RequestHandler', 'Paginator');
	public $helpers = array('Js' => array('Jquery'), 'Paginator');
	/* Esta funcion almacena las fotos en carpetas, se puede dejar asi hasta lanzar MVP. Mejorarlas para que lo haga en la BD como esta en listing de productos.*/
	public function open_store ()
	{
		$this->layout = 'store';
		/* CakeSession::delete('selectedcourier');
		CakeSession::delete('couriers'); */
		//Preguntar si tiene una tienda creada. Si la tiene sacalo de aca.
		$actualUser = $this->viewVars['actualUser'];		
		$imagenesensesion = $this->Session->read('imagenestemporales'); //leyendo las imagenes que fueron cargadas
		if(!empty($actualUser['Tienda']['id'])){
			$this->Session->setFlash(__('Sorry ' .$actualUser['Usuario']['nombre'] . ', sucede que ya posees una tienda en zelled y solo puedes tener una por usuario registrado.', true), 'flash_bad');
			$this->redirect(array('controller' => 'usuarios', 'action' => 'perfil_usuario'));
		}
	
		if ($this->request->is('post'))
		{
			//validamos que ambas imagenes vengan, pues con esa data se trabaja antes de llegar al save. El resto de los campos los valida el modelo.
			if(empty($this->request->data) || empty($this->request->data['Courier'])){
				$this->Session->setFlash(__('Recuerda cargar las imágenes de Logo y Banner, así como el resto de la info requerida', true), 'flash_bad');
			}
			else
			{
				//Llamada a guardar archivo en carpeta img/logo/nombredetienda_timestamp/logo_nombre.jpg
				$rutaLogo = 'img'. DS . 'logo' . DS;				
				$logoCarpeta = $this->Imgupload->xuploadImage($imagenesensesion['1']['img'], $rutaLogo, 'logo_', Configure::read('TIVIA_CONFIG.DIMENSIONES.LOGO.MIN'), Configure::read('TIVIA_CONFIG.DIMENSIONES.LOGO.MAX'));
				//$rutaBanner = 'img'. DS . 'banner' . DS;
				//$bannerCarpeta = $this->Imgupload->uploadImage($this->request->data['Tienda']['banner'], $rutaBanner, 'banner_', Configure::read('TIVIA_CONFIG.DIMENSIONES.BANNER.MIN'), Configure::read('TIVIA_CONFIG.DIMENSIONES.BANNER.MAX'));

				if ($logoCarpeta['resultado'])
				{
					//guardar registro
					$nombreTiendaMinuscula = strtolower($this->request->data['Tienda']['nombre']); // Ponemos el nombre de la tienda en minúsculas

					$nombreTiendaMinuscula_nowhitespace = str_replace(' ', '_', $nombreTiendaMinuscula);

					$prefix = $nombreTiendaMinuscula_nowhitespace . '_' . time(); // Al nombre de la tienda agregamos underscore y concatenamos con time()

					$this->request->data['Tienda']['nombre'] = ucfirst($this->request->data['Tienda']['nombre']);
					$this->request->data['Tienda']['ruta_thumb']  = $prefix;	
					$this->request->data['Tienda']['usuario_id'] = $actualUser['Usuario']['id'];
					$this->request->data['Tienda']['logo'] = $logoCarpeta['nombreArchivo'];
					//$this->request->data['Tienda']['banner'] = $bannerCarpeta['nombreArchivo'];
					$this->request->data['Tienda']['fecha_creacion']  = ahora() ;					
					//$this->request->data['Tienda']['couriers'] = array_sum($this->request->data['Tienda']['couriers']);

					if ($this->Tienda->save($this->request->data))
					{
						//aqui se crea la carpeta de los productos de la tienda:
						//Solo despues que se crea la tienda y no hay vuelta atras.
						//El usuario no debe volver atras en el navegador.
						//Esta carpeta se debe crear una unica vez.		
						
						$env_var = getenv('OPENSHIFT_DATA_DIR');
						$thepath = $env_var . DS . 'todosproductos' . DS . $prefix;
						//$thepath = WWW_ROOT."todosproductos". DS . $prefix; // todosproductos es una carpeta que ya esta creada. alli van todas las carpetas de las tiendas
						$crearCarpeta = $this->imagenesUtilidades->crearCarpeta($thepath);
						
						if($crearCarpeta)
						{
							//guardamos la ruta de la carpeta creada
							$data = array('id' => $this->Tienda->id, 'carpeta_productos' => $thepath);
							
							$this->Tienda->set($data);
							if ($this->Tienda->validates()) {
							    $this->Tienda->save($data);
							} else {
							    // didn't validate logic
							    $errors = $this->Tienda->validationErrors;
							    $this->log($errors);
							}

						}
						else
						{
							//si no la puede crear hay que hacer un rollback
							$this->log('no creo carpeta en todos productos');
							CakeSession::delete('selectedcourier');
						}
						
						//guardar en tiendacourier
						if(isset($this->request->data['Courier'])){
							foreach ($this->request->data['Courier'] as $tc) {
								$datacourier = $this->Tiendacourier->create();								
								$datacourier['Tiendacourier']['tienda_id'] = $this->Tienda->id;
								$datacourier['Tiendacourier']['courier_id'] = $tc;
						
								if($this->Tiendacourier->save($datacourier['Tiendacourier']))
								{
									CakeSession::delete('selectedcourier');
									//CakeSession::delete('couriers');
								}
								else
								{
									CakeSession::delete('selectedcourier');
									CakeSession::delete('couriers');
									$this->log($this->Tiendacourier->validationErrors);
								}
							}
						}

						$this->redirect(array('controller' => 'productos', 'action' => 'listing'));

					}
					else
						$this->Session->setFlash(__('No ha sido posible completar la accion, por favor intenta otra vez.', true), 'flash_bad');
						CakeSession::delete('imagenestemporales'); //destruir la sesion

				}
				else
				{
					//mensaje de error
					$this->Session->setFlash(__('Imagen pesada, dimensiones incorrectas o tipo de archivo incorrecto, seleciona una imagen .jpg, .jpeg o .gif.', true), 'flash_bad');
					CakeSession::delete('imagenestemporales'); //destruir la sesion
				}
			}
		}
		else
		{
			$this->request->data['Tienda'] = null;
			CakeSession::delete('selectedcourier');
		}
		$courier = $this->Courier->find('list', array('keyField' => 'id','fields' => array('descripcion')));
		$courier['0'] = '--Seleccione--';
		$courier['10000'] = 'Seleccionar Todos'; //para que se ponga al final del array
		ksort($courier);
		CakeSession::write('couriers', $courier);
	   $provinciaIDs= $this->Provincia->find('list', array('fields' =>  array('id' ,'descripcion'), 'order' => 'descripcion ASC'));
	   $ciudads = $this->Ciudad->find('list', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => 2)));
	   $this->set(compact('ciudads', 'provinciaIDs'));
	}


	/* Esta funcion permite al propietario de la tienda, verla tal cual la veria un usuario, con la diferencia que tendra enlaces para editar.
	*	Recibe un parametro encriptado con el codigo del dueo de la tienda, asi se cual elemento voy a mostrar, si edit o normal
	*/
	public function view_store($tienda_id, $referencia = null)
	{
		$this->layout = 'store';
		$actualUser = $this->viewVars['actualUser'];
		$esdueno = $this->Tienda->esDuenoTienda($tienda_id, $actualUser['Tienda']['id']);
		//borrar session de couriers
		CakeSession::delete('selectedcourier');
		CakeSession::delete('couriers');
		$conditions = array('Producto.tienda_id' => $tienda_id);
		$this->Paginator->settings = array(
	        'conditions' => $conditions,
	        'limit' => 3,
	        'recursive' => -1,
	        'order' => array('Producto.created ASC')
      	);
		
		$ds_productos = $this->Paginator->paginate('Producto');
		$admin_productos = $this->Foto->getThumbByproductId($ds_productos);	
		
		$datos = $this->Tienda->getcomunData($tienda_id);	
		//datos bancarios
		if (!empty($datos['data']['Usuario']['Usuariobanco'])){
			$datosbancarios = $datos['data']['Usuario']['Usuariobanco'];
		}else{
			$datosbancarios = null;
		}
		$data = $datos['data'];
		if(!empty($datos['ds_data'])){
			$cantidad_de_productos = count($datos['ds_data']);
		}else{
			$cantidad_de_productos = null;
		}
		//esto se hace en el caso que la tienda no tenga productos, asi ds_data no da error en el element si viene vacia.
		if(isset($datos['ds_data']))
		{
			$ds_data = $datos['ds_data'];
		}
		else
		{
			$ds_data = null;
		}

		$loSigue = $this->Seguidor->verificarUsuarioSigueTienda($actualUser['Usuario']['id'], $tienda_id);
   		$follow_unfollow = $loSigue['TF'];
		
   		//$provincias= $this->Provincia->find('list', array('fields' =>  array('id' ,'descripcion'), 'order' => 'descripcion ASC'));
	    //$ciudads = $this->Ciudad->find('list', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => 2)));

		$this->set(compact('data', 'ds_data', 'esdueno', 'follow_unfollow', 'referencia', 'admin_productos', 'cantidad_de_productos','datosbancarios'));
		//$this->set(compact('data', 'ds_data', 'esdueno', 'follow_unfollow', 'provincias', 'ciudads'));
		if ($this->request->is('ajax')) {					
			$this->render('/Elements/admin_productos', 'ajax');
		}
	}
		
	function afterFilter()
	{
		$includeAfterFilter = array('view_store');
		if (in_array($this->action,$includeAfterFilter)){
			$last_tienda_id = $this->params['pass']['0'];
			$this->Session->write('lastStore', $last_tienda_id);				
			$this->Session->delete('lastHome');
			$this->Session->delete('lastUser');
		}
	}

    function updateselectciudad($provincia_id = null)
	{
		if (!empty($provincia_id))
		{
			$ciudades = $this->Ciudad->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => $provincia_id)));
		}
		else{
			$ciudades = $this->Ciudad->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
		}

		$this->set('options', Set::combine($ciudades, "{n}.Ciudad.id", "{n}.Ciudad.descripcion"));
		$this->render('/Elements/updateselect', 'ajax');
	}
	
	public function edit_store_modal($tienda_id = null) { //muestra el form con los datos
		$this->layout = 'modal';
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];		
		//$tienda = $this->Tienda->findById($tienda_id);
		$conditions = array('Tienda.id' => $tienda_id);
		$tienda = $this->Tienda->find('first', array('conditions' => $conditions,  'recursive' => 2));
		$courier = $this->Courier->find('list', array('keyField' => 'id','fields' => array('descripcion')));	
		$courier['0'] = '--Seleccione--';
		$courier['10000'] = 'Seleccionar Todos'; //para que se ponga al final del array
		ksort($courier);
		CakeSession::write('couriers', $courier);			
		if(isset($tienda['Tiendacourier'])){ // agregando existente a sesion courier seleccionados
			foreach ($tienda['Tiendacourier'] as $tc) {
				$addCouriers[$tc['courier_id']] = $courier[$tc['courier_id']];
				CakeSession::write('selectedcourier', $addCouriers);
				unset($courier[$tc['courier_id']]); //borrando de sesion courier, si ya esta registrado
				CakeSession::write('couriers', $courier);
			}
		}
		if (!$this->request->data) {
			$this->request->data = $tienda;
		}
		
		//NO SE EDITAN CIUDADES Y ESTADOS POR AHORA EN TIENDA. ERROR RENDERIZANDO VISTA DE CIUDADES, POSIBLE ERROR updateselectciudad NO ESTE ENVIANDO A LA VISTA MODAL, NO TENGA ALCANCE.
	   //$provincias= $this->Provincia->find('list', array('fields' =>  array('id' ,'descripcion'), 'order' => 'descripcion ASC'));
	   //$ciudads = $this->Ciudad->find('list', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => 2)));
	   //$this->set(compact('ciudads', 'provincias'));  
	}
	
	public function update_modal_store($tienda_id=null) 
	{  //actualizar el registro			
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$esdueno = $this->Tienda->esDuenoTienda($tienda_id, $actualUser['Tienda']['id']);		
		$tienda_id = $actualUser['Tienda']['id'];
		if($tienda_id == null || !$esdueno)
		{
			//redirigir a error forbidden
		}
		
		if ($this->request->is(array('post', 'put')))
		{				
			//$this->log($this->request->data);
			$ds_guardar = array('Tienda' => array());
			$ds_guardar['Tienda']['id'] = $tienda_id;
			
			//validamos que quieran hacer cambio en nombre de tienda
			if(!empty($this->request->data['Tienda']['nombre']))
			{
				$ds_guardar['Tienda']['nombre'] = $this->request->data['Tienda']['nombre'];
			}
			
			//validamos que quieran hacer cambio en slogan
			if(!empty($this->request->data['Tienda']['slogan']))
			{
				$ds_guardar['Tienda']['slogan'] = $this->request->data['Tienda']['slogan'];
			}
			
			//validamos que quieran hacer cambio en bio
			if(!empty($this->request->data['Tienda']['bio']))
			{
				$ds_guardar['Tienda']['bio'] = $this->request->data['Tienda']['bio'];
			}
			
			//validamos que quieran hacer cambio en telefono
			if(!empty($this->request->data['Tienda']['telefono']))
			{
				$ds_guardar['Tienda']['telefono'] = $this->request->data['Tienda']['telefono'];
			}

			//validamos que quieran hacer cambio en courier
			/* if(!empty($this->request->data['Tienda']['couriers']))
			{
				$ds_guardar['Tienda']['couriers'] = array_sum($this->request->data['Tienda']['couriers']);
			} */
						
			//Si uno o todos vienen vacio lo devolvemos.
			if(empty($this->request->data['Tienda']['nombre']) || empty($this->request->data['Tienda']['slogan']) || empty($this->request->data['Tienda']['bio']))
			{
				$this->Session->setFlash(__('Alguno de los siguientes campos se encuentra vacio. Nombre, Slogan, Bio. Por favor llenelo', true), 'error_message');
				return;
			}
			
			//validamos que quieran hacer cambio de logo
			if($this->request->data['Tienda']['logo']['error'] == 0 )
			{
				$rutaLogo = 'img'. DS . 'logo' . DS;
				$logoCarpeta = $this->Imgupload->uploadImage($this->request->data['Tienda']['logo'], $rutaLogo, 'logo_', Configure::read('TIVIA_CONFIG.DIMENSIONES.LOGO.MIN'), Configure::read('TIVIA_CONFIG.DIMENSIONES.LOGO.MAX'));
			
				if ($logoCarpeta['resultado'])
				{
					$ds_guardar['Tienda']['logo'] = $logoCarpeta['nombreArchivo'];
			
				}
				else
				{
					//mensaje de error
					$this->Session->setFlash(__('Imagen pesada, dimensiones incorrectas o tipo de archivo incorrecto, seleciona una imagen .jpg, .jpeg o .gif.', true), 'error_message');
					return;
				}
			}
			
			/*validamos que quieran hacer cambio de banner
			 if($this->request->data['Tienda']['banner']['error'] == 0 )
			 {
			$rutaBanner = 'img'. DS . 'banner' . DS;
			$bannerCarpeta = $this->Imgupload->uploadImage($this->request->data['Tienda']['banner'], $rutaBanner, 'banner_', Configure::read('TIVIA_CONFIG.DIMENSIONES.BANNER.MIN'), Configure::read('TIVIA_CONFIG.DIMENSIONES.BANNER.MAX'));
			
			if ($bannerCarpeta['resultado'])
			{
			$ds_guardar['Tienda']['banner'] = $bannerCarpeta['nombreArchivo'];
			}
			else
			{
			//mensaje de error
			$this->Session->setFlash(__('Imagen pesada, dimensiones incorrectas o tipo de archivo incorrecto, seleciona una imagen .jpg, .jpeg o .gif.', true), 'error_message');
			return;
			}
			}*/
			
			//actualiza registro
			$this->log($ds_guardar);
			if ($this->Tienda->save($ds_guardar))
			{				
				if(isset($this->request->data['Courier'])){
					foreach ($this->request->data['Courier'] as $tc) {
						$conditions = array("Tiendacourier.tienda_id" => $tienda_id, "Tiendacourier.courier_id" => $tc);
						$findtiendacourier = $this->Tiendacourier->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
						$datacourier = $this->Tiendacourier->create();
						if(!empty($findtiendacourier)){
							$datacourier['Tiendacourier']['id'] = $findtiendacourier['Tiendacourier']['id'];
						}
						$datacourier['Tiendacourier']['tienda_id'] = $tienda_id;
						$datacourier['Tiendacourier']['courier_id'] = $tc;
						
						if($this->Tiendacourier->save($datacourier['Tiendacourier']))
						{
							CakeSession::delete('selectedcourier');
							//CakeSession::delete('couriers');
						}
						else
						{
							$this->log($this->Tiendacourier->validationErrors);
						}					
					}
				}
				$this->set(compact('tienda_id'));
				$this->render('/Elements/image_banner', 'ajax');
			}
			else
			{
				$this->log('no guardo');
			}
			
		}
	}
	
	public function add_courier($courier_id=null, $add=null)
	{
		$this->autoRender = false;
		$this->response->type('json');
		$actualUser = $this->viewVars['actualUser'];		
		$tienda_id = $actualUser['Tienda']['id'];		
		$conditions = array("Courier.id" => $courier_id);		
		$selectedcourier = $this->Courier->find('all', array('fields' => array('descripcion'),'conditions' => $conditions, 'order' => 'descripcion ASC'));		
			
		if ($add){
			if ($courier_id == 10000){
				$all = $this->Courier->find('list', array('keyField' => 'id','fields' => array('descripcion')));	
				CakeSession::write('selectedcourier', $all);
				$allcouriers = $this->Session->read('couriers');
				//$this->log($this->Session->read('selectedcourier'));
				foreach ($all as $c => $valor) { // borrar de sesion couriers todos
					unset($allcouriers[$c]);						
				}
				unset($allcouriers['10000']);
				CakeSession::write('couriers', $allcouriers);
				$result = 'todos';
				$data = array('valor' => $result , 'listcouriers' => $all); // se envia la lista de los couriers para el select
				return new CakeResponse(array('body' => json_encode($data)));	
				exit;										
			}			
			if ($this->Session->read('selectedcourier')){ 	//agregar a sesion donde estan los seleccionados
				 $addCouriers = $this->Session->read('selectedcourier');				 
				 $addCouriers[$courier_id] = $selectedcourier['0']['Courier']['descripcion'];
				 CakeSession::write('selectedcourier', $addCouriers);
				 $result = 1;
			}else{
				$inicialcourier = array();
				$inicialcourier[$courier_id] = $selectedcourier['0']['Courier']['descripcion'];			
				CakeSession::write('selectedcourier', $inicialcourier);
				$result = 1;
			}			
			if ($this->Session->read('couriers')){ //borrar de sesion donde estan los couriers base
				$allcouriers = $this->Session->read('couriers');
				foreach ($allcouriers as $c => $valor) {		
					if ($c == $courier_id) {
						unset($allcouriers[$courier_id]);
					}
					
				}
				CakeSession::write('couriers', $allcouriers);
			}
			$data = array('valor' => $result , 'listcouriers' => $allcouriers);
		}else{			
			if ($this->Session->read('selectedcourier') && $this->Session->read('couriers')){				
				// buscar si elemento esta registrado en tabla Tiendacourier			
				$conditions = array("Tiendacourier.tienda_id" => $tienda_id, "Tiendacourier.courier_id" => $courier_id);
				$tiendacourier = $this->Tiendacourier->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));				
				if(!empty($tiendacourier)){
					$this->Tiendacourier->delete($tiendacourier['Tiendacourier']['id']); //elimina de base de datos el elemento en caso que ya este registrado
				}
				$selectedcouriers = $this->Session->read('selectedcourier');				
				foreach ($selectedcouriers as $c => $valor) { // remover courier de los seleccionados
					if ($c == $courier_id) {
						unset($selectedcouriers[$courier_id]);
					}				
				}
				CakeSession::write('selectedcourier', $selectedcouriers);
				$allcouriers = $this->Session->read('couriers');
				$allcouriers[$courier_id] = $selectedcourier['0']['Courier']['descripcion'];
				ksort($allcouriers);
				CakeSession::write('couriers', $allcouriers);	// agregar el courier que fue removido en el select de nuevo			
				$result = 1;
				$data = array('valor' => $result , 'listcouriers' => $allcouriers); // se envia la lista de los couriers para el select 
			}			
		}	
		
		//$this->log($this->Session->read('couriers'));		
		return new CakeResponse(array('body' => json_encode($data)));
		
	}			
}