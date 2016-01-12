<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array(
			'Html',
			'Form',
			'Session',
			'Number',
			'Text',
			'Time',
			'ConvertNumber',
			'Js'
	);

	var $uses = array('Usuario');

	public $components = array(
			'Session',
			'Auth' => array(
					'allowedActions' => array(
							'registro_usuario',
							'confirmarEmail',
							'display',
							'insert',
							'index',
							'view_store',
							'accede',
							'detail',
							'home',
							'gallery',
							'add',
							'view_cart',
							'reset_password',
							'resetpassword_fromemail',
							'requestvalidationemail',
							'motor_de_busqueda',
							'remove',
							'checkout_cart',
							'update_cart',
							'removeall',
							'flash_response'
					),
					'authenticate' => array(
							'Form' => array(
									'userModel' => 'Usuario',
									'fields' => array(
											'username' => 'login',
											'password' => 'password'
									),
									'scope' => array(
											'Usuario.activo' => true,
											'Usuario.correo_validado' => true,
									),
							),
					),
					'authorize' => 'Controller',
					'unauthorizedRedirect' => array(
							'controller' => 'pages',
							'action' => 'home'
					),
					'loginAction' => array(
							'controller' => 'usuarios',
							'action' => 'login'
					),

					'logoutRedirect' => array(
							'controller' => 'pages',
							'action' => 'home'
					),

					'loginRedirect' => array(
							'controller' => 'usuarios',
							'action' => 'perfil_usuario'
					),
			),
	);


	public function isAuthorized()
	{
		return true;
	}

	function beforeFilter()
	{
		$user = $this->Auth->user();

		$actualUser = null;

		if(!empty($user))
		{
			if(array_key_exists('Usuario', $user)){
				$usuario_id =  $user['Usuario']['id'];
			}
			else
			{
				$usuario_id =  $user['id']; 	
			}

			$actualUser = $this->Usuario->findById($usuario_id);
		}

		
		$this->set('actualUser', $actualUser);
		$this->set('user', $user);
	}
}
