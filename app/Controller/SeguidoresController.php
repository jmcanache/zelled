<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

/**
 * Seguidores Controller
 *
 * @property Seguidores $Seguidores
 * @property PaginatorComponent $Paginator
 */
class SeguidoresController extends AppController  {

  /**
 * Components
 *
 * @var array
 */
  var $uses = array('Seguidor', 'Tienda', 'Producto');
  public $components = array('Imgupload', 'imagenesUtilidades');

  public function follow_store ($tienda_id = null) //puse un id fijo de una tienda que existe para probar. Usar uno que exista en db.
  {
    $this->layout = 'store';
    $actualUser = $this->viewVars['actualUser'];
    //identificar si el usuario ya sigue a la tienda, usar este metodo verificarUsuarioSigueTienda en el modelo seguidor para la logica.
    $loSigue = $this->Seguidor->verificarUsuarioSigueTienda($actualUser['Usuario']['id'], $tienda_id);
    
    //busca el array de la tienda para luego extraer el dato de seguidores
    $seguidores = $this->Tienda->find('first', array('conditions' => array('id'=>$tienda_id), 'recursive'=>-1, 'fields' => 'Tienda.seguidores'));
    $numSeguid = $seguidores['Tienda']['seguidores'];
    //para futura modificacion del campo seguidores
    $this->Tienda->id=$tienda_id;

    if($loSigue['TF'] == true){
      $this->Seguidor->delete($loSigue['seguidores_id']);
      $numSeguid--;
      $this->Tienda->saveField('seguidores', $numSeguid);
    }
    else{
        $this->Seguidor->save(array('tienda_id' => $tienda_id, 'usuario_id' => $actualUser['Usuario']['id']));
        $numSeguid++;
        $this->Tienda->saveField('seguidores', $numSeguid);
    }
    $this->redirect(array('controller' => 'Tiendas', 'action' => 'view_store', $tienda_id));
    
  }

 function Ver_seguidores()
  {
    $this->layout = 'store';
    $actualUser = $this->viewVars['actualUser'];
    $usuario_id =  $this->viewVars['actualUser']['Usuario']['id']; 
    $tiendas_seguidas= $this->Seguidor->tiendasQueSigo($usuario_id);
    if(empty($tiendas_seguidas)){
    $tienda_aleatoria= null;
     }
    else{
          $tiendas= $this->Tienda->find('all', array( 'conditions' => array('Tienda.id' => $tiendas_seguidas), 'fields' => array('Tienda.id', 'Tienda.nombre', 'Tienda.seguidores'), 'order' => 'rand()'));

          foreach($tiendas as $tienda){
    
          unset($data);
          for($x = 0; $x < 4; $x++)
          {
            $dato=$this->Producto->find('all', array('conditions' => array('Producto.tienda_id' => $tienda['Tienda']['id']), 'order'=>'rand()', 'limit' => 1));
            $data[] =
            array('ruta_thumb' =>$dato[0]['Foto'][0]['ruta_thumb'],
           'producto_id' => $dato[0]['Producto']['id'],
             'tienda_id' => $tienda['Tienda']['id'],
             'tienda_nombre' => $tienda['Tienda']['nombre'],
             'tienda_seguidores' => $tienda['Tienda']['seguidores']);
          }
         $tienda_aleatoria[]=$data;
         }
        }
        
    $data = $this->viewVars['actualUser'];
       
    $this->set(compact('tienda_aleatoria', 'data')); 
  }

}