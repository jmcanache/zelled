<?php

App::uses('AppModel', 'Model');
App::uses('Component', 'Model');

class Envio extends AppModel {

  public $useTable = 'envio';

  public $belongsTo = array(
    'Tienda' => array(
        'className' => 'Tienda',
        'foreignKey' => 'tienda_id',
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
    )
  );
  public $validate = array(
          'courier' => array(
            'rule' => array('inList', array('MRW', 'DHL', 'DOMESA')),
            'required' => true
          )
        );

  function getParaNotificacion($envio_id)
  {      
    $orderDetail = classRegistry::init('OrderDetail');
    $direccion = classRegistry::init('Direccion');
    $usuario = classRegistry::init('Usuario');

    $orderDetail->unbindmodel(array('belongsTo' => array('Order', 'Tienda')));
    $usuario->recursive = -1;

    $envio = $this->findById($envio_id);
    $ds_orderdetail = $order_detail = $orderDetail->find('all', array('conditions' => array('OrderDetail.order_id' => $envio['Order']['id'], 'OrderDetail.tienda_id' => $envio['Tienda']['id']), 'recursive' => 0));
    $direccion_envio = $direccion->findById($envio['Order']['direccion_id']);
    $comprador = $usuario->findById($envio['Order']['usuario_id']);

    $foto = ClassRegistry::init('Foto');
    foreach ($ds_orderdetail as $key => $data)
    {
      $thumb = $foto->find('first', array('conditions' => array('Foto.producto_id' => $data['Producto']['id']),'fields' => array('ruta_thumb','producto_id'), 'recursive' => 0));
      $order_detail[$key]['Foto'] = $thumb;
    }

    array_push($envio, $order_detail, $direccion_envio, $comprador);
    return $envio;
  }
}