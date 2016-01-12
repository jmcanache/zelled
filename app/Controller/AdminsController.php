<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');
App::uses('Validation', 'Utility');

class AdminsController extends AppController  {

	public $components = array('imagenesUtilidades', 'Paginator');
	var $uses = array('Foto', 'Producto','Tienda','Like');
	public $helpers = array('Js' => array('Jquery'));



	function admin()
	{
		$this->layout = 'store';
		//data productos de tienda
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$datos = $this->Tienda->getcomunData($tienda_id);
		if(isset($datos['data']))
		{
			$data = $datos['data'];
		}
		else
		{
			$data = null;
		}
		$this->set(compact('data'));


	}

	function admin_productos()
	{
		$this->layout = 'ajax';
		$actualUser = $this->viewVars['actualUser'];
		$tienda_id = $actualUser['Tienda']['id'];
		$datos = $this->Tienda->getcomunData($tienda_id);
		if(isset($datos['data']))
		{
			$data = $datos['data'];
		}
		else
		{
			$data = null;
		}
		$this->set(compact('data'));

	}

	function admin_orders()
	{
		$this->layout = 'ajax';

	}

}
