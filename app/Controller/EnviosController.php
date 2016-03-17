<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

class EnviosController extends AppController  {

  var $uses = array('Order','Envio','Notificacion', 'Usuario', 'Tienda');
  
  public function notifica_envio($envio_id, $order_id)
  {
    $dataSource = $this->Envio->getDataSource();
    $dataSource->begin();

    $this->Envio->id = $envio_id;
    if($this->Envio->saveField('enviado', 1) and $this->Envio->saveField('status_pago', 3) and $this->Envio->saveField('fecha_envio', date('Y-m-d H:i:s')))
    {
      $dataSource->commit();
      $cliente_id = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id), 'fields' => array('Order.usuario_id'), 'recursive' => -1));
      $cliente_email = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $cliente_id['Order']['usuario_id']), 'fields' => array('Usuario.login'), 'recursive' => -1));
      $this->Notificacion->insertarNotificacionCorreo('CONFIRMACION_ENVIO', $envio_id, $cliente_email['Usuario']['login'], null);
    }
    else
    {
      $dataSource->rollback();
      $this->Session->setFlash(__('Ocurrio un error al notificar el envio, por favor comuniquese con Tivia'), 'flash_bad');
    }
    return $this->redirect(array('controller' => 'orders', 'action' => 'myordersstore'));
  }

  public function notifica_recibido($envio_id, $tienda_id)
  {
    $this->Envio->id = $envio_id;
    if($this->Envio->saveField('status_pago', 4))
    {
      $ventas_totales = $this->Tienda->find('first', array('conditions' => array('Tienda.id' => $tienda_id), 'fields' => array('Tienda.ventas_totales'), 'recursive' => -1));
      $ventas_totales_actualizada = $ventas_totales['Tienda']['ventas_totales'] + 1;
      $this->Tienda->id = $tienda_id;
      if(!$this->Tienda->saveField('ventas_totales', $ventas_totales_actualizada))
      {
        $this->Session->setFlash(__('Ocurrio un error al notificar el envio recibido, por favor comuniquese con Tivia'), 'flash_bad');
      }
    }
    return $this->redirect(array('controller' => 'orders', 'action' => 'myordersclient'));
  }
}