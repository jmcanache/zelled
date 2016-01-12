
<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

class ColoresController extends AppController  {

	var $uses = array('Producto', 'Usuario');

	

}