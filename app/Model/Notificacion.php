<?php
App::uses('AppModel', 'Model');
/**
 * Solicitude Model
 *
 * @property Notificacion $Notificacion
 */
class Notificacion extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'notificacion';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	
	public $validate = array(
			'entidad_id' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							'message' => 'Id de la entidad no válido.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'enviada' => array(
					'boolean' => array(
							'rule' => array('boolean'),
							'message' => 'Marca de enviada no válida.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'prioridad' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							'message' => 'Prioridad no válida.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
				 ),
			),
	);
	
	
	

	/**
	 * Prepara e inserta una notiticación de correo en la base de datos
	 * @param unknown_type $evento
	 * @param unknown_type $entidad_id
	 * @param unknown_type $email_destinatario
	 * @param unknown_type $informacion
	 * @return boolean
	 */
	function insertarNotificacionCorreo($evento, $entidad_id, $email_destinatario, $informacion = null)
	{
		$notificacion = $this->prepararNotificacionCorreo($evento, $entidad_id, $email_destinatario, $informacion);
	
		if ($notificacion == false)
			return false;
	
		return $this->_saveNotificacion($notificacion);
	}
	
	
	
	/**
	 *
	 * Prepara un modelo de notificacion de corre con sus datos.
	 * @param unknown_type $evento Descriptor del evento que tipifica la notificacion.
	 * @param unknown_type $entidad_id En caso de algunas plataformas es el id de entrada dela tabla
	 * raiz que contiene los datos de la notificacion
	 * @param unknown_type $destinatario Destinatario de la notificacion, depende de la plataforma
	 * @param unknown_type $informacion
	 * @return boolean
	 */
	function prepararNotificacionCorreo($evento, $entidad_id, $email_destinatario, $informacion = null)
	{
		$evento = getConfigEventoNotificacion($evento);
			
		if (!isset($evento['EMAIL']))
		{
			$this->log(array(
					'Error' => 'Error en prepararNotificacionCorreo($evento, $entidad_id, $informacion = null)',
					'Error' => 'La notiticacion no es un email.',
					'$evento' => $evento,
					'Entidad' => "Entidad id: [$entidad_id], Informacion: [$informacion]",
			));
	
			return false;
		}

	
		$notificacion = $this->create();
	
		$notificacion['Notificacion']['fecha_creacion'] 	= Ahora();
		$notificacion['Notificacion']['codigo'] 			= $evento['CODIGO'];
		$notificacion['Notificacion']['destinatario'] 		= $email_destinatario;
		$notificacion['Notificacion']['entidad_id'] 		= $entidad_id;
		$notificacion['Notificacion']['prioridad'] 			= $evento['PRIORIDAD'];
		$notificacion['Notificacion']['informacion'] 		= $informacion;
		$notificacion['Notificacion']['codigo_plataforma'] 	= Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.CODIGO');
	
		return $notificacion;
	}
	



	/**
	 * Guarda la notificacion en la base de datos. Si no lo logra deja log.
	 * @param unknown_type $notificacion Modelo de notificacion
	 * @return boolean
	 */
	function _saveNotificacion($notificacion)
	{
		if ($this->save($notificacion, true))
		{
			return true;
		}
		else
		{
			$this->log(array(
					'=============================== NotificacionModel::_saveNotificacion INI ===============================',
					'Error' => 'Error en: Notificacion->crearNotificacion',
					'Datos' => $notificacion,
					'$this->validationErrors' => $this->validationErrors,
					'=============================== _saveNotificacion FIN ==============================='
			));
	
			return false;
		}
	
	}


	/**
	 * Retorna las notificaciones pendientes por enviar
	 * @param unknown_type $plataformas Array con los codigos de plataforma para filtrar las notificaciones
	 * @return Ambigous <multitype:, NULL, boolean, mixed>
	 */
	function getNotificacionesPendientes($plataformas = array())
	{
		$fecha_minima = new DateTime();	

		$condiciones =  array(
				'Notificacion.enviada' => 0, // el false tiene que colocarse como 0
				'Notificacion.codigo_plataforma' => $plataformas,
		);
	
	
		$notificaciones = $this->find('all',
				array(
						'conditions' => $condiciones,
						'order' => array(
								'Notificacion.prioridad DESC',
								'Notificacion.fecha_creacion ASC'
						),
						'recursive' => -1
				)
		);
	
		return $notificaciones;
	
	}
	
	
	/**
	 *
	 * Funcion que permite cargar los datos de la entidad perteneciente a la notificacion requeridos ç
	 * para contruir el correo electronico a enviarse
	 * @param unknown_type $modelo
	 * @param unknown_type $id_entidad
	 * @param unknown_type $recursive
	 */
	function getDatosEvento($evento)
	{
		$modelo = &ClassRegistry::init($evento['MODELO']);
	
		return $modelo->getParaNotificacion($evento['Notificacion']['entidad_id']);		
	}	

}