<?php
	App::uses('Shell', 'Console');
	App::uses('AppShell', 'Console/Command');
	App::uses('AppModel', 'Model');
	App::uses('CakeEmail', 'Network/Email');

	class NotificadorShell extends AppShell {
    
		public $uses = array('Usuario', 'Suscriptor', 'Notificacion', 'Grupo');
		
		public function main() {


			//Buscar las notificaciones pendientes por enviar de las plataformas activas
			$ds_notificaciones = $this->Notificacion->getNotificacionesPendientes('C');

			if($ds_notificaciones)
			{
				foreach($ds_notificaciones as $notificacion)
				{
					//Recupera la metainformacion desde el core
					$evento =  Configure::read('TIVIA_CONFIG.NOTIFICACIONES.' . $notificacion['Notificacion']['codigo']);

					$evento['ENTIDAD'] = $notificacion['Notificacion']['entidad_id'];
					$evento['INFORMACION'] = $notificacion['Notificacion']['informacion'];

					$evento['NOTIFICACION_ID'] = $notificacion['Notificacion']['id'];

					$evento['Notificacion'] = $notificacion['Notificacion'];
					

					if ($this->_enviarNotificacion($evento))
					{
						$notificacion['Notificacion']['enviada'] = true;
						$notificacion['Notificacion']['fecha_envio'] = Ahora();

						if (!$this->Notificacion->save($notificacion))
						{
							$this->log(array(
									'Error' => 'Error marcando la notificacion como enviada. A pesar de que se envio bien.',
									'$notificacion' => $notificacion,
							));
						}
					}
					else
					{
	
						$this->log(array(
									'Datos' => 'Ver los previos...',
								));
					}
				}
			}

		}

		/**
		*
		* Permite enrutar la notificacion a traves de la plataforma adecuada por la que será enviada.
		* @param unknown_type $evento
		*/
		function _enviarNotificacion($evento)
		{
			return $this->_enviarCorreo($evento);
		}


		/**
		 * Permite seleccionar el correo correcto para enviar la notificación.
		 * @param unknown_type $evento
		 */
		function _enviarCorreo($evento)
		{
			$evento['Datos'] = $this->Notificacion->getDatosEvento($evento);
			$resultado = $this->_enviarMail($evento);

			if ($resultado == false)
			{
				$this->log(array(
						'Lugar' => 'NotificadorShell::_enviarCorreo($evento)',
						'Mensaje' => 'Datos de evento con error. function _enviarCorreo($evento)',
						'Error' => 'El resultado de la llamada $this->_enviarMail($evento); fue false.',
						'Datos' => 'Ver log anterior....',
						));
			}

			return $resultado;

		}

		/**
		 * Utilizada para enviar correos.
		 * Toma los parametros del core
		 * @param unknown_type $evento
		 * @param unknown_type $datosEvento
		 * @return unknown
		 */
		function _enviarMail($evento)
		{
			$email = new CakeEmail();
			$email->config('conexion');
			$email->template($evento['EMAIL']['TEMPLATE'], $evento['EMAIL']['LAYOUT']);
			$email->emailFormat('html');
			$email->to($evento['Notificacion']['destinatario']);
			$email->from(array($evento['EMAIL']['FROM_EMAIL'] => $evento['EMAIL']['FROM_TITLE']));
			if(isset($evento['Datos']['Sexo']['saludo']))
			{
				$asunto = $evento['Datos']['Sexo']['saludo'].$evento['EMAIL']['SUBJECT']; 
			}
			else
			{
				$asunto = $evento['EMAIL']['SUBJECT']; 
			}
			$email->subject($asunto);
			$email->viewVars(array('datos' => $evento));
			
			$envio_ok = $email->send();
 
			if (!$envio_ok)
			{
				$this->log(array(
						'Lugar' => 'function Notificador::_enviarMail($evento)',
						'envio_ok:'  => $envio_ok,
						'$evento' => $evento,
						));
			}
			return $envio_ok;
		} 
}