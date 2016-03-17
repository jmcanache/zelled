<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Productotalla extends AppModel {

	public $useTable = 'productotalla';

	public $belongsTo = array(
    'Producto' => array(
        'className' => 'Producto',
        'foreignKey' => 'producto_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
    'Talla' => array(
        'className' => 'Talla',
        'foreignKey' => 'talla_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
  );

function getRelatedData($producto_id)
{

	$conditions = array('Productotalla.producto_id' => $producto_id);
	return $this->find('first', array('conditions' => $conditions,  'recursive' => -1));

}
}