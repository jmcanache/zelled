<?php
App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Carrito extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = false;

/**
 * Display field
 *
 * @var string
 */
	/*
	 * add a product to cart
	*/
	public function addProduct($productId,$sessionName,$qty= null) {			
		/*$allProducts = $this->readProduct($sessionName);        
		if (!empty($allProducts)) {           
			if (array_key_exists($productId, $allProducts)) {			    
				$allProducts[$productId]= $qty;
			} else {			    
				$allProducts[$productId] = $qty;
			}
		} else {		   
			$allProducts[$productId] = $qty;
		}		
		$this->saveProduct($allProducts,$sessionName);	*/
		$allProducts = $this->readProduct($sessionName);  
		$allProducts[$productId] = $qty;
		$this->saveProduct($allProducts,$sessionName);	
	}
	
	/*
	 * remove a product from cart
	*/
	public function removeProduct($productId,$sessionName) {
		$allProductsTemp = $this->readProduct($sessionName);		
		if (!empty($allProductsTemp)) {
			if (array_key_exists($productId, $allProductsTemp)) {				
				$producto_modelo = ClassRegistry::init('Producto');
				foreach ($allProductsTemp as $p => $count) {
					$product = $producto_modelo->read('id',$p);
					if ($product['Producto']['id'] == $productId) {
						unset($allProductsTemp[$productId]);
					}
					//$this->log($product['Producto']['id']);
				}
				$this->saveProduct($allProductsTemp,$sessionName); 
			}
		}
	}
	 
	/*
	 * get total count of products
	*/
	public function getCount($sessionName) {
		//$this->log($sessionName);
		$allProducts = $this->readProduct($sessionName);
		if (count($allProducts)<1) {
			return 0;
		}		
		$count = 0;
		foreach ($allProducts as $product) {
			$count=$count+$product;
		}		
		//$this->log($allProducts);
		return $count;
	}
	
	
	/*
	 * save data to session
	*/
	public function saveProduct($data, $sessionName) {		
		return CakeSession::write($sessionName, $data);		
	}
	
	/*
	 * read cart data from session
	*/
	public function readProduct($sessionName) {
	  return CakeSession::read($sessionName);
	}
	/*
	 * delete data from session
	*/
	public function deleteProduct($data, $sessionName) {
		return CakeSession::delete($sessionName, $data);
	}
	/*
	 * delete session
	*/
	public function deleteSession($sessionName) {
		return CakeSession::delete($sessionName);
	}
	
	


}