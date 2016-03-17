<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Usuariobanco extends AppModel {

	public $useTable = 'usuariobanco';

	public $belongsTo = array(
    'Usuario' => array(
          'className' => 'Usuario',
          'foreignKey' => 'usuario_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
     )
    );
	public $validate = array(
			'cedula' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'La cedula no debe estar vacio',
					),
					'numerico' => array(
							'rule' => array('numeric'),
							'message' => 'Debe ingresar un numero valido',
					),
					'naturalNumber' => array(
							'rule' => array('custom', '/^[0-9]{2,}$/i'),
							'message' => 'Solo enteros positivos',
					),
			),
			'nro_cuenta' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'El numero de cuenta no debe estar vacio',
					),
					'numerico' => array(
							'rule' => array('comparison', '>', 0),
							'message' => 'Debe ingresar un numero valido',
					),
					'natural' => array(
							'rule' => array('custom', '/^[0-9]{2,}$/i'),
							'message' => 'Solo enteros positivos',
					),
					'between' => array(
							'rule' => array('maxLength', 20),
							'message' => 'Cuenta debe estar compuesta por 20 numeros'
					),
			),
	);
	
function getRelatedData($usuario_id)
{

	$conditions = array("UsuarioBanco.usuario_id" => $usuario_id);
	return $this->find('first', array('conditions' => $conditions,  'recursive' => -1));

}
}