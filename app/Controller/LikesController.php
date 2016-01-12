
<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class
App::uses('Component', 'Controller');

class LikesController extends AppController  {

	var $uses = array('Like', 'Usuario');

	function ver_favoritos($limit = null)
	{
        $this->layout = 'store';
		$ds_data = $this->Like->likeUsuario($this->viewVars['actualUser']['Usuario']['id'], $limit);
		$data = $this->Usuario->findById($this->viewVars['actualUser']['Usuario']['id']);
		$this->set(compact('ds_data', 'data'));
	}

}