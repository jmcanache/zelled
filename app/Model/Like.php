<?php
App::uses('AppModel', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Like extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
  public $useTable = 'like';
 
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
      'Producto' => array(
          'className' => 'Producto',
          'foreignKey' => 'producto_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
  );

  function verificarUsuarioSigueTienda($usuario_id, $tienda_id)
  {
    $this->log($usuario_id);
    $this->log($tienda_id);
  }
  
  function likeProduct($usuario_id, $producto_id){
  	$conditions = array('Like.producto_id' => $producto_id, 'Like.usuario_id' => $usuario_id);
  	$liked = $this->find('first', array('fields' => array('id'),'conditions' => $conditions,  'recursive' => -1));

  	if(!empty($liked))
  	{
  		return true;
  	}
  	else
  	{
  		return false;
  	}
  
  }

  /** get los favoritos de un usuario**/
  function likeUsuario($usuario_id, $limit)
  {
    //Carga un modelo dentro de otro
    $foto_modelo = ClassRegistry::init('Foto');

    $array_like= $this->find('all', array('fields' => array('producto_id'),'conditions' => array("Like.usuario_id" => $usuario_id ), 'limit' => $limit));
         
        foreach($array_like as $foto)
        {
          $fotos_a_mostrar= $foto_modelo->find('first', array('conditions' => array('Foto.producto_id'=> $foto['Like']['producto_id']), 'recursive' => 2));
          $ds_data[] = array(
          'Foto' => array('ruta_thumb' => $fotos_a_mostrar['Foto']['ruta_thumb']),
          'Producto' => array('id' => $fotos_a_mostrar['Producto']['id'],
              'nombre' => $fotos_a_mostrar['Producto']['nombre'],
              'descripcion' => $fotos_a_mostrar['Producto']['descripcion_corta'],
              'precio' => $fotos_a_mostrar['Producto']['precio'],
              'tienda_id' => $fotos_a_mostrar['Producto']['tienda_id'],
          	  'likes' => $fotos_a_mostrar['Producto']['likes'],
			        'UsuarioLike' => $fotos_a_mostrar['Producto']['Like']));
        }
    
        if (empty($ds_data))
        {
          return null;
        }
        else
        {
          return $ds_data;
        }
     
  }


}