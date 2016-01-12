<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class OrderDetailAttr extends AppModel {

	public $useTable = 'orderdetailattr';
  
	function findAttrOrder($order_id, $tienda_id) // TODO: para buscar atributos de la orden
	{
		
	}
}