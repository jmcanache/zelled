<?php
App::uses('AppModel', 'Model');
/**
 * Solicitude Model
 *
 * @property Card $Card
 */
class Suscriptor extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'suscriptor';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $validate = array(
               'email' => array(
                       'email' => array(
                                       'rule' => array('email'),
                                       'message' => 'El login debe ser una dirección de email válida.',
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
               )
               );
	
}