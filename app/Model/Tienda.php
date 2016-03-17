<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Tienda extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'tienda';

	public $components = array('Imgupload');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

  public $hasMany = array(
      'Producto' => array(
          'className' => 'Producto',
          'foreignKey' => 'tienda_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
	'Seguidor' => array(
			'className' => 'Seguidor',
			'foreignKey' => 'tienda_id', 
			'conditions' => '',
			'fields' => '',
			'order' => ''
	),
      'Envio' => array(
          'className' => 'Envio',
          'foreignKey' => 'tienda_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Pago' => array(
          'className' => 'Pago',
          'foreignKey' => 'tienda_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
  		'Tiendacourier' => array(
  				'className' => 'Tiendacourier',
  				'foreignKey' => 'tienda_id',
  				'conditions' => '',
  				'fields' => '',
  				'order' => ''
  		),
  );


 public $belongsTo = array(
      'Usuario' => array(
          'className' => 'Usuario',
          'foreignKey' => 'usuario_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Provincia' => array(
        'className' => 'Provincia',
        'foreignKey' => 'provinciaID',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
    'Ciudad' => array(
        'className' => 'Ciudad',
        'foreignKey' => 'ciudad_id',
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
                'Tienda.nombre'
            )
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
    'slogan' => array(
        'minLengthRule' => array(
            'rule' => array('minLength', 2),
            'message' => 'Mínimo de 2 caracteres'
        ),
          'maxLengthRule' => array(
              'rule' => array('maxLength', 50),
              'message' => 'Maximo de 50 caracteres'
        ),
          'notemptyRule' => array(
            'rule' => array('notempty'),
            'message' => 'El slogan no debe estar vacío',
        ),
    ),
    'bio' => array(
        'minLengthRule' => array(
            'rule' => array('minLength', 2),
            'message' => 'Mínimo de 2 caracteres'
        ),
        'maxLengthRule' => array(
            'rule' => array('maxLength', 350),
            'message' => 'Maximo de 350 caracteres'
        ),
        'notemptyRule' => array(
          'rule' => array('notempty'),
          'message' => 'La bio no debe estar vacía',
        ),
    ),
    'telefono' => array(
        'notemptyRule' => array(
          'rule' => array('notempty'),
          'message' => 'El telefono no debe estar vacío',
        ),
        'telefonoyRule' => array(
          'rule' => array('phone', '/^(04)(12|14|16|24|26)([0-9]{7,7})/', 've'),
          'message' => 'Se requiere un numero de teléfono movil válido. Ejem = 04xxxxxxxxx',
        ),
        'uniqueRule' => array(
          'rule' => array('isUnique'),
          'message' => 'Este número ya se encuentra registrado.',
        ),
    ),
  	/* 'couriers' => array(
  		'notemptyRule' => array(
  			'rule' => array('notempty'),
  			'required' => true,
  			'message' => 'Debe seleccionar al menos un metodo de envio',
  		),  				
  	), */
  );


		function getRelatedData($tienda_id)
		{
			$this->Producto->unbindModel(array('belongsTo' => array('Tienda')));
      		$this->Usuario->unbindModel(array('hasOne' => array('Tienda')));
      		$this->unbindModel(array('hasMany' => array('Producto', 'Seguidor', 'Envio', 'Pago')));

			$conditions = array('Tienda.id' => $tienda_id);
			return $this->find('first', array('conditions' => $conditions,  'recursive' => 2));

		}

		function getcomunData($tienda_id)
		{
      $producto = ClassRegistry::init('Producto');
			$data = $this->getRelatedData($tienda_id);
      $productos = $producto->find('all', array('conditions' => array('Producto.tienda_id' => $tienda_id), 'order' => array('Producto.created' => 'desc')));
      
      //$this->log($data);
			
      if(empty($productos))
			{
				return array('data' => $data);
			}
			else
			{
				foreach($productos as $foto)
				{
					$ds_data[] = array(
							'Foto' => array('thumb' => $foto['Foto'][0]['ruta_thumb']),
							'Producto' => array('id' => $foto['Producto']['id'],
									'nombre' => $foto['Producto']['nombre'],
									'descripcion' => $foto['Producto']['descripcion_corta'],
									'precio' => $foto['Producto']['precio'],
									'tienda_id' => $tienda_id,
							        'likes' => $foto['Producto']['likes'],
							'UsuarioLike' => $foto['Like']
							
							
							)
					);
				}
				
				return array('data' => $data, 'ds_data' => $ds_data);
			}
		}

		/*
		**Funcion que comprueba que el dueño de la tienda, esta en su vista. Para esto se pregunta si el usuario en sesion y la tienda_id pertecen al el mismo.
		*/
		function esDuenoTienda($tienda_id, $tienda_id_usuario)
		{

			if($tienda_id_usuario == $tienda_id)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validacionEspecial($data)
		{
			//validar el campo bio (por alguna razon el modelo no lo esta haciendo. Revisarlo)
			if(empty($data['Tienda']['bio'])){
				//$this->Session->setFlash(__('La bio no pueda estar vacía, ingrese entre 20 y 530 caracteres', true), 'error_message');
				return false;
			}

			//validamos que ambas imagenes vengan, pues con esa data se trabaja antes de llegar al save. El resto de los campos los valida el modelo.
			if($data['Tienda']['logo']['error'] == 4 || $data['Tienda']['banner']['error'] == 4  || empty($data) ){
				//$this->Session->setFlash(__('Recuerda cargar las imágenes de Logo y Banner, así como el resto de la info requerida', true), 'error_message');
				return false;
			}

			return true;
		}


	public function tiendas_random($tiendas_seguidas=null,  $limit=3)
  {
    // $tienda_id sera la condicion en la busqueda de $tiendas  
    $tienda_id=null;

    // si $tiendas_seguidas no esta en null es porque se llamo a la funcion desde el controlador de usuarios
    if($tiendas_seguidas  != null)
    {
    	$tienda_id= array('Tienda.id' => $tiendas_seguidas);
    }
   
    $tiendaVacia= True;

    //se buscan 3 tiendas random
    $tiendas= $this->find('all', array( 'conditions' => $tienda_id, 'fields' => array('Tienda.id', 'Tienda.nombre', 'Tienda.seguidores'), 'order' => 'rand()','limit' => Configure::read('TIVIA_CONFIG.FOTO.CANTIDAD_TIENDAS_DESCUBRE')));

    $producto_modelo = ClassRegistry::init('Producto');
    
    while ($tiendaVacia==True)
    {
      //se buscan 3 tiendas random
      $tiendas= $this->find('all', array( 'conditions' => $tienda_id, 'fields' => array('Tienda.id', 'Tienda.nombre', 'Tienda.seguidores'), 'order' => 'rand()','limit' => $limit));

      foreach($tiendas as $tienda)
      {
    
    	  if(empty($tienda['Producto']) and $limit=3)
        {
          $tiendaVacia=True; 
          unset($ds_data);
          break;
   	    }
      	elseif(!empty($tienda['Producto']))    	
      	{	
          $tiendaVacia=False;
          unset($data);
          for($x = 0; $x < 4; $x++)
          {
            $dato=$producto_modelo->find('all', array('conditions' => array('Producto.tienda_id' => $tienda['Tienda']['id']), 'order'=>'rand()', 'limit' => 1));
		    $data[] =
            array('ruta_thumb' =>$dato[0]['Foto'][0]['ruta_thumb'],
           'producto_id' => $dato[0]['Producto']['id'],
             'tienda_id' => $tienda['Tienda']['id'],
             'tienda_nombre' => $tienda['Tienda']['nombre'],
             'tienda_seguidores' => $tienda['Tienda']['seguidores']);
          }
          $ds_data[]=$data;
        }
      }
	 }
	 return $ds_data;
  }
}