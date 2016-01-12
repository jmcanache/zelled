<?php
App::uses('AppModel', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Producto extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'producto';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	  public $belongsTo = array(
	      'Tienda' => array(
	          'className' => 'Tienda',
	          'foreignKey' => 'tienda_id',
	          'conditions' => '',
	          'fields' => '',
	          'order' => ''
	      ),
	      'Categoria' => array(
	        'className' => 'Categoria',
	        'foreignKey' => 'categoria_id',
	        'conditions' => '',
	        'fields' => '',
	        'order' => ''
	      )

	  );

	public $hasMany = array(
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'producto_id',
			'dependent'=> true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Like' => array(
			'className' => 'Like',
			'foreignKey' => 'producto_id',
			'dependent'=> true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
      	'OrderDetail' => array(
          'className' => 'OrderDetail',
          'foreignKey' => 'producto_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
        ),
        'Productotalla' => array(
          'className' => 'Productotalla',
          'foreignKey' => 'producto_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
        ),
		'Productocolor' => array(
					'className' => 'Productocolor',
					'foreignKey' => 'producto_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
		),
        'Costoenvio' => array(
			'className' => 'Costoenvio',
			'foreignKey' => 'producto_id',
			'dependent'=> true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $actsAs = array(
    	'search-master.Searchable'
	);

	public $filterArgs = array(
		'nombre' => array(
        'type' => 'like', 'field' => array(
            'Producto.nombre')
    	)
	);


  	public $validate = array(
	    'nombre' => array(
	        'minLengthRule' => array(
	            'rule' => array('minLength', 2),
	            'message' => 'Mínimo de 2 caracteres'
		    ),
	       	'maxLengthRule' => array(
	            'rule' => array('maxLength', 38),
	            'message' => 'Maximo de 38 caracteres'
		    ),
	       	'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'El nombre no debe estar vacío',
	        ),
		),
	   'descripcion_corta' => array(
	        'minLengthRule' => array(
	            'rule' => array('minLength', 3),
	            'message' => 'Mínimo de 3 caracteres'
		    ),
	       	'maxLengthRule' => array(
	            'rule' => array('maxLength', 60),
	            'message' => 'Maximo de 60 caracteres'
		    ),
	       	'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'La descripcion corta no debe estar vacía',
	        ),
		),
	   'descripcion_larga' => array(
	        'minLengthRule' => array(
	            'rule' => array('minLength', 3),
	            'message' => 'Mínimo de 3 caracteres'
		    ),
	       	'maxLengthRule' => array(
	            'rule' => array('maxLength', 300),
	            'message' => 'Maximo de 300 caracteres'
		    ),
	       	'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'La descripcion larga no debe estar vacía',
	        ),
		),
	    'precio' => array(
	       	'comparisonRule' => array(
	            'rule' => array('comparison', '>=', 20),
	            'message' => 'Precio minimo de 20 Bs.'
		    ),
	       	'naturalNumberRule' => array(
	          'rule' =>array('custom', '/^[0-9]{2,}$/i'),
	          'message' => 'Solo enteros positivos',
	        ),
	        'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'El precio no debe estar vacío',
	        ),
		),
		'peso' => array(
	       	'comparisonRule' => array(
	            'rule' => array('comparison', '>=', 1),
	            'message' => 'Peso minimo de 1 gramo.'
		    ),
	        'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'El peso no debe estar vacío',
	        ),
		),
		'materiales' => array(
	      'minLengthRule' => array(
	            'rule' => array('minLength', 2),
	            'message' => 'Mínimo de 2 caracteres'
		    ),
	       	'maxLengthRule' => array(
	            'rule' => array('maxLength', 100),
	            'message' => 'Maximo de 100 caracteres'
		    ),
	        'notemptyRule' => array(
	          'rule' => array('notempty'),
	          'message' => 'La lista de materiales no debe estar vacia',
	        ),
		),

	  );

	function getRelatedData($producto_id)
	{

	  	$this->Tienda->unbindModel(array('belongsTo' => array('Producto')));

	  	$conditions = array("Producto.id" => $producto_id);
	  	return $this->find('first', array('conditions' => $conditions,  'recursive' => 2));

	}

	/*
	** Se trae un RANDOM de imagenes para mostrar en el home en el bloque inspirate.
	*/

	function ProductosInspirate()
	{

		$random = $this->find('all', array('recursive' => -1, 'order' => 'rand()', 'limit' => Configure::read('TIVIA_CONFIG.FOTO.CANTIDAD_FOTOS')));

	    //Carga un modelo dentro de otro
	    $foto_modelo = ClassRegistry::init('Foto');

        foreach($random as $foto)
        {
         $fotos_a_mostrar= $foto_modelo->find('first', array('conditions' => array('Foto.producto_id'=> $foto['Producto']['id']), 'fields' => array('Foto.ruta_thumb')));
         $this->unbindModel(array('hasMany' => array('Foto')));
         $producto = $this->find('first', array('conditions' => array('Producto.id'=> $foto['Producto']['id']), 'recursive' => 1));

         $ds_data[] = array(
		          'Foto' => array('ruta_thumb' => $fotos_a_mostrar['Foto']['ruta_thumb']),
		          'Producto' => array('id' => $producto['Producto']['id'],
	              'nombre' => $producto['Producto']['nombre'],
	              'descripcion' => $producto['Producto']['descripcion_corta'],
	              'precio' => $producto['Producto']['precio'],
	              'tienda_id' => $producto['Producto']['tienda_id'],
		          'likes' => $producto['Producto']['likes'],
				  'UsuarioLike' => $producto['Like']));
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

	//Se utiliza en order::checkout
	public function getProductosCheckout($productos_ids)
	 {
	 	//Carga un modelo dentro de otro
	    $fotoyproducto = ClassRegistry::init('Foto');
	    $isFirst = true;
	    $subtotal = 0;

		//$this->log($productos_ids);

        foreach($productos_ids as $id => $cant)
        {
          $this->unbindModel(array('hasMany' => array('Foto', 'Like', 'OrderDetail', 'Categoria')));
          $this->Tienda->unbindModel(array('hasMany' => array('Producto', 'Seguidor', 'Envio', 'Pago')));
          $getproductos= $fotoyproducto->find('first', array('conditions' => array('Foto.producto_id'=> $id), 'recursive' => 3));
          $this->log($getproductos);

          $ds_productos[] = array(
          'Foto' => array('ruta_thumb' => $getproductos['Foto']['ruta_thumb']),
          'Producto' => array('id' => $getproductos['Producto']['id'],
              'nombre' => $getproductos['Producto']['nombre'],
              'descripcion' => $getproductos['Producto']['descripcion_corta'],
              'precio' => $getproductos['Producto']['precio'],
          	  'cantidad' => $cant),
          'Tienda' => array('id' => $getproductos['Producto']['Tienda']['id'],
          	  'nombre' => $getproductos['Producto']['Tienda']['nombre'],
          	  'logo' => $getproductos['Producto']['Tienda']['logo'],
          	  'couriers' => Configure::read('TIVIA_CONFIG.COURIERS.'.$getproductos['Producto']['Tienda']['couriers']))
          );

          $subtotal = ($getproductos['Producto']['precio'] * $cant) + $subtotal;

          //llamar funcion que calcula envio

		  if($isFirst)
		  {
	        $ds_tiendas[] =array(
	           'Tienda' => array('id' => $getproductos['Producto']['Tienda']['id'],
	          	  'nombre' => $getproductos['Producto']['Tienda']['nombre'],
	          	  'logo' => $getproductos['Producto']['Tienda']['logo'],
	          	  'couriers' => Configure::read('TIVIA_CONFIG.COURIERS.'.$getproductos['Producto']['Tienda']['couriers']),
	          	  'login' => $getproductos['Producto']['Tienda']['Usuario']['login']),
	          	'Costoenvio' => $getproductos['Producto']['Costoenvio']);

	        $isFirst = false;
		  }
		  else
		  {
		  	$repetido_id_tienda = false;

		    foreach ($ds_tiendas as $tienda)
		    {
		    	if(($tienda['Tienda']['id'] == $getproductos['Producto']['Tienda']['id']))
		    	{
		    		$repetido_id_tienda = true;
		    	}
	        }
          	if(!($repetido_id_tienda))
          	{
		        $ds_tiendas[] =array(
		           'Tienda' => array('id' => $getproductos['Producto']['Tienda']['id'],
		          	  'nombre' => $getproductos['Producto']['Tienda']['nombre'],
		          	  'logo' => $getproductos['Producto']['Tienda']['logo'],
		          	  'couriers' => Configure::read('TIVIA_CONFIG.COURIERS.'.$getproductos['Producto']['Tienda']['couriers']),
		          	  'login' => $getproductos['Producto']['Tienda']['Usuario']['login']),
		          	'Costoenvio' => $getproductos['Producto']['Costoenvio']);
          	}
		  }
		}


        $ds_productos_tiendas = array($ds_productos, $ds_tiendas, $subtotal);
        return $ds_productos_tiendas;

	}

	public function ActualizacionDeProductos($productos_ids)
    {
	    foreach ($productos_ids as $key => $value)
	    {
	      $producto = $this->find('first', array('conditions' => array('Producto.id' => $key), 'recursive' => -1));
	      $producto['Producto']['existencia'] = $producto['Producto']['existencia'] - $value;
	      $this->save($producto);
	    }
  	}
}