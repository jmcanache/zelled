<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Metodotransferencia extends AppModel {

	public $useTable = 'metodotransferencia';

	public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $validate = array(
    'referencia' => array(
        'notempty' => array(
          'rule' => array('notempty'),
          'message' => 'La transferencia no puede estar vacio',
        ),
        'minlength' => array(
          'rule' => array('minlength', 5),
          'message' => 'El numero de transferencia debe contener minimo 5 numeros'
        ),
        'numeric' => array(
          'rule' => array('naturalNumber'),
          'message' => 'Ingrese solo numeros')
      )
  );

}