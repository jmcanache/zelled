<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class OrderDetail extends AppModel {

	public $useTable = 'orderdetail';

	public $belongsTo = array(
        'Producto' => array(
            'className' => 'Producto',
            'foreignKey' => 'producto_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
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
        )
    );
	
	public $hasMany = array(		
			'OrderDetailAttr' => array(
					'className' => 'OrderDetailAttr',
					'foreignKey' => 'orderdetail_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
	);
  
   
    function findDetailOrderRealizada($order_id, $tienda_id)
    {
        $direccion = ClassRegistry::init('Direccion');
        $banco = ClassRegistry::init('Banco');
        $envio = ClassRegistry::init('Envio');

        $productos = $this->find('all', array('conditions' => array('OrderDetail.order_id' => $order_id, 'OrderDetail.tienda_id' => $tienda_id), 'recursive' => 0));
        $courier = $envio->find('first', array('conditions' => array('Envio.order_id' => $productos[0]['OrderDetail']['order_id'], 'Envio.tienda_id' => $productos[0]['OrderDetail']['tienda_id']), 'fields' => array('Envio.courier'), 'recursive' => -1));
        $productos[0]['OrderDetail']['courier'] = $courier['Envio']['courier']; 
        $ds_direccion = $direccion->findById($productos[0]['Order']['direccion_id']);        
        $ds_banco =  (isset($productos[0]['Order']['banco_id']) ? $banco->findById($productos[0]['Order']['banco_id']) : array());        
        $ds_order = array_merge($productos, $ds_direccion, $ds_banco);
		return $ds_order;
    } 
}