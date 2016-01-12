<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Banco Model
 *
 * @property Banco $Banco
 */
class Tiendacourier extends AppModel {

    public $useTable = 'tiendacourier';

      public $belongsTo = array(
  'Tienda' => array(
        'className' => 'Tienda',
        'foreignKey' => 'tienda_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ), 
    'Courier' => array(
        'className' => 'Courier',
        'foreignKey' => 'courier_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
  );

}