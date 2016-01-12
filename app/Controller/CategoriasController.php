<?php
App::uses('AppController', 'Controller');
App::uses('Group', 'Model');
App::uses('CakeEmail', 'Network/Email'); // this should be placed before your Controller Class

class CategoriasController extends AppController {

    public function index() {
       //$data = $this->Categoria->generateTreeList();
        //debug($data); die;
      //  $this->Categoria->recover();debug(); die;

        //$allChildren = $this->Categoria->children(1);
       // $this->log($allChildren);
       // $directChildren = $this->Categoria->children(1, true);
      //  $parent = $this->Categoria->getParentNode(2);
        //$this->log($parent);
       // debug($allChildren); die;
       $this->log();

    }
}
