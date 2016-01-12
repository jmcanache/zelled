<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Direccion extends AppModel {

	public $useTable = 'direccion';

  public $belongsTo = array(
    'Provincia' => array(
        'className' => 'Provincia',
        'foreignKey' => 'provinciaID',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
  );


	public $validate = array(
    'nombre_completo' => array(
        'notemptyRule' => array(
            'rule' => array('notempty'),
            'message' => 'El nombre no debe estar vacío',
        ),
        'minLengthRule' => array(
            'rule' => array('minLength', 2),
            'message' => 'Mínimo de 2 caracteres'
        ),
          'maxLengthRule' => array(
              'rule' => array('maxLength', 40),
              'message' => 'Maximo de 300 caracteres'
        ),        
    ), 
    'telefono' => array(
        'notemptyRule' => array(
          'rule' => array('notempty'),
          'message' => 'El telefono no debe estar vacío',
        ),
        'telefonoyRule' => array(
          'rule' => array('phone', '/^(04)(12|14|16|24|26)([0-9]{7,7})/', 've'),
          'message' => 'Se requiere un numero de teléfono movil válido. Ejem: 04xxxxxxxxx',
        ),
    ),    
    'direccion' => array(
        'minLengthRule' => array(
            'rule' => array('minLength', 2),
            'message' => 'Mínimo de 2 caracteres'
        ),
          'maxLengthRule' => array(
              'rule' => array('maxLength', 300),
              'message' => 'Maximo de 300 caracteres'
        ),
        'notemptyRule' => array(
            'rule' => array('notempty'),
            'message' => 'La direccion no debe estar vacía',
        ),        
    ), 
    'ciudad' => array(
        'notemptyRule' => array(
            'rule' => array('notempty'),
            'message' => 'La ciudad no debe estar vacía',
        ),
        'alphaRule' => array(
            'rule' => '/^[a-zA-Z]{3,35}$/i',
            'message' => 'Solo letras permitidos. Max 35 caracteres.',
         ),          
    ), 	


      'ciudad' => array(
       'notempty' => array(
         'rule' => array('custom', '/^[a-z A-ZáéíóúÁÉÍÓÚñÑäëïöüÄËÏÖÜ]{5,}$/i'),
         'message' => 'La ciudad no puede estar vacia, contener numeros y minimo 5 caracteres'
        ),
       'maxlength' => array(
		      'rule' => array('maxlength', 30)
        )
      ),

      'telefono' => array(
       'phone' => array(
         'rule' => array('phone', '/^(04)(12|14|16|24|26)([0-9]{7,7})/', 've'),
         'message' => 'Se requiere un numero de teléfono movil válido. Ejem = 04xxxxxxxxx '
        )
      )
    );


	// retorna un array con las direcciones del usuario conectado
	public function verificarDireccion($usuario_id){
     return $this->Find('all', array('conditions' => array('Direccion.usuario_id' => $usuario_id)));
        
	}

	// elimina una direccion
	public function eliminarDireccion($direccion_id){
		$this->delete($direccion_id);
	}
}