<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');
App::uses('Validation', 'Utility');

class ProductosController extends AppController  {

	public $components = array('Imgupload', 'Paginator', 'search-master.Prg', 'RequestHandler');
	public $presetVars = array('nombre' => array('type' => 'value'));
	var $uses = array('Producto','Foto','Tienda','Like','Costoenvio','Color','Talla','Productocolor','Productotalla','Tiendacourier','Courier');
	public $helpers = array('Js' => array('Jquery'));


	public function listing()
	{
		$this->layout = 'listing';
		$validaciones_ok = true;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		/* CakeSession::delete('imagenesproducto');*/
		//$this->log($this->Session->read('imagenesproducto')); 
		$imagenesensesion = $this->Session->read('imagenesproducto'); //leyendo las imagenes que fueron cargadas
		
		
		if ($this->request->is('post') && $validaciones_ok )
		{
			//$this->log($this->request->data);
			$this->request->data['Producto']['tienda_id'] = $actualUser['Tienda']['id'];
			$this->request->data['Producto']['categoria_id'] = 1; // mientras tanto

			$dataSource = $this->Producto->getDataSource();
       		$dataSource->begin();

			if ($this->Producto->save($this->request->data))
			{
				//nuevo proceso
				$primera_foto = true;
				foreach ($imagenesensesion as $img) {					
					 
						$ds = $this->Foto->create(); // datasource foto
						if(isset($img['img']))
						{
							$ds['Foto']['producto_id'] = $this->Producto->id;
							$ds['Foto']['foto_principal'] = fread(fopen($img['img'],'r'), filesize($img['img']));
							
							#CREAR THUMBNAIL A PARTIR DE IMAGEN ORIGINAL DE SOLO LA PRIMERA FOTO
							if($primera_foto)
							{
								$thumb_name = 'thumb_'.time();
								$rutathumb_db = $this->Tienda->find('first', array('fields' => array('ruta_thumb'),'conditions' => array('Tienda.id' => $actualUser['Tienda']['id']),  'recursive' => -1));
								$dir = getenv('OPENSHIFT_DATA_DIR');
								$rutathumb = $dir . '/test/' .$thumb_name.'.jpg';											
							    $thumb_generado = $this->Imgupload->createThumb($ds['Foto']['foto_principal'], $rutathumb, $img['type']);
								
								if(!$thumb_generado){
									$this->log('no se genero thumb');
									$validaciones_ok = false;
								}
							
								$ds['Foto']['ruta_thumb'] = 'test/' .$thumb_name.'.jpg';
								$ds['Foto']['nombre_archivo'] = $thumb_name.'.jpg';
								$primera_foto = false;
							}
							#FIN CREAR THUMBAIL
							$ds_guardar[] = $ds['Foto'];
						}
					
				}
							
				// array atributo color
				if(isset($this->request->data['Color'])){
					foreach ($this->request->data['Color'] as $c)
					{
						$dataColor = $this->Productocolor->create();
						$dataColor['Productocolor']['producto_id'] = $this->Producto->id;
						$dataColor['Productocolor']['color_id'] = $c;
						$ds_colores[] = $dataColor['Productocolor'];					
					}
					$exito_save_color = $this->Productocolor->saveAll($ds_colores, array('validate' => 'first'));
				}
				// array atributo talla
				if(isset($this->request->data['Talla'])){
					foreach ($this->request->data['Talla'] as $t)
					{
						$dataTalla = $this->Productotalla->create();
						$dataTalla['Productotalla']['producto_id'] = $this->Producto->id;
						$dataTalla['Productotalla']['talla_id'] = $t;
						$ds_tallas[] = $dataTalla['Productotalla'];					
					}
					$exito_save_talla = $this->Productotalla->saveAll($ds_tallas, array('validate' => 'first'));
				}
				foreach ($this->request->data['Costoenvio'] as $key => $costoenvio) {
					$dscosto = $this->Costoenvio->create();
					$dscosto['Costoenvio']['producto_id'] = $this->Producto->id;
					$dscosto['Costoenvio']['courier'] = $key;
					$dscosto['Costoenvio']['costo'] = $costoenvio['costo'];
					$ds_guardar_costoenvio[] = $dscosto['Costoenvio'];
				}
				
				$exito_save_foto = $this->Foto->saveAll($ds_guardar, array('validate' => 'first'));
				$exito_save_costo = $this->Costoenvio->saveAll($ds_guardar_costoenvio, array('validate' => 'first'));				
							
				if($exito_save_foto and $exito_save_costo and $validaciones_ok)
				{
					$dataSource->commit();
					$this->Session->setFlash(__('¡Genial! puedes continuar cargando productos o continuar a tu tienda', true), 'flash_good');
					$this->request->data ="";	
					foreach ($imagenesensesion as $img) { //borramos archivos de dir temporales						
						unlink($img['img']);
					} 
					 CakeSession::delete('imagenesproducto'); //destruimos sesion con informacion de fotos temp
						
					//No hacemos redirecciÃ³n para que quede en la misma pagina y pueda cargar otro producto. Si no quiere cargar mas productos, en el menu puede escojer que hacer.
				}
				else
				{
					unlink($rutathumb); // Si hace rollback, tambien hay que eliminar el fichero que se generó
					foreach ($imagenesensesion as $img) { //borramos archivos de dir temporales
						unlink($img['img']);
					} 
					CakeSession::delete('imagenesproducto'); //destruimos sesion con informacion de fotos temp
					$dataSource->rollback();
					$this->Session->setFlash(__('Lo siento, intenta otra vez.', true), 'flash_bad');
					$this->log($this->Foto->validationErrors);
				}

			}

		}

		$this->request->data['Producto']['es_fisico'] = Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.VALOR');
		$this->request->data['Producto']['esta_hecho'] = Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.VALOR');
		//Envia couriers a la vista		
		$options = array(
					'fields' => array(
						'Tiendacourier.courier_id',
						'Courier.descripcion',
					),
					'joins' => array(						
						array(
							'conditions' => array('Tiendacourier.courier_id = Courier.id'),
							'table' => 'courier',							
							'type' => 'INNER',
						),
					),
					'conditions' => array(
						'Tiendacourier.tienda_id' => $tienda_id,
					),
				);

		$query = $this->Tiendacourier->find('all', $options);		
		
		$couriers =null;
		if (!empty($query))
		{
			foreach ($query as $qry)
			{
				$couriers[$qry['Tiendacourier']['courier_id']] = $qry['Courier']['descripcion'];
				
			}
		}
		//$couriers = Configure::read('TIVIA_CONFIG.COURIERS.'.$actualUser['Tienda']['couriers']);
		$color = $this->Color->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
		$talla = $this->Talla->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion DESC'));
		$seleccioneColor = array('Color' => array('id' => '0' , 'descripcion' => '-- Seleccione --' ));
		$seleccioneTalla = array('Talla' => array('id' => '0' , 'descripcion' => '-- Seleccione --' ));
		array_push($color, $seleccioneColor);
		array_push($talla, $seleccioneTalla);
		sort($color, SORT_DESC);
		sort($talla, SORT_DESC);
		$this->set(compact('color','talla','couriers'));
	}

	/*
	 *Para actualizar el combobox de hijos nivel uno
	 * $name_id: id del padre
	 */
	function updatechildlevelone($name_id = null)
	{
		//$this->log('entro en updatechildlevelone');

		if (!empty($name_id))
		{
			$this->request->data['Categoria']['name_id'] = $name_id;
		}

		$this->autoRender = false;

		$childlevelone = NULL;

		if (!empty($this->request->data['Categoria']['name_id']))
		{
			$name_id = $this->request->data['Categoria']['padre_id'];
			$childlevelone = $this->Categoria->getChildren($name_id);
		}
		else
		{
			$childlevelone = $this->Categoria->getChildren($name_id);
		}

		$this->set('options', $childlevelone);

		$this->render('/elements/updateselect', 'ajax');
	}

	/*
	 *Para actualuzar el combobox de municipios
	 * */
	function updateselectmunicipio($provincia_id = null)
	{
		if (!empty($provincia_id))
		{
			$this->data['Usuario']['provincia_id'] = $provincia_id;
		}

		$this->autoRender = false;

		$municipios = NULL;

		if (!empty($this->data['Usuario']['provincia_id']))
		{
			$provincia_id = $this->data['Usuario']['provincia_id'];
			$municipios = $this->Municipio->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => $provincia_id)));
		}
		else{
			$municipios = $this->Municipio->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
		}

		$this->set('options', Set::combine($municipios, "{n}.Municipio.id", "{n}.Municipio.descripcion"));
		$this->render('/elements/updateselect', 'ajax');
	}

	function updateselectparroquia($municipio_id = null)
	{
		if (!empty($municipio_id))
		{
			$this->data['Usuario']['municipio_id'] = $municipio_id;
		}

		$this->autoRender = false;

		$municipios = NULL;

		if (!empty($this->data['Usuario']['municipio_id']))
		{
			$provincia_id = $this->data['Usuario']['municipio_id'];
			$parroquia = $this->Parroquia->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('municipio_id' => $municipio_id)));
		}
		else{
			$parroquia = $this->Parroquia->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
		}

		$this->set('options', Set::combine($parroquia, "{n}.Parroquia.id", "{n}.Parroquia.descripcion"));
		$this->render('/elements/updateselect', 'ajax');
	}

	function updateselectciudad($provincia_id = null)
	{
		if (!empty($provincia_id))
		{
			$this->data['Usuario']['provincia_id'] = $provincia_id;
		}

		$this->autoRender = false;

		$ciudades = NULL;

		if (!empty($this->data['Usuario']['provincia_id']))
		{
			$provincia_id = $this->data['Usuario']['provincia_id'];
			$ciudades = $this->Ciudad->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC', 'conditions' => array('provincia_id' => $provincia_id)));
		}
		else{
			$ciudades = $this->Ciudad->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
		}

		$this->set('options', Set::combine($ciudades, "{n}.Ciudad.id", "{n}.Ciudad.descripcion"));
		$this->render('/elements/updateselect', 'ajax');
	}

	public function detail($tienda_id, $producto_id)
	{
		//echo phpinfo();
		/* CakeSession::delete('cart');
		CakeSession::delete('atributos'); */
		
		//$this->log($this->Session->read('cart'));
		$this->layout = 'store';
		$usuario_id =  $this->viewVars['actualUser']['Usuario']['id'];
		$producto = $this->Producto->findById($producto_id);

		$is_like = $this->Like->likeProduct($usuario_id, $producto_id);//$producto['Like'][0]['usuario_id'];
		if($is_like == true){			
			$class = 'fa fa-heart fa-2x font-human likered';
			array_push($producto, $is_like, $class);
		}
		else{			
			$class = 'fa fa-heart fa-2x font-human notlike_button';
			array_push($producto, $is_like, $class);
		}
		$datos = $this->Tienda->getcomunData($tienda_id);
		$data = $datos['data'];
		$ds_data = $datos['ds_data'];
				
		$color = $this->Color->getColorAtr($producto['Productocolor']);
		$talla = $this->Talla->getTallaAtr($producto['Productotalla']);
		$seleccioneColor = array('id' => '0' , 'descripcion' => '-- Seleccione --' );
		$seleccioneTalla = array('id' => '0' , 'descripcion' => '-- Seleccione --' );
		array_push($color, $seleccioneColor);
		array_push($talla, $seleccioneTalla);
		sort($color, SORT_DESC);
		sort($talla, SORT_DESC);		
		$this->set(compact('ds_data','producto','data', 'usuario_id','color','talla'));
	}
	
	public function like_product($tienda_id, $producto_id, $producto_ref = null){		
		$this->autoRender = false;
		$this->response->type('json');
		$usuario_id =  $this->viewVars['actualUser']['Usuario']['id']; /*verificar esta forma de conseguir usuario id*/
		$conditions_like = array("Like.producto_id" => $producto_id, "Like.usuario_id" => $usuario_id);
		$liked = $this->Like->find('first', array('fields' => array('id'),'conditions' => $conditions_like,  'recursive' => -1));
		$conditions_producto = array("Producto.id" => $producto_id);
		$data_producto = $this->Producto->find('first', array('fields' => array('likes'),'conditions' => $conditions_producto,  'recursive' => -1));
		$likes = $data_producto['Producto']['likes'];
		$data_like = array('producto_id' => $producto_id, 'usuario_id' => $usuario_id);
		if(empty($liked)){				
				/*update en Producto - likes*/
				$likes++;
				$this->Producto->updateAll(
						array('Producto.likes' => $likes),
						array('Producto.id' => $producto_id)
				);
				/* Guardar en Like*/
				$this->Like->save($data_like);
				$clase = 'likered';
			}
			else{
				$likes--;
				$this->Producto->updateAll(
						array('Producto.likes' => $likes),
						array('Producto.id' => $producto_id)
				);
				$this->Like->delete($liked['Like']['id']);
				$clase = 'notlike_button';	
			}
			$content = array('CantLikes' => $likes, 'Clase' => $clase);
			return new CakeResponse(array('body' => json_encode($content)));
	}
	
	function afterFilter()
	{
		$includeAfterFilter = array('detail');
		if (in_array($this->action,$includeAfterFilter)){
			$url = Router::url(null, true);
			$this->Session->write('lastUrl', $url);
			$this->Session->delete('lastStore');
			$this->Session->delete('lastHome');
			$this->Session->delete('lastUser');
// 			$this->log($this->Session->read('lastUrl'));
		}
	}


	function gallery ()
	{
		$this->layout = 'gallery';
		$this->Paginator->settings = array(    
        'limit' => 18,
		'recursive' => 0
    	);
		$ds_gallery = $this->paginate('Producto');	
		$posts = $this->Foto->getThumbByproductId($ds_gallery);
		$this->set('posts', $posts);
	}
	
	function admin ()
	{
		$this->layout = 'store';		
	}
	
	public function edit($producto_id = null) {		
		$this->layout = 'ajax';
		$usuario_id =  $this->viewVars['actualUser']['Usuario']['id'];
		$producto = $this->Producto->findById($producto_id);
		if ($this->request->is(array('post', 'put'))) {
			$this->Producto->id = $producto_id;
			if ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash(__('Datos Actualizados.'));
				return $this->redirect(array('action' => 'admin'));
			}
			$this->Session->setFlash(__('No es posible actualizar en este momento.'));
		}
	
		if (!$this->request->data) {
			$this->request->data = $producto;			
		}
	}

	public function edit_modal($producto_id = null) {		
		$this->layout = 'modal';		
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$producto = $this->Producto->findById($producto_id);
		if (!$this->request->data) {			
			$this->request->data = $producto;	
			$color = $this->Color->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion ASC'));
			$talla = $this->Talla->find('all', array('fields' => array('id', 'descripcion'), 'order' => 'descripcion DESC'));
			$seleccioneColor = array('Color' => array('id' => '0' , 'descripcion' => '-- Seleccione --' ));
			$seleccioneTalla = array('Talla' => array('id' => '0' , 'descripcion' => '-- Seleccione --' ));
			array_push($color, $seleccioneColor);
			array_push($talla, $seleccioneTalla);
			sort($color, SORT_DESC);
			sort($talla, SORT_DESC);
			$this->set(compact('color','talla'));
		}
	}
	
	public function update_modal($producto_id=null) {	
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$imagenesensesion = $this->Session->read('imagenesproducto'); //leyendo las imagenes que fueron cargadas
		$borra_thumb = false;
		if ($this->request->is(array('post', 'put'))) {
			$this->Producto->id = $producto_id;
			//$this->log($this->request->data);
			if ($this->Producto->save($this->request->data)) {
				
				//guardar foto; similar a listing() pero se toma en cuenta borrar el thumb anterior
				if(isset($imagenesensesion)){
				foreach ($imagenesensesion as $img) {
					
					if(empty($img['fotoid'])){// datasource foto
						$ds = $this->Foto->create(); //si es nueva imagen
					}else{
						$ds['Foto']['id'] = $img['fotoid']; //si es modificacion
					}
							
					if(isset($img['img'])){
						$ds['Foto']['producto_id'] = $this->Producto->id;
						$ds['Foto']['foto_principal'] = fread(fopen($img['img'],'r'), filesize($img['img']));
						$imgkey = key($imagenesensesion);
						#CREAR THUMBNAIL A PARTIR DE IMAGEN ORIGINAL DE SOLO LA PRIMERA FOTO
						if($imgkey == 1){
								$thumb_anterior = $this->Foto->find('first', array('fields' => array('ruta_thumb'),'conditions' => array('Foto.id' => $img['fotoid']),  'recursive' => -1));
								$borra_thumb = true; //bandera para borrar thumb anterior
								$thumb_name = 'thumb_'.time();
								$rutathumb_db = $this->Tienda->find('first', array('fields' => array('ruta_thumb'),'conditions' => array('Tienda.id' => $actualUser['Tienda']['id']),  'recursive' => -1));
								$rutathumb = 'img/todosproductos/'. $rutathumb_db['Tienda']['ruta_thumb'] . '/' .$thumb_name.'.jpg';
								$thumb_generado = $this->Imgupload->createThumb($ds['Foto']['foto_principal'], $rutathumb, $img['type']);
				
										if(!$thumb_generado){
											$this->log('no se genero thumb');
											$validaciones_ok = false;
										}
				
								$ds['Foto']['ruta_thumb'] = $rutathumb_db['Tienda']['ruta_thumb'] . '/' .$thumb_name.'.jpg';
														$ds['Foto']['nombre_archivo'] = $thumb_name.'.jpg';														
						}
						#FIN CREAR THUMBAIL
						$ds_guardar[] = $ds['Foto'];
					}
						
				}
				}
				//productocolor
				if(isset($this->request->data['Color'])){
					foreach ($this->request->data['Color'] as  $c)
					{
						$conditions = array("Productocolor.producto_id" => $this->Producto->id, "Productocolor.color_id" => $c);
						$productocolor = $this->Productocolor->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
						$dataColor = $this->Productocolor->create();
						if(!empty($productocolor)){
							$dataColor['Productocolor']['id'] = $productocolor['Productocolor']['id'];
						}
						$dataColor['Productocolor']['producto_id'] = $this->Producto->id;
						$dataColor['Productocolor']['color_id'] = $c;
						if($this->Productocolor->save($dataColor['Productocolor']))
						{
							$this->request->data['Color']="";
						}
						else
						{
							$this->log($this->Productocolor->validationErrors);
						}
					}
				}
				//productotalla
				if(isset($this->request->data['Talla'])){
					foreach ($this->request->data['Talla'] as  $t)
					{
						$conditions = array("Productotalla.producto_id" => $this->Producto->id, "Productotalla.talla_id" => $t);
						$productotalla = $this->Productotalla->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
						$dataTalla = $this->Productotalla->create();
						if(!empty($productotalla)){
							$dataTalla['Productotalla']['id'] = $productotalla['Productotalla']['id'];
						}
						$dataTalla['Productotalla']['producto_id'] = $this->Producto->id;
						$dataTalla['Productotalla']['talla_id'] = $t;
						if($this->Productotalla->save($dataTalla['Productotalla']))
						{
							$this->request->data['Talla']="";
						}
						else
						{
							$this->log($this->Productotalla->validationErrors);
						}
					}
				}
				if(isset($ds_guardar)){
					if($this->Foto->saveAll($ds_guardar, array('validate' => 'first')))
					{
						$this->request->data ="";
						if($borra_thumb){
							if (file_exists($thumb_anterior)) {
								unlink($thumb_anterior); // borramos imagen thumb anterior
							}
						}
						foreach ($imagenesensesion as $img) { //borramos archivos de dir temporales
							unlink($img['img']);
						}
						CakeSession::delete('imagenesproducto'); //destruimos sesion con informacion de fotos temp
						//No hacemos redirecciÃ³n para que quede en la misma pagina y pueda cargar otro producto. Si no quiere cargar mas productos, en el menu puede escojer que hacer.
					}
					else
					{
						$this->log($this->Foto->validationErrors);
						foreach ($imagenesensesion as $img) { //borramos archivos de dir temporales
							unlink($img['img']);
						}
						CakeSession::delete('imagenesproducto'); //destruimos sesion con informacion de fotos temp
		
					}
				}
				//despues de actualizar buscar datos de tienda y productos de tienda para render
				$datos = $this->Tienda->getcomunData($tienda_id);				
				if(isset($datos['data']))
				{
					$data = $datos['data'];				
				}
				else
				{
					$data = null;
				}
		
			}else{
				$data = "No es posible actualizar en este momento.";
				foreach ($imagenesensesion as $img) { //borramos archivos de dir temporales
					unlink($img['img']);
				}
				CakeSession::delete('imagenesproducto'); //destruimos sesion con informacion de fotos temp
				
				// $this->Session->setFlash(__('No es posible actualizar en este momento'), 'flash_bad');
			}
		}
		$conditions = array('Producto.tienda_id' => $tienda_id);
		$this->Paginator->settings = array(
				'conditions' => $conditions,
				'limit' => 3,
				'recursive' => -1,
				'order' => array('Producto.created ASC')
		);				
		$ds_productos = $this->Paginator->paginate('Producto');
		$admin_productos = $this->Foto->getThumbByproductId($ds_productos);
		$this->set(compact('data','admin_productos'));
		//$this->render('/Elements/admin_productos', 'ajax');
		if ($this->request->is('ajax')) {			
			$this->render('/Elements/admin_productos', 'ajax');
		}
	}

	public function motor_de_busqueda() {
		$this->layout = 'store';
		foreach ($this->request->data as $mensaje) 
		{
			$this->passedArgs= array('nombre' => $mensaje['nombre']);
			if($mensaje['field']==0)
			{
				$combobox = 'Producto';
			}
			else
			{
				$combobox= 'Tienda';
			}
		}
        
        //$this->Prg->commonProcess();
        $this->paginate = array('conditions' => $this->$combobox->parseCriteria($this->passedArgs)); 
        $ds_data = $this->paginate();

        if($combobox == 'Producto')
        {
			foreach ($ds_data as $producto) 
			{
				$ds_encontrados[] = array('Foto' => array('ruta_thumb' => $producto['Foto'][0]['ruta_thumb']),
				'Producto' => array('id' => $producto['Producto']['id'],'nombre' => $producto['Producto']['nombre'],'descripcion' => $producto['Producto']['descripcion_corta'],
				'precio' => $producto['Producto']['precio'],'tienda_id' => $producto['Producto']['tienda_id'],'likes' => $producto['Producto']['likes'],
				'UsuarioLike' =>$producto['Like']));
	    	}
        }

        else
        {
        	$dato_anterior = '';
	        foreach ($ds_data as $tienda) 
	        {
	        	if ($dato_anterior !== $tienda['Tienda']['nombre'])
	        	{
	        		$dato_anterior = $tienda['Tienda']['nombre'];
	        		unset($data);
	        		for($x = 0; $x < 4; $x++)
	          		{
	           			$dato=$this->Producto->find('all', array('conditions' => array('Producto.tienda_id' => $tienda['Tienda']['id']), 'order'=>'rand()', 'limit' => 1));
	           			$data[] = array(
	           				'ruta_thumb' =>$dato[0]['Foto'][0]['ruta_thumb'],
			           	 	'producto_id' => $dato[0]['Producto']['id'],
			            	'tienda_id' => $tienda['Tienda']['id'],
			            	'tienda_nombre' => $tienda['Tienda']['nombre'],
			            	'tienda_seguidores' => $tienda['Tienda']['seguidores']);
					}
	        		$ds_encontrados[]=$data;
	        	}	
	       	}
        }
        $this->set(compact('ds_encontrados', 'combobox')); 
	}

	public function delete($producto_id=null) {
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		//eliminar
		$this->log($producto_id);
		if ($this->request->is(array('post', 'put'))) {			
			if ($this->Producto->delete($producto_id,true)) {
				$data = "El registro ha sido eliminado.";
			}else{
				$data = "No se puede eliminar registro en este momento. Hay ordenes asociadas al producto";
			}
		}
		//enviar datos a la vista
		$datos = $this->Tienda->getcomunData($tienda_id);
		if(isset($datos['data']))
		{
			$data = $datos['data'];
		}
		else
		{
			$data = null;
		}
		$this->set(compact('data'));
		$this->render('/Elements/admin_productos', 'ajax'); 
	}
	
	public function delete_productocolor($producto_id, $color_id) { //elimina de productocolor
		$this->autoRender = false;
		$conditions = array("Productocolor.producto_id" => $producto_id, "Productocolor.color_id" => $color_id);
		$productocolor = $this->Productocolor->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
		if(empty($productocolor)){
			$data = 0;
		}
		else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Productocolor->delete($productocolor['Productocolor']['id'])) {
					$data = $this->Productocolor->getRelatedData($producto_id);
						
				}else{
					$data = "No se puede eliminar registro en este momento.";
				}
			}
		}
		//enviar datos a la vista
		$this->set(compact('data'));
		//$this->render('/Elements/producto_color', 'ajax');
	}
	
	public function delete_productotalla($producto_id, $talla_id) { //elimina de productotalla
		$this->autoRender = false;
		$conditions = array("Productotalla.producto_id" => $producto_id, "Productotalla.talla_id" => $talla_id);
		$productotalla = $this->Productotalla->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
		if(empty($productotalla)){
			$data = 0;
		}
		else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Productotalla->delete($productotalla['Productotalla']['id'])) {
					$data = $this->Productotalla->getRelatedData($producto_id);
	
				}else{
					$data = "No se puede eliminar registro en este momento.";
				}
			}
		}
		//enviar datos a la vista
		$this->set(compact('data'));
		$this->render('/Elements/ajax_data', 'ajax');
	}
	
	public function verificar_productotalla($producto_id, $talla_id) { //verifica si existe en productotalla
		$this->autoRender = false;
		$conditions = array("Productotalla.producto_id" => $producto_id, "Productotalla.talla_id" => $talla_id);
		$productotalla = $this->Productotalla->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
		if(empty($productotalla)){
			$data = 0;
		}
		else
		{
			$data = 1;
		}
		$this->set(compact('data'));
		$this->render('/Elements/ajax_data', 'ajax');
	}
	
	public function verificar_productocolor($producto_id, $color_id) { //verifica si existe en productocolor
		$this->autoRender = false;
		$conditions = array("Productocolor.producto_id" => $producto_id, "Productocolor.color_id" => $color_id);
		$productocolor = $this->Productocolor->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));
		if(empty($productocolor)){
			$data = 0;
		}
		else{
			$data = 1;
		}
		$this->set(compact('data'));
		$this->render('/Elements/ajax_data', 'ajax');
	}
	
	public function preview_image_modal($tipo_imagen,$imagen_id, $fotoid=null){ // visualizar modal para carga y crop de imagenes 
		$this->layout = 'uploadimage';	
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		if (!$this->request->data) {		
			$this->set(compact('imagen_id','fotoid','tipo_imagen')); //este id es usado para identificar en vista a que div sera agregada la img como background
		}
	}
	
	public function product_image_temp($imagen_id, $fotoid=null){ // proceso luego de que ha sido seleccionada el area de la imagen
		$this->autoRender = false;
		$validaciones_ok = true;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		if ($this->request->is(array('post', 'put'))) {
			//validaciones
			if($this->request->data['Foto']['foto'.$imagen_id]['error'] == 4) //no hay archivo
			{
				$dataimgcropped = 1;
				$validaciones_ok = false;
			}
			if($this->request->data['Foto']['foto'.$imagen_id]['error'] == 0)
			{
				if($this->Imgupload->validaExtension($this->request->data['Foto']['foto'.$imagen_id])) //verificar extension
				{
					$dataimgcropped = 2;
					$validaciones_ok = false;
				}
			}
				
			//$this->log($this->request->data);
			//$imageSize = getimagesize($this->request->data['Foto']['foto'.$imagen_id]['tmp_name']);
			// datos usados por funcion jcrop
			if ($validaciones_ok){
				$imageSize = getimagesize($this->request->data['Foto']['foto'.$imagen_id]['tmp_name']);
				$src = $this->request->data['Foto']['foto'.$imagen_id]['tmp_name'];
				$x1 = $this->request->data['x1'];
				$y1 = $this->request->data['y1'];
				$w = $this->request->data['w'];
				$h = $this->request->data['h'];
		
				if(empty($this->request->data['x1']) && empty($this->request->data['y1']) && $imageSize['0'] == 640 && $imageSize['1'] == 640 ){
					$x1 = 0;
					$y1 = 0;
					$w = 640;
					$h = 640;
				}
		
		
				$img_cropped = $this->Imgupload->xcropImage($src, $x1, $y1, $w, $h); //funcion que guarda en carpeta temporal img seleccionada y cortada por usuario
		
				if ($imagen_id == 1){ //se crea sesion imagenesproducto para imagenes la llave es $imagen_id (1,2,3), valor ruta en dir temporal y id de foto de tabla foto para el caso de modificaciones
					$imgproductos = array();
					$imgproductos[$imagen_id] = array('img' => $img_cropped, 'type' => $this->request->data['Foto']['foto'.$imagen_id]['type']);
					if (isset($this->request->data['Foto']['foto'.$imagen_id]['id'])) {
						$imgproductos[$imagen_id] = array('img' => $img_cropped, 'type' => $this->request->data['Foto']['foto'.$imagen_id]['type'], 'fotoid' => $this->request->data['Foto']['foto'.$imagen_id]['id']);
					}
					CakeSession::write('imagenesproducto', $imgproductos);
				}else{
					if($imagen_id == (2 || 3)){	// en caso de 2da y 3ra img se agrega a la misma sesion	imagenesproducto
						$allimg = CakeSession::read('imagenesproducto');
						$allimg[$imagen_id] = array('img' => $img_cropped,'type' => $this->request->data['Foto']['foto'.$imagen_id]['type']);
						if (isset($this->request->data['Foto']['foto'.$imagen_id]['id'])) {
							$allimg[$imagen_id] = array('img' => $img_cropped,'type' => $this->request->data['Foto']['foto'.$imagen_id]['type'],'fotoid' => $this->request->data['Foto']['foto'.$imagen_id]['id']);
						}
						CakeSession::write('imagenesproducto', $allimg);
					}
				}
			
				$dataimgcropped = $this->webroot.$img_cropped;
				
			}
		}
		
		$this->set(compact('dataimgcropped')); // se envia ruta de img a vista para ser mostrada miniatura a usuario
		
		$this->render('/Elements/ajax_imgcropped', 'ajax');
	}
}