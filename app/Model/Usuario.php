<?php
App::uses('AppModel', 'Model');

/**
 * Usuario Model
 */
class Usuario extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'usuario';

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'nombre';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'grupo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Identificador de grupo no válido',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'login' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El login no puede estar en blanco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
					'rule' => array('email'),
					'message' => 'El login debe ser una dirección de email válida.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 128),
				'message' => 'El login no puede superar los 128 caracteres de longitud',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
			    'rule' => array('isUnique'),
			    'message' => 'El login ya se encuentra registrado.',
			    //'allowEmpty' => false,
			    //'required' => false,
			    //'last' => false, // Stop validation after this rule
			    //'on' => 'create', // Limit validation to 'create' or 'update' operations
			),

		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El password no puede estar en blanco',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password2' => array(
		    'compare'    => array(
		        'rule'      => array('validate_passwords'),
		        'message' => 'Las claves no coinciden',
		    )
		),
		'clave_recuperacion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'La clave de recuperación no cumple con la longitud requerida.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'El indicador de usuario activo no es válido.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'correo_validado' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'El indicador de validez de la cuenta no es válido.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nombre' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre  no puede estar en blanco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 40),
				'message' => 'El nombre no puede superar los 40 caracteres de longitud.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'pattern' => array(
					'rule' => array('custom', '/^[a-zA-Z\s]+$/i'),
					'message' => 'Solo letras son permitidas en este campo.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),			
		),
		'apellido' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'El nombre  no puede estar en blanco',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', 40),
				'message' => 'El apellido no puede superar los 40 caracteres de longitud.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'pattern' => array(
					'rule' => array('custom', '/^[a-zA-Z\s]+$/i'),
					'message' => 'Solo letras son permitidas en este campo.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Sexo' => array(
				'className' => 'Sexo',
				'foreignKey' => 'sexo_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		)
	);

	 public $hasOne = array(
      'Tienda' => array(
          'className' => 'Tienda',
          'foreignKey' => 'usuario_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
 	  'Usuariobanco' => array(
 				'className' => 'Usuariobanco',
 				'foreignKey' => 'usuario_id',
 				'conditions' => '',
 				'fields' => '',
 				'order' => ''
 		)
  );

	public $hasMany = array(
			'Seguidor' => array(
					'className' => 'Seguidor',
					'foreignKey' => 'usuario_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password']))
		{
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		if (isset($this->data[$this->alias]['login']))
		{
			$this->data[$this->alias]['login'] = strtolower($this->data[$this->alias]['login']);
		}

		/*if (isset($this->data[$this->alias]['email']))
		{
			$this->data[$this->alias]['email'] = strtolower($this->data[$this->alias]['email']);
		}*/

		return true;
	}


	/**
	 * Esta funcion debe ser llamada para setear y encriptar el password de un usuario ya creado en base de datos,
	 * con el objetivo de que pueda hacer login.
	 *
	 * Lo demás se debe hacer manualmente.
	 *
	 * No olvides colocar el id del usuario correcto y establecer el password a tu gusto.
	 */
	public function setpassword()
	{
		// Comentar este return para poder usar la funcion y comentarlo una vez terminado el uso.
		return ;

		$usuario = array(
				'id' => 1,
				'password' => 'lnxkdjfghsuhtr'
		);

		$this->save($usuario);

		$usuario = array(
				'id' => 2,
				'password' => '9476nvfhsdhgj'
		);

		$this->save($usuario);

		$usuario = array(
				'id' => 3,
				'password' => 'isihtulshuhfvs'
		);

		$this->save($usuario);

	}
	public function validate_passwords() {
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password2'];
	}


	function getParaNotificacion($id)
	{
		//return $this->findById($id);
		$conditions = array("Usuario.id" => $id);

		$valor = $this->find('first', array('conditions' => $conditions,  'recursive' => 1));
		//$this->log($valor);
		return $valor;
	}

	public function __findNombresDeCliente($ds_orders)
	{
		$cont = 0;
		foreach ($ds_orders as $order) 
		{
		  $nombre_de_cliente = $this->find('first', array('conditions' => array('Usuario.id' => $order['Order']['usuario_id'])));
		  $ds_orders[$cont]['Order']['nombre_cliente'] = $nombre_de_cliente['Usuario']['nombre'];
		  $cont++;
		}
		return $ds_orders;
	}

}