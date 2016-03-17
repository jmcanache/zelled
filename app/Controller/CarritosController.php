<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');
App::uses('Validation', 'Utility');

class CarritosController extends AppController  {

	public $components = array('imagenesUtilidades', 'Paginator');
	var $uses = array('Foto', 'Producto','Tienda','Like','Carrito');
	public $helpers = array('Js' => array('Jquery'));

	public function add($producto_id,$sessionName) { //Anade producto y cantidad a la sesion especificada
		$this->autoRender = false;	
		if ($this->request->is('POST')) {		  
		  $quantity = 1; //en caso que la funcion sea llamada desde el elemento products toma 1 por defecto
		  if($this->request->data['Compra']['cantidad']>1){$quantity = $this->request->data['Compra']['cantidad']; }
		   $this->Carrito->addProduct($producto_id, $sessionName, $quantity);
		   //para sesion de atributos	
		  // $this->log($this->request->data);
		   if($this->Session->read('atributos')){//En caso de mas de un producto con atributos
			   	if (isset($this->request->data['Compra']['Color']) && ($this->request->data['Compra']['Color']<>'-- Seleccione --')){
			   		$datacolor[] =  array('producto_id'=>$producto_id,'atributo' => 'Color', 'valor' => $this->request->data['Compra']['Color']);
			   		CakeSession::write('atributos', am($this->Session->read('atributos'),$datacolor));
			   	}
			   	if (isset($this->request->data['Compra']['Talla']) && ($this->request->data['Compra']['Talla']<>'-- Seleccione --')){
			   		$datatalla[] =  array('producto_id'=>$producto_id,'atributo' => 'Talla', 'valor' => $this->request->data['Compra']['Talla']);
			   		CakeSession::write('atributos', am($this->Session->read('atributos'),$datatalla));
			   	}
		   }else{	 
			   if (isset($this->request->data['Compra']['Color']) && ($this->request->data['Compra']['Color']<>'-- Seleccione --')){ 
				   	$data[] =  array('producto_id'=>$producto_id,'atributo' => 'Color', 'valor' => $this->request->data['Compra']['Color']);		   
				   	CakeSession::write('atributos',$data);
			   }
			   if (isset($this->request->data['Compra']['Talla']) && ($this->request->data['Compra']['Talla']<>'-- Seleccione --')){
				   	$data[] =  array('producto_id'=>$producto_id,'atributo' => 'Talla', 'valor' => $this->request->data['Compra']['Talla']);
				   	CakeSession::write('atributos',$data);
			   }
		   }
		   //$this->log($this->Session->read('atributos'));		  
		}			
		$content_compra = $this->Carrito->getCount($sessionName);	
        $this->set(compact('content_compra'));
        $this->render('/Elements/ajax_compra', 'ajax');		
	}
	
	public function checkout_cart($producto_id,$sessionName1,$sessionName2){ //pasa producto y cantidad seleccionado a otra sesion
		$this->autoRender = false;
		$cartProducts = $this->Session->read($sessionName1);
		if ($this->request->is('post')) {
			if (!empty($cartProducts) and (Set::check($cartProducts,$producto_id))) {
				foreach ($cartProducts as $cartProduct => $count) {
					if ($cartProduct == $producto_id) {
						$this->Carrito->addProduct($producto_id, $sessionName2, $count );
					}
				}
			}
		}
	}
	
	public function update_cart($producto_id,$sessionUpdate,$newValue = null){ //actualiza carrito en caso de cambio de cantidades
		$this->autoRender = false;
		$cartProducts = $this->Session->read($sessionUpdate);
			if (!empty($cartProducts) and (Set::check($cartProducts,$producto_id))) {				
				foreach ($cartProducts as $cartProduct => $count) {
					if ($cartProduct == $producto_id) {						
						$this->Carrito->addProduct($producto_id, $sessionUpdate, $newValue );						
					}
				}
			}
	}
	
	public function remove($producto_id,$sessionName,$sessionNameRemove=null) {  //borra producto de la sesion especificada
		$this->autoRender = false;
		if ($this->request->is('post')) {			
			$this->Carrito->removeProduct($producto_id, $sessionNameRemove);
			if($this->Session->read('atributos')){ //si el producto tiene atributo eliminar
				$atributos = $this->Session->read('atributos');
				foreach($atributos as $key => $atr)
				{
					if($producto_id == $atr['producto_id']){						
						unset($atributos[$key]);
					}
				}
				CakeSession::write('atributos', $atributos);
			}
			
		}

		$content_compra = $this->Carrito->getCount($sessionNameRemove);
		$this->set(compact('content_compra'));
		$this->render('/Elements/ajax_compra', 'ajax');
	}
	
	public function removeall() {  //eliminar sesion
	
		$this->Session->setFlash(__('¿Deseas eliminar todos los producto de la cesta?'), 'flash_question');	
		$this->redirect(array('action' => 'view_cart', 'cart'));
		/*  $this->autoRender = false;		
		if ($this->request->is('post')) {			
			$this->Carrito->deleteSession($sessionName);
		}
		$content_compra =  $this->Carrito->getCount($sessionName);
		$this->set(compact('content_compra'));
		$this->render('/Elements/ajax_compra', 'ajax');	 */
	}
	
    public function view_cart($sessionName) { //permite visualizar sesion especificada
    	$this->layout = 'store';
    	CakeSession::delete('checkout'); // necesario borrar session checkout en caso de estar en Orders/checkout y se da click en el carrito    	
    	$carts = $this->Carrito->readProduct($sessionName);
		$products = array();
		if (null!=$carts) {		  
			foreach ($carts as $productId => $count) {				  		
 	          $product = $this->Producto->read(null,$productId);  //para leer datos como la existencia, precio...  	                 
              array_push($product, $count);             
			//$product['Product']['count'] = $count;
			  $products[]=$product;// 
			}
		}        
		$this->set(compact('products'));	
	}
		
	public function flash_response($response=null){
		if($response){					
			$this->removeallSession('cart');
			$this->removeallSession('checkout');
			$this->layout = 'store';
			//$this->redirect(array('action' => 'seguir_comprando'));			
		}else{ 			
			$this->redirect(array('action' => 'view_cart', 'cart'));
		}
	}
	
	public function removeallSession($sessionName) {  //eliminar sesion
		$this->autoRender = false;	
		if ($this->request->is('post')) {
			$this->Carrito->deleteSession($sessionName);
		}
		$content_compra =  $this->Carrito->getCount($sessionName);
		$this->set(compact('content_compra'));
		$this->render('/Elements/ajax_compra', 'ajax');
	}
	
	public function seguir_comprando(){
		$this->layout = 'store';
	}
	
	

}
