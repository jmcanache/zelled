<?php
	App::uses('Shell', 'Console');
	App::uses('AppShell', 'Console/Command');
	App::uses('AppModel', 'Model');

	class NotificadorShell extends AppShell {
    
		public $uses = array('Usuario', 'Suscriptor', 'Notificacion');
		
		public function main() {


			$this->log('hola');

			/*	$plataformas_activas = array(); //Informacion de las plataformas activas


			if (Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.ACTIVA') === true)
			{
				$plataformas_activas[] = Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.CODIGO');

				$emailto = $this->_getEmailTo();

				if (!empty($emailto))
				{
					$this->out(AhoraLog($this->name . ". ALERTA. Todos los emails seran enviados a: ($emailto) Vea: NOTIFICACIONES.PLATAFORMA.EMAIL.SMTP.to"));
				}
			}
			else
			{
				$this->out($this->name . '. ALERTA. La plataforma EMAIL no esta activa. Vea NOTIFICACIONES.PLATAFORMA.EMAIL.ACTIVA.');
			}
			*/
			
			
			//Buscar las notificaciones pendientes por enviar de las plataformas activas
			$ds_notificaciones = $this->Notificacion->getNotificacionesPendientes('C');
			$this->log($ds_notificaciones);

			/*if($ds_notificaciones)
			{
				foreach($ds_notificaciones as $notificacion)
				{
					//Recupera la metainformacion desde el core
					$evento =  Configure::read('TD_CONFIG.NOTIFICACIONES.' . $notificacion['Notificacion']['codigo']);

					$evento['ENTIDAD'] = $notificacion['Notificacion']['entidad_id'];
					$evento['INFORMACION'] = $notificacion['Notificacion']['informacion'];

					$evento['NOTIFICACION_ID'] = $notificacion['Notificacion']['id'];

					$evento['Notificacion'] = $notificacion['Notificacion'];

					//$this->log($evento);

					if ($this->_enviarNotificacion($evento))
					{
						$this->out(AhoraLog('Notificacion id => [' . $notificacion['Notificacion']['id'] . '] Enviada.'));
						$notificacion['Notificacion']['enviada'] = true;
						$notificacion['Notificacion']['fecha_envio'] = Ahora();

						if (!$this->Notificacion->save($notificacion))
						{
							$this->out(AhoraLog($this->name . '. ERROR. marcando la notificacion como enviada. vea [' . $pista . '] en log para mayor detalle.'));
							$this->log(array(
									'Lugar' => $this->name,
									'Pista' => $pista,
									'Error' => 'Error marcando la notificacion como enciada. A pesar de que se envio bien.',
									'$notificacion' => $notificacion,
							));
						}
					}
					else
					{
						$pista = ClaveValidacion();

						$this->out(AhoraLog($this->name . '. ERROR. error grave enviando notificacion. vea [' . $pista . '] en log para mayor detalle.'));

						$this->log(array(
								$pista => 'Error enviando notificacion',
								'Datos' => 'Ver los previos...',
								));
					}
				}
			}

			$this->out(AhoraLog($this->name . '. Finalizo su ejecucion.'));*/
		}

		/**
		*
		* Permite enrutar la notificacion a traves de la plataforma adecuada por la que será enviada.
		* @param unknown_type $evento
		*/
		function _enviarNotificacion($evento)
		{
			if ($evento['Notificacion']['codigo_plataforma'] == Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.CODIGO'))
			{
				return $this->_enviarCorreo($evento);
			}
			else if ($evento['Notificacion']['codigo_plataforma'] == Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.SMS.CODIGO'))
			{
				return $this->_enviarSms($evento);
			}

			return false;
		}

		/**
		 * Canaliza el envío de Mensajes SMS
		 * @param unknown_type $evento
		 */
		function _enviarSms($evento)
		{
			return $this->Smssender->enviarSms($evento['Notificacion']['destinatario'], $evento['Notificacion']['informacion']);

			/*
			return $this->Smssender->enviarSms(
				$evento['SMS']['TIPO_SMS_ID'],
				$evento['Notificacion']['destinatario'],
				$evento['Notificacion']['informacion'],
				getClaveSistemaSMS()
			);*/
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
			$this->Email = &new EmailComponent(null);
			$this->Email->reset();

			$this->Controller = &new Controller();
			$this->Email->startup($this->Controller);

			$this->Email->initialize($this->Controller);

			//Opciones SMTP
			$this->Email->smtpOptions = $this->_getSmtpOptions();

			// Configurar método de entrega
			$this->Email->delivery = 'smtp';

			$emailto = $this->_getEmailTo();
			$this->Email->to = empty($emailto) ? $evento['Notificacion']['destinatario'] : $emailto;

			//Interpretar el SUBJECT
			$datos = array();

			if (isset($evento['EMAIL']['SUBJECT_PATH']))
			{
				foreach ($evento['EMAIL']['SUBJECT_PATH'] as $key => $value)
				{
					$valores = Set::extract($value, $evento);
					$datos[$key] = $valores[0];
				}
			}

			$this->Email->subject =  String::insert(__($evento['EMAIL']['SUBJECT'], true), $datos);

			$this->Email->replyTo = $evento['EMAIL']['REPLYTO'];
			$this->Email->from = $evento['EMAIL']['FROM'];

			//Determinar el template
			$template_inferido = strtolower($evento['CODIGO'] . '_mail');

			$this->Email->template = empty($evento['EMAIL']['TEMPLATE']) ? $template_inferido : $evento['EMAIL']['TEMPLATE'];

			//Enviar como 'html', 'text' or 'both' (ambos) - (por defecto es 'text')
			$this->Email->sendAs = 'html'; //

			//Enviar variables de la vista
			$this->Controller->set('dataset', $evento);

			//NO PASAMOS ARGUMENTOS A SEND()
			$envio_ok = $this->Email->send();

			if (!$envio_ok)
			{
				$this->log(array(
						'Lugar' => 'function Notificador::_enviarMail($evento, $datosEvento)',
						'envio_ok:'  => $envio_ok,
						'smtpError:' => $this->Email->smtpError,
						'$evento' => $evento,
						));
			}
			return $envio_ok;
		}

		/**
		 * Retorna el valor del parametro Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.SMTP.to');
		 * @return Ambigous <string, NULL, multitype:, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > > , number>
		 */
		function _getEmailTo()
		{
			return Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.SMTP.to');
		}
		/**
		 *
		 * @return Ambigous <string, NULL, multitype:, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > > , number>
		 */
		function _getSmsTo()
		{
			return Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.SMS.TO');
		}


		/**
		 * Retorna un array con los parámetros del SMTP para enviar notificaciones.
		 * La clave Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.SMTP')
		 * @return Ambigous <string, NULL, multitype:, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> , multitype:unknown Ambigous <multitype:, NULL, multitype:unknown Ambigous <multitype:, NULL> > > , number>
		 */
		function _getSmtpOptions()
		{
			return Configure::read('TD_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.SMTP');
		}

			
    
}