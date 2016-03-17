<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Sucriptores Controller
 *
 * @property Suscriptor $Suscriptor
 * @property PaginatorComponent $Paginator
 */
class SuscriptoresController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	var $uses = array('Suscriptor');

	public function insert ()
	{
		$this->layout = 'store';

		if ($this->request->is('post'))
		{
			if ($this->Suscriptor->save($this->data))
			{
				$data = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.SUSCRIPCION');
				$enviar_mail = $this->_enviarMail($data, $this->request->data['Suscriptor']['email']);
				$this->Session->setFlash(__('¡Gracias por tu suscripción! Recibirás un email.', true), 'flash_good');
				$this->request->data = '';				
			}
			else
			{
				$this->Session->setFlash(__('Lo siento, el usuario ya se encuentra suscrito.', true), 'flash_bad');
				$this->log(array(
						'Error' => 'El login ya se encuentra registrado.',
						'Datos' => $this->request->data,
						'Usuario->validationErrors' => $this->Suscriptor->validationErrors
				));
				$this->request->data = '';
			}

			$this->redirect(array('controller' => 'pages', 'action' => 'home'));

		}

	}

	function _enviarMail($data, $email_user)
	{
		$email = new CakeEmail();
		$email->config('conexion');
		$email->template($data['EMAIL']['TEMPLATE'], $data['EMAIL']['LAYOUT']);
		$email->emailFormat('html');
		$email->to($email_user);
		$email->from(array($data['EMAIL']['FROM_EMAIL'] => $data['EMAIL']['FROM_TITLE']));
		$email->subject($data['EMAIL']['SUBJECT']);
		$email->bcc('mjcanache@gmail.com');
		//$email->viewVars(array('datos' => $data));

		$envio_ok = $email->send();

		if (!$envio_ok)
		{
			$this->log(array(
					'Lugar' => 'function SUSCRIPCION::_enviarMail($data)',
					'envio_ok:'  => $envio_ok,
					'$data' => $data,
					));
		}
		return $envio_ok;
	}


}