<?php
App::uses('AppModel', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Seguidor extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
  public $useTable = 'seguidor';

/**
 * Display field
 *
 * @var string
 */
  public $displayField = 'id';

  public $belongsTo = array(
      'Usuario' => array(
          'className' => 'Usuario',
          'foreignKey' => 'usuario_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Tienda' => array(
          'className' => 'Tienda',
          'foreignKey' => 'tienda_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
  );

  function verificarUsuarioSigueTienda($usuario_id, $tienda_id)
  {
    //busca el array en seguidores para comprobar si existe
    $conditions_seguidor = array("tienda_id" => $tienda_id, "usuario_id" => $usuario_id);
    $seguid = $this->find('first', array('conditions' => $conditions_seguidor,  'recursive' => -1));
    //$this->log($seguid);
    if(empty($seguid))
    {
      return array('seguidores_id' => 'nada', 'TF' => false);
    }
    else
    {
      return array('seguidores_id' => $seguid['Seguidor']['id'], 'TF' => true);
    }
    
  }

  public function tiendasQueSigo($usuario_id)
  {
    $producto_modelo = ClassRegistry::init('Producto');
    $datos=array();
    $ds_data= $this->find('all', array('conditions' => array('usuario_id' => $usuario_id), 'recursive' => -1, 'fields' =>'tienda_id', 'order' => 'rand()'));
    
    foreach($ds_data as $data)
    {
     //se buscan 3 tiendas que el usuario sigue de manera random
     $dato=$producto_modelo->find('first', array('conditions' => array('Producto.tienda_id' => $data['Seguidor']['tienda_id'])));
     if(!empty($dato['Producto']))
      {
        $datos[]= $data['Seguidor']['tienda_id'];
      }
     }
     return $datos;
  }
}