<?php
App::uses('AppModel', 'Model');
App::uses('Component', 'Model');
/**
 * Tienda Model
 *
 * @property Tienda $Tienda
 */
class Costoenvio extends AppModel {

	public $useTable = 'costoenvio';

	public $belongsTo = array(
    'Producto' => array(
        'className' => 'Producto',
        'foreignKey' => 'producto_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
        )
      );

    public $validate = array(
        'costo' => array(
            'comparisonRule' => array(
                'rule' => array('comparison', '>=', 100),
                'message' => 'Costo minimo de envio de 100 Bs.'
            ),
            'naturalNumberRule' => array(
              'rule' =>array('custom', '/^[0-9]{2,}$/i'),
              'message' => 'Solo enteros positivos',
            ),
            'notemptyRule' => array(
              'rule' => array('notempty'),
              'message' => 'El costo de envio no debe estar vacío',
            ),
        )
    );
}