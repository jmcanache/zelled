<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');

class Pago extends AppModel {

  public $useTable = 'pago';

  public $belongsTo = array(
    'Tienda' => array(
        'className' => 'Tienda',
        'foreignKey' => 'tienda_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
    'Order' => array(
        'className' => 'Order',
        'foreignKey' => 'order_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
  );
}