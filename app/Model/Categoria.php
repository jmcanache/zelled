<?php
App::uses('AppModel', 'Model');
/**
 * Categoria Model
 *
 * @property Notificacion $Notificacion
 */
class Categoria extends AppModel {


	public $actsAs = array('Tree');
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'categoria';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    public function getCategoriasPadre($value='')
    {
        $condiciones = array('Categoria.parent_id' => null);
        return $this->find('list', array('conditions' => $condiciones, 'order' => array('lft' => 'ASC'), 'fields' => 'Categoria.name'));       
	}

    public function getChildren($name_id)
    {
        $children = $this->children($name_id, true);
        return Hash::combine($children, '{n}.Categoria.id', '{n}.Categoria.name');
    }
}