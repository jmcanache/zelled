
<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

class ImagesController extends AppController  {
	public $components = array('Imgupload', 'Paginator', 'search-master.Prg', 'RequestHandler');
	var $uses = array('Like', 'Usuario');

	public function preview_image_modal($tipo_imagen=null,$imagen_id=null,$fotoid=null){ // visualizar modal para carga y crop de imagenes
		$this->layout = 'uploadimage';
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$opciones = Configure::read('TIVIA_CONFIG.TIPO_IMAGEN');
		$header = $opciones[$tipo_imagen];			
		$arrsize = Configure::read('TIVIA_CONFIG.CROP_SIZE.'.$tipo_imagen);					
		if (!$this->request->data) {
			$this->set(compact('imagen_id','header','arrsize','tipo_imagen')); //este id es usado para identificar en vista a que div sera agregada la img como background
		}
	}
	
	public function image_temp($imagen_id, $tipo_imagen=null, $fotoid=null){ // proceso luego de que ha sido seleccionada el area de la imagen
		$this->autoRender = false;
		$validaciones_ok = true;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$dim = Configure::read('TIVIA_CONFIG.CROP_SIZE.'.$tipo_imagen);			
		if ($this->request->is(array('post', 'put'))) {
			//validaciones
			//$this->log($this->request->data);
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
			// datos usados por funcion jcrop
			if ($validaciones_ok){
				$imageSize = getimagesize($this->request->data['Foto']['foto'.$imagen_id]['tmp_name']);				
				$src = $this->request->data['Foto']['foto'.$imagen_id]['tmp_name'];
				$x1 = $this->request->data['x1'];
				$y1 = $this->request->data['y1'];
				$w = $this->request->data['w'];
				$h = $this->request->data['h'];
	
				if(empty($this->request->data['x1']) && empty($this->request->data['y1']) && $imageSize['0'] == $size && $imageSize['1'] == $size ){
					$x1 = 0;
					$y1 = 0;
					$w = $dim['MaxWidth'];
					$h = $dim['MaxWidth'];
				}
	
	
				$img_cropped = $this->Imgupload->xcropImage($src, $x1, $y1, $w, $h); //funcion que guarda en carpeta temporal img seleccionada y cortada por usuario
				if ($imagen_id == 1){ //se crea sesion imagenesproducto para imagenes la llave es $imagen_id (1,2,3), valor ruta en dir temporal y id de foto de tabla foto para el caso de modificaciones
					$imgproductos = array();
					$imgproductos[$imagen_id] = array('img' => $img_cropped, 'type' => $this->request->data['Foto']['foto'.$imagen_id]['type']);
					if (isset($this->request->data['Foto']['foto'.$imagen_id]['id'])) {
						$imgproductos[$imagen_id] = array('img' => $img_cropped, 'type' => $this->request->data['Foto']['foto'.$imagen_id]['type'], 'fotoid' => $this->request->data['Foto']['foto'.$imagen_id]['id']);
					}
					CakeSession::write('imagenestemporales', $imgproductos);
				}else{
						// en caso de 2da y 3ra img se agrega a la misma sesion	imagenesproducto
						$allimg = CakeSession::read('imagenestemporales');
						$allimg[$imagen_id] = array('img' => $img_cropped,'type' => $this->request->data['Foto']['foto'.$imagen_id]['type']);
						if (isset($this->request->data['Foto']['foto'.$imagen_id]['id'])) {
							$allimg[$imagen_id] = array('img' => $img_cropped,'type' => $this->request->data['Foto']['foto'.$imagen_id]['type'],'fotoid' => $this->request->data['Foto']['foto'.$imagen_id]['id']);
						}
						CakeSession::write('imagenestemporales', $allimg);					
				}
								
					
				$dataimgcropped = $this->webroot.$img_cropped;
	
			}
		}
		//$this->log(CakeSession::read('imagenestemporales'));
		$this->set(compact('dataimgcropped')); // se envia ruta de img a vista para ser mostrada miniatura a usuario
	
		$this->render('/Elements/ajax_imgcropped', 'ajax');
	}

}