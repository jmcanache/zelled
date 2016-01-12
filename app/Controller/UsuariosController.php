<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class prueba


/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsuariosController extends AppController {

/**
 * Components
 *
 * @var array
 */
  var $uses = array('Notificacion', 'Usuario', 'Like', 'Tienda', 'Seguidor','Usuariobanco','Banco');
  public $helpers = array('Js' => array('Jquery'));

	public function registro_usuario (){

		$this->layout = 'store';

		if ($this->request->is('post'))
		{

			$this->request->data['Usuario']['clave_recuperacion'] = ClaveValidacion();
			$this->request->data['Usuario']['clave_validacion_email'] = ClaveValidacion();
			$this->request->data['Usuario']['activo'] = true;
			$this->request->data['Usuario']['correo_validado'] = false;

			if ($this->Usuario->save($this->request->data))
			{
				$this->Session->setFlash(__('Gracias por unirte a ZELLED. Por favor valida tu correo.'), 'flash_good');

				//Para adjuntar el password al correo
				$informacion = $_POST['data']['Usuario']['password'];

				//Notificar al usuario. Correo de validacion de cuenta y clave de validacion de movil
				$this->Notificacion->insertarNotificacionCorreo('REGISTRO_USUARIO', $this->Usuario->id, $this->request->data['Usuario']['login'], $informacion);

				$this->request->data = '';
			}
			else
			{
				$this->Session->setFlash(__('Verifica los datos del formulario y vuelve a intentar', true), 'flash_bad');
				$this->request->data['Usuario']['sexo_id'] = Configure::read('TIVIA_CONFIG.SEXO.FEMENINO.CODIGO');
				//$this->log(array(
				//		'Error' => 'Usuario no pudo ser guardado',
				//		'Datos' => $this->request->data['Usuario'],
				//		'User->validationErrors' => $this->Usuario->validationErrors
				//));

			}
		}

		$this->request->data['Usuario']['sexo_id'] = Configure::read('TIVIA_CONFIG.SEXO.FEMENINO.CODIGO');

	}

	/**
	 * Es llamada desde el link del correo de usuario registrado
	 */
	public function confirmarEmail ($clave_validacion = null){

		$ds_usuario = $this->Usuario->findByClaveValidacionEmail($clave_validacion);

		$resultado = '';

		if (empty($ds_usuario)) //clave de validacion inexistente.
		{
			$this->log('W.Intento de fraude. Intento entrar con la clave de validacion: '. $clave_validacion);
			$resultado = 'USUARIO_NO_ENCONTRADO';
		}
		else
		{
			if ($ds_usuario['Usuario']['correo_validado'])
			{
				$resultado = 'NO_REQUIERE_VALIDACION';

				//Enviar el usuario para que no tenga que escribirlo
				unset($ds_usuario['Usuario']['password']);
				$this->request->data['Usuario'] = $ds_usuario['Usuario'];
			}
			else
			{
				$ds_guardar = array('Usuario' => array());

				$ds_guardar['Usuario']['id'] = $ds_usuario['Usuario']['id'];
				$ds_guardar['Usuario']['fecha_validacion'] 	= Ahora();
				$ds_guardar['Usuario']['correo_validado'] 	= true;

				if ($this->Usuario->save($ds_guardar, true))
				{
					$resultado = 'CUENTA_VALIDADA_OK';

					unset($ds_usuario['Usuario']['password']);
					//Enviar el usuario para que no tenga que escribirlo
					//$this->data['Usuario'] = $ds_usuario['Usuario'];
				}
				else
				{
					$resultado = 'ERROR_VALIDANDO'; //Intente mas tarde
					$this->log(array(
							'>===========================> INI >===========================>',
							'Metodo' => "UsuariosControlelr::verificar(\$clave_validacion = '$clave_validacion')",
							'Datos' => $ds_guardar,
							'Error' => $this->Usuario->validationErrors,
							'<===========================< FIN <===========================<',
					)
					);
				}
			}
		}

		$this->layout = 'principal';


		if($resultado == 'CUENTA_VALIDADA_OK')
		{
			//Llevar al usuario a loginredirect y autenticarlo llamando a funcion login.
			if ($this->Auth->login($ds_usuario))
			{
				//Para volver al lugar de la peticion original. Lugar de entrada.
				$this->redirect($this->Auth->redirect());
			}

		}
		else if($resultado == 'NO_REQUIERE_VALIDACION')
		{
			//Mandarlo a home y decirle que su cuenta no requiere validacion. NO se loguea directamente por seguridad
			$this->Session->setFlash(__('Hola ' . $ds_usuario['Usuario']['nombre'] . ', tu cuenta ya se encuentra confirmada.' ),'success_message');
			$this->redirect('/');
		}
		else if($resultado)
		{
			$this->redirect('/');
		}
	}

	/**
	 * A este controlador llega luego de que logra hacer login.
	 */
	public function entered ()
	{
		//Diseñar Layout
		$this->layout = 'principal';

	}

	/**
	 * Loguea a un usuario
	 */
	public function login()
	{
		$this->layout = 'store';
		
		if ($this->request->is('post'))
	    {
	        if ($this->Auth->login())
	        {
	            //Para volver al lugar de la peticion original. Lugar de entrada.
	           	//$this->redirect($this->Auth->redirect());
	           	return $this->redirect($this->Auth->redirectUrl());
	           	//$this->redirect(array('controller' => 'usuarios', 'action' => 'entered'));
	        }
	        else
	        { 	//Verificar la validacion de la cuenta

	        	$usuario = $this->Usuario->findByLogin($this->request->data('Usuario.login'));

	        	if (!empty($usuario) && !$usuario['Usuario']['correo_validado'])
	        	{
	        		$this->Session->setFlash(__('Necesitas validar tu cuenta para ingresar. revisa tu correo en bandeja de entrada o en spam.', true), 'flash_bad');
	        		//$this->Session->setFlash(__('Para ingresar debe validar su cuenta.' ),'success_message');

	        		$this->Usuario->validationErrors['login'] = __('Su cuenta requiere validación');
	        	}
	        	else
	        	{
	        		//$this->Session->setFlash('Usuario o clave incorrectos.', 'flash_bad', array(), 'auth');
	        		$this->Session->setFlash(__('Usuario o clave incorrectos', true), 'flash_bad');
	        	}
	        }
	    }
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());

	}

	public function accede()
	{
		$this->layout = 'store';

	}
	
	public function perfil_usuario()
	{
		$this->layout = 'tutorial-popup';
		$actualUser = $this->viewVars['actualUser'];
		
		$usuario_id =  $actualUser['Usuario']['id'];
		$conditions = array('Usuario.id' => $usuario_id);
		$data = $this->Usuario->find('first', array('conditions' => $conditions,  'recursive' => 2));
		$ds_data = $this->Like->likeUsuario($usuario_id, Configure::read('TIVIA_CONFIG.FOTO.CANTIDAD_FOTOS'));
		 //se buscan tiendas seguidas por el usuario conectado
		$tiendas_seguidas= $this->Seguidor->tiendasQueSigo($usuario_id);
		 //si no se consigui ninguna tienda se pasara a la vista $tiendas_seguidas=null
		if(empty($tiendas_seguidas)){
		 	$tienda_aleatoria= null;
		}
		else{
		 	$tienda_aleatoria= $this->Tienda->tiendas_random($tiendas_seguidas);
		}

		$first_visit = false;
		if($actualUser['Usuario']['first_login'] == 0){
			
			$first_visit = true;

			//La primera vez que pasa por el metodo, actualiza a 1 el campo de entro por primera vez.
			$this->Usuario->updateAll(
			    array('Usuario.first_login' => 1),
			    array('Usuario.id' => $actualUser['Usuario']['id'])
			);
		}

		
		$this->set(compact('data', 'ds_data','tienda_aleatoria', 'first_visit'));	
	}
	
	function afterFilter()
	{
		$includeAfterFilter = array('perfil_usuario');
		if (in_array($this->action,$includeAfterFilter)){
			$this->Session->write('lastUser', 'User');
			$this->Session->delete('lastHome');
			$this->Session->delete('lastStore');
		}
	}
	

	public function reset_password()
	{
		$this->layout = 'store';

		$postback = $this->request->is(array('post', 'put'));
		$validaciones_ok = true;
        
		if ($postback)
		{
			$usuario = $this->Usuario->findByLogin($this->request->data('Usuario.login'));
			//Validar si el usuario existe
			if (empty($usuario))
			{
				$validaciones_ok = false;

				$this->Usuario->validationErrors['login'] = __('Email no registrado');

				$this->Session->setFlash(__('Por favor verifique el login que ha escrito.'), 'flash_bad');
			}
            
			//Verificar si el usuario valido el correo
			if ($validaciones_ok && !$usuario['Usuario']['correo_validado'])
			{
				$validaciones_ok = false;

				$this->Usuario->validationErrors['login'] = __('Email requiere validación');

				$this->Session->setFlash(__('Antes de recuperar su clave debe validar su cuenta de email.'), 'flash_bad');

				return $this->redirect(array('controller' => 'usuarios', 'action' => 'requestvalidationemail'));
			}
		}	

		if ($postback && $validaciones_ok)
	    {    
			$user2save = array('Usuario' => array(
			'id' => $usuario['Usuario']['id'],
			'clave_recuperacion' => ClaveValidacion(),
			));

			if ($this->Usuario->save($user2save))
			{
				//Enviar el correo de recupetacion de la clave al usuario
				$usuario['Usuario']['clave_recuperacion'] = $user2save['Usuario']['clave_recuperacion'];

				$data = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.CLAVE');

				if($this->resetpassword_sendemail($data, $usuario))
				{
					$this->Session->setFlash(__('En pocos instantes recibirá un email que le permitirá recuperar el acceso.'), 'flash_good');
					return $this->redirect(array('controller' => 'usuarios', 'action' => 'accede'));	
				}
				else
				{
					$this->Session->setFlash(__('No se pudo enviar el email, por favor intente de nuevo.'), 'flash_bad');
				}
			}
			else
			{
				$this->log(array(
					'Lugar' => 'UsuariosConttoller.reset_password_email()',
					'Error' => 'No se pudo generar el token de cambio de clave',
					'Datos' => $this->request->data['Usuario'],
					'Usuario->validationErrors' => $this->Usuario->validationErrors
				));
				$this->Session->setFlash(__('En este momento no podemos procesar su solicitud, por favor intente más tarde.'), 'flash_bad');
			}
	    }
	}
   
    private function resetpassword_sendemail($data, $usuario)
	{
		$email = new CakeEmail();
		$email->config('conexion');
		$email->template($data['EMAIL']['TEMPLATE'], $data['EMAIL']['LAYOUT']);
		$email->emailFormat('html');
		$email->to($usuario['Usuario']['login']);
		$email->from(array($data['EMAIL']['FROM_EMAIL'] => $data['EMAIL']['FROM_TITLE']));
		$email->subject($data['EMAIL']['SUBJECT']);
		$email->viewVars(array('datos' => $usuario));

		$envio_ok = $email->send();

		if (!$envio_ok)
		{
			$this->log(array(
					'Lugar' => 'function SUSCRIPCION::_enviarMail($data)',
					'envio_ok:'  => $envio_ok,
					'$data' => $data
					));
		}
		return $envio_ok;
	}

	public function resetpassword_fromemail ($token = ''){

		$this->layout = 'store';
		$postback = $this->request->is(array('post', 'put'));
		$validaciones_ok=true;

		$usuario = null;

		if ($postback)
		{
			//Buscar el usuario dado el login
			$usuario = $this->Usuario->findByLogin($this->request->data('Usuario.login'));

			//Validar si el usuario existe
			if (empty($usuario) )
			{
				$validaciones_ok = false;
				$this->Session->setFlash(__('Por favor verifique el login que ha escrito.'), 'flash_bad');
			}


			if ($validaciones_ok && $usuario['Usuario']['clave_recuperacion'] != $this->request->data('Usuario.clave_recuperacion'))
			{
				$this->Session->setFlash(__('Este enlace de cambio de clave ya no es valido. Por favor solicite otro.'), 'flash_bad');

				$validaciones_ok = false;

				$this->log(array(
					'Lugar' => 'UsuariosConttoller.resetpassword()',
					'Error' => 'Clave de validación no coincidente. Posible intento de hacking.',
					'Datos' => $this->request->data['Usuario'],
					'User' => $usuario,
					'Ip' => $this->request->clientIp(),
				));

				return $this->redirect(array('controller' => 'usuarios', 'action' => 'reset_password'));
			}
		}

		if ($postback && $validaciones_ok)
		{
			$user2save = array('Usuario' => array(
				'id' => $usuario['Usuario']['id'],
				'password' => $this->request->data('Usuario.password'),
				'password2' => $this->request->data('Usuario.password2'),
				'clave_recuperacion' => ClaveValidacion(),
			));

			if ($this->Usuario->save($user2save))
			{
				$this->Session->setFlash(__('EL usuario ha sido salvado.'), 'flash_good');
				return $this->redirect(array('controller' => 'usuarios', 'action' => 'accede'));
			}
			else
			{
				$this->Session->setFlash(__('El usuario no pudo ser salvado, por favor intente otra vez.'), 'flash_bad');
			}
		}

		if (!$postback)
		{
			$this->request->data('Usuario.clave_recuperacion', $token);
		}
	}


	public function requestvalidationemail()
	{
		$this->layout = 'store';
		$postback = $this->request->is(array('post', 'put'));

		$validaciones_ok = true;

		if ($postback)
		{
			$usuario = $this->Usuario->findByLogin($this->request->data('Usuario.login'));

			//Validar si el usuario existe
			if (empty($usuario) )
			{
				$validaciones_ok = false;

				$this->Usuario->validationErrors['login'] = __('Email no registrado');

				$this->Session->setFlash(__('Por favor verifique el login que ha escrito.'), 'flash_bad');
			}

			//Validar si el usuario existe
			if ($validaciones_ok && $usuario['Usuario']['correo_validado'])
			{
				$validaciones_ok = false;

				$this->Usuario->validationErrors['login'] = __('Este Email no requiere validación');

				$this->Session->setFlash(__('La cuenta que ha indicado ya se encuenttra validada.'), 'flash_bad');

			}
		}

		if ($postback && $validaciones_ok)
		{
			$user2save = array('Usuario' => array(
				'id' => $usuario['Usuario']['id'],
				'clave_recuperacion' => ClaveValidacion(),
				'clave_validacion_email' => ClaveValidacion(),
			));

			if ( $this->Usuario->save($user2save))
			{
				$usuario['Usuario'] = array_merge($usuario['Usuario'], $user2save['Usuario']);

				$this->Notificacion->insertarNotificacionCorreo('REGISTRO_USUARIO', $this->Usuario->id, $this->request->data['Usuario']['login']);

				$this->Session->setFlash(__('En pocos instantes recibirá un email que le permitirá validar su cuenta.'), 'flash_good');

				return $this->redirect(array('controller' => 'usuarios', 'action' => 'accede'));
			}
			else
			{
				$this->log(array(
					'Lugar' => 'UsersController.requestemailvalidation()',
					'Error' => 'No se pudo generar el token de cambio de clave',
					'Datos' => $usuario,
					'User->validationErrors' => $this->Usuario->validationErrors
				));

				$this->Session->setFlash(__('En este momento no podemos procesar su solicitud, por favor intente más tarde.'), 'flash_bad');
			}
		}
	}
	
	public function edit_bio_modal() { //muestra el form con los datos
		$this->layout = 'modal';
		$actualUser = $this->viewVars['actualUser'];		
		$usuario = $this->Usuario->findById($actualUser['Usuario']['id']);
		
		if (!$this->request->data) {
			//$this->log("Envio data");
			$this->request->data = $usuario;
			//$this->log($this->request->data);
		}
	}
	
	public function update_modal_bio() { //actualizar el registro
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$usuario = $this->Usuario->findById($actualUser['Usuario']['id']);		
		if ($this->request->is(array('post', 'put')))
		{
			$this->Usuario->id = $actualUser['Usuario']['id'];
			//Si uno o todos vienen vacio lo devolvemos.
			if(empty($this->request->data['Usuario']['bio']))
			{
				$data = 0;
				return;
			}
			//actualiza registro
			if ($this->Usuario->save($this->request->data))
			{
				//$this->log('guardo');
				$data = $this->Usuario->findById($actualUser['Usuario']['id']);
	
			}
			else
			{
				$data = 0;
			}
	
			$this->set(compact('data'));
			$this->render('/Elements/user_detail', 'ajax');
	
		}
	}
	
	public function datos_bancarios_modal() { //muestra el form con los datos
		$this->layout = 'modal';
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$id_usuariobanco = $this->Usuariobanco->find('first', array('fields' => array('id'),'conditions' => array("Usuariobanco.usuario_id" => $actualUser['Usuario']['id']),  'recursive' => -1));
		
		if (!empty($id_usuariobanco)){
			$datosbancarios = $this->Usuariobanco->findById($id_usuariobanco['Usuariobanco']['id']);
		}else{
			$datosbancarios = null;
		}
		
		if (!$this->request->data) {			
			$this->request->data = $datosbancarios;			
		}
		$bancos= $this->Banco->find('list', array('fields' =>  array('id' ,'descripcion'), 'order' => 'descripcion ASC'));
		$this->set(compact('bancos'));
	}
	
	public function update_modal_datos_bancarios() { //muestra el form con los datos
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$id_usuariobanco = $this->Usuariobanco->find('first', array('fields' => array('id'),'conditions' => array("Usuariobanco.usuario_id" => $actualUser['Usuario']['id']),  'recursive' => -1));
				
		if ($this->request->is(array('post', 'put')))		{
			$ds_guardar = array('Usuariobanco' => array());
			if(!empty($id_usuariobanco)){
				$ds_guardar['Usuariobanco']['id'] = $id_usuariobanco['Usuariobanco']['id'];
			}
			$ds_guardar['Usuariobanco']['usuario_id'] = $actualUser['Usuario']['id'];
			//validamos que quieran hacer cambio en tutular
			if(!empty($this->request->data['Usuariobanco']['titular_cuenta']))
			{
				$ds_guardar['Usuariobanco']['titular_cuenta'] = $this->request->data['Usuariobanco']['titular_cuenta'];
			}
			//validamos que quieran hacer cambio en tipo id
			if(!empty($this->request->data['Usuariobanco']['tipo_id']))
			{
				$ds_guardar['Usuariobanco']['tipo_id'] = $this->request->data['Usuariobanco']['tipo_id'];
			}
			//validamos que quieran hacer cambio en tipo cuenta
			if(!empty($this->request->data['Usuariobanco']['tipo_cuenta']))
			{
				$ds_guardar['Usuariobanco']['tipo_cuenta'] = $this->request->data['Usuariobanco']['tipo_cuenta'];
			}
			//validamos que quieran hacer cambio en correo
			if(!empty($this->request->data['Usuariobanco']['correo']))
			{
				$ds_guardar['Usuariobanco']['correo'] = $this->request->data['Usuariobanco']['correo'];
			}			
			//validamos que quieran hacer cambio en cedula
			if(!empty($this->request->data['Usuariobanco']['cedula']))
			{
				$ds_guardar['Usuariobanco']['cedula'] = $this->request->data['Usuariobanco']['cedula'];
			}
				
			//validamos que quieran hacer cambio en nrocuenta
			if(!empty($this->request->data['Usuariobanco']['nro_cuenta']))
			{
				$ds_guardar['Usuariobanco']['nro_cuenta'] = $this->request->data['Usuariobanco']['nro_cuenta'];
			}
				
			//validamos que quieran hacer cambio en bancoid
			if(!empty($this->request->data['Usuariobanco']['banco_id']))
			{
				$ds_guardar['Usuariobanco']['banco_id'] = $this->request->data['Usuariobanco']['banco_id'];
			}
				
			//Si uno o todos vienen vacio lo devolvemos.
			$this->Usuariobanco->set($this->request->data);
			if(empty($this->request->data['Usuariobanco']['cedula']) || empty($this->request->data['Usuariobanco']['nro_cuenta']) || empty($this->request->data['Usuariobanco']['banco_id']) || empty($this->request->data['Usuariobanco']['titular_cuenta']) || empty($this->request->data['Usuariobanco']['correo']) || empty($this->request->data['Usuariobanco']['tipo_id']) || empty($this->request->data['Usuariobanco']['tipo_cuenta']) || !($this->Usuariobanco->validates()))
			{
				$data = 0;
				return;
			}			
			//actualiza registro					
			if ($this->Usuariobanco->save($ds_guardar))			{
				
				$data = $this->Usuariobanco->getRelatedData($actualUser['Usuario']['id']);
			}
			else
			{
				$data = 0;			
			}
			$databanco = $this->Usuariobanco->getRelatedData($actualUser['Usuario']['id']);
			$datosbancarios = $databanco['Usuariobanco'];
			$this->set(compact('data','datosbancarios'));
			
			//$this->render('/Elements/admin_panel', 'ajax');
			if ($this->request->is('ajax')) {
				$this->render('/Elements/admin_datosbancarios', 'ajax');
			}else{
				$this->render('/Elements/admin_datosbancarios', 'ajax');
			}
				
		}
	}
		
	public function updatecodigobanco($banco_id = null)
	{
		$this->autoRender = false;
		if (!empty($banco_id))
		{
			$codigobanco = $this->Banco->find('first', array('fields' => array('codigo'),'conditions' => array("Banco.id" => $banco_id),  'recursive' => -1));
			$data = $codigobanco['Banco']['codigo'];
			//$this->log($data);
		}
		else{
			$data = null;
		}
		$this->set(compact('data'));
		$this->render('/Elements/ajax_data', 'ajax');
	}
	
	public function delete_datosbancarios() {
		$this->autoRender = false;
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$id_usuariobanco = $this->Usuariobanco->find('first', array('fields' => array('id'),'conditions' => array("Usuariobanco.usuario_id" => $actualUser['Usuario']['id']),  'recursive' => -1));
		//eliminar
		if ($this->request->is(array('post', 'put'))) {			
			if ($this->Usuariobanco->delete($id_usuariobanco['Usuariobanco']['id'],true)) {
				$data = "El registro ha sido eliminado.";
			}else{
				$data = "No se puede eliminar registro en este momento.";
			}
		}
		//enviar datos a la vista
		$datos = $this->Tienda->getcomunData($tienda_id);
		$databanco = $this->Usuariobanco->getRelatedData($actualUser['Usuario']['id']);
		if(isset($databanco['Usuariobanco']))
		{
			$datosbancarios = $databanco['Usuariobanco'];
		}
		else
		{
			$datosbancarios = null;
		}
		
		if(isset($datos['data']))
		{
			$data = $datos['data'];
		}
		else
		{
			$data = null;
		}
		$this->set(compact('data','datosbancarios'));
		$this->render('/Elements/carga_datos', 'ajax');
	}
}