<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class

/**
 * Users Controller
 *
 * @property Notificacion $Notificacion
 * @property PaginatorComponent $Paginator
 */
class NotificacionesController extends AppController {


	var $uses = array();
}