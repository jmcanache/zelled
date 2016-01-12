<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Banco Model
 *
 * @property Banco $Banco
 */
class Talla extends AppModel {

    public $useTable = 'talla';
    
    public function getTallaAtr($ds_tallas)
    {
    	foreach($ds_tallas as $key => $ds_talla)
    	{
    		
    		$conditions = array('Talla.id' => $ds_talla['talla_id']);
    		$descripcion = $this->find('first', array('conditions' => $conditions,  'recursive' => -1, 'fields' => 'descripcion'));
    
    		$ds_tallas[$key]['descripcion'] = $descripcion['Talla']['descripcion'];
    	}
    
    	return $ds_tallas;
    }

}