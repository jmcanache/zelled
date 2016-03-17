<?php
App::uses('AppModel', 'Model');
/**
 * Solicitude Model
 *
 * @property Notificacion $Notificacion
 */
class Foto extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'foto';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	public $belongsTo = array(
			'Producto' => array(
					'className' => 'Producto',
					'foreignKey' => 'producto_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	public function getThumbByproductId($ds_productos)
	{
		foreach($ds_productos as $key => $ds_producto)
		{
			$conditions = array('Foto.producto_id' => $ds_producto['Producto']['id']);
			$thumb = $this->find('first', array('conditions' => $conditions,  'recursive' => -1, 'fields' => 'ruta_thumb'));

			$ds_productos[$key]['ruta_thumb'] = $thumb['Foto']['ruta_thumb'];
		}

		return $ds_productos;
	}
}