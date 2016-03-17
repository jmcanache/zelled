<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Productocolor extends AppModel {

	public $useTable = 'productocolor';

	public $belongsTo = array(
    'Producto' => array(
        'className' => 'Producto',
        'foreignKey' => 'producto_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
    'Color' => array(
        'className' => 'Color',
        'foreignKey' => 'color_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
  );

function getRelatedData($producto_id)
{

	$conditions = array("Productocolor.producto_id" => $producto_id);
	return $this->find('first', array('conditions' => $conditions,  'recursive' => -1));

}
}