<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('Component', 'Controller');

/**
 * Direcciones Controller
 *
 * @property Direcciones $Direcciones
 * @property PaginatorComponent $Paginator
 */

class DireccionesController extends AppController  {
   var $uses = array('Direccion', 'Provincia');

 public function nueva_direccion(){

    $this->layout = 'direccion';
  
    //se buscan la cantidad de direcciones que ya posee el usuario
    $actualUser = $this->viewVars['actualUser'];
    $provinciaIDs= $this->Provincia->find('list', array('fields' => 'Provincia.descripcion', 'order' => array( 'Provincia.descripcion' => 'asc'), 'recursive' => -1));
    $Cantidad_de_direcciones = count($this->Direccion->verificarDireccion($actualUser['Usuario']['id']));
    //si ya posee 4 direcciones es redirigido al metodo ver_direccion
    if($Cantidad_de_direcciones>=Configure::read('TIVIA_CONFIG.DIRECCION.CANTIDAD_DE_DIRECCIONES'))
    {
      $this->redirect(array('controller' => 'direcciones', 'action' => 'ver_direccion'));
    }

   	if($this->request->is('post'))
   	{ 
      //si el usuario guarda y continua 
      $this->request->data['Direccion']['usuario_id'] = $actualUser['Usuario']['id'];
      if($this->Direccion->save($this->request->data))
      {
        if(isset($this->request->data['Guardar_continuar']))
        {
          $this->redirect(array('controller' => 'orders', 'action' => 'checkout'));
        }
        else
        {
          $this->request->data = null;
          $Cantidad_de_direcciones++;
        }
      }
      else
      {
        $this->Session->setFlash(__('Los datos no se guardaron correctamente'), 'flash_bad');
      }
   	}
   $this->set(compact('Cantidad_de_direcciones','provinciaIDs'));
  }


  public function ver_direccion(){
    $this->layout = 'store';
    $actualUser = $this->viewVars['actualUser'];
    $ds_direcciones = $this->Direccion->verificarDireccion($actualUser['Usuario']['id']);
    $this->set(compact('ds_direcciones', 'estado'));
  }

  public function editar_direccion($direccion_id = null)
  {
   	$this->layout = 'store';
    $actualUser = $this->viewVars['actualUser'];
    $provinciaIDs= $this->Provincia->find('list', array('fields' => 'Provincia.descripcion', 'order' => array( 'Provincia.descripcion' => 'asc'), 'recursive' => -1));
    //se buscan los datos a editar para luego mostrarlos
    $direccionEditar = $this->Direccion->Find('first', array('conditions' => array('Direccion.id' => $direccion_id), 'recursive' => -1));
    //si no es el usuario logueado,  no viene una direccion o la direccion no exite lo redirige al metodo ver_direccion
    if($direccionEditar == null or $direccion_id == null or $direccionEditar['Direccion']['usuario_id'] != $actualUser['Usuario']['id'])
    {
      $this->redirect(array('controller' => 'direcciones', 'action' => 'ver_direccion'));
    }
  	
    if($this->request->is(array('post', 'put')))
   	{
   		$this->request->data['Direccion']['usuario_id'] = $actualUser['Usuario']['id'];
 	   	//se establece el id para poder hacer un update
 	   	$this->Direccion->id = $direccionEditar['Direccion']['id'];
 	    if($this->Direccion->save($this->request->data))
 	    {
 	      $this->redirect(array('controller' => 'orders', 'action' => 'checkout'));
 	    }
 	    else
 	    {
 	     $this->Session->setFlash(__('Los datos no se guardaron correctamente'), 'flash_bad');
 	    }
   	}
   	else
   	{   
   		//como no es post se colocan los datos a editar en los campos correspondientes
	  	/*$this->request->data['Direccion']['nombre_completo']= $direccionEditar['Direccion']['nombre_completo'];
	    $this->request->data['Direccion']['telefono']= $direccionEditar['Direccion']['telefono'];
	    $this->request->data['Direccion']['ciudad']= $direccionEditar['Direccion']['ciudad'];
	    $this->request->data['Direccion']['direccion']= $direccionEditar['Direccion']['direccion'];
      */
	  $this->request->data['Direccion'] = $direccionEditar['Direccion'];     
      $provincia = $direccionEditar['Direccion']['provinciaID'];      
      
      $this->set(compact('provincia', 'provinciaIDs'));
	  }  
  }

  public function eliminar_direccion($direccion_id = null)
  {
    $actualUser = $this->viewVars['actualUser'];
    $direccionEliminar = $this->Direccion->Find('first', array('conditions' => array('Direccion.id' => $direccion_id), 'recursive' => -1));
    //si se encuentra una direccion, si viene una direccion y es el usuario logueado, se elimina.
    if($direccionEliminar != null and $direccion_id != null and $direccionEliminar['Direccion']['usuario_id'] == $actualUser['Usuario']['id'])
    {
      $this->Direccion->eliminarDireccion($direccion_id);
    }
  	$this->redirect(array('controller' => 'orders', 'action' => 'checkout'));
  }
}