<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Banco Model
 *
 * @property Banco $Banco
 */
class Color extends AppModel {

    public $useTable = 'color';

    public function getColorAtr($ds_colores)
    {
    	foreach($ds_colores as $key => $ds_color)
    	{
    		$conditions = array('Color.id' => $ds_color['color_id']);
    		$descripcion = $this->find('first', array('conditions' => $conditions,  'recursive' => -1, 'fields' => 'descripcion'));

    		$ds_colores[$key]['descripcion'] = $descripcion['Color']['descripcion'];
    	}

    	return $ds_colores;
    }

}