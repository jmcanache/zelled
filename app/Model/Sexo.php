<?php
App::uses('AppModel', 'Model');
/**
 * Solicitude Model
 *
 * @property Card $Card
 */
class Sexo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sexo';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

  public $hasMany = array(
      'Usuario' => array(
        'className' => 'Usuario',
        'foreignKey' => 'sexo_id',
        'dependent' => false,
        'conditions' => '',
        'fields' => '',
        'order' => '',
        'limit' => '',
        'offset' => '',
        'exclusive' => '',
        'finderQuery' => '',
        'counterQuery' => ''
        )
  );
	
}