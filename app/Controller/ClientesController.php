<?php
App::uses('AppController', 'Controller');

class ClientesController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow(array('login', 'logout', 'add'));        
        parent::beforeFilter();
    } 

    public $paginate = array(
        'fields' => array('Cliente.id', 'Cliente.nome', 'Cliente.rua', 'Cliente.numero', 'Cliente.cep', 'Cliente.telefone'),
        'conditions' => array('Cliente.deleted IS NULL'),
        'limit' => 10,
        'order' => array('Cliente.nome' => 'asc')    
    );

    public function setPaginateConditions() {
        $filtro = '';
        if ($this->request->is('post')) {
            $filtro = $this->request->data['Cliente']['filtro'];
            $this->Session->write('Cliente.filtro', $filtro);
        } else {
            $filtro = $this->Session->read('Cliente.filtro');
            $this->request->data('Cliente.filtro', $filtro);
        }
        if (!empty($filtro)) {
            $this->paginate['conditions']['or'] = array(
                'Cliente.nome LIKE' => '%' .trim($filtro) . '%'
            );
        }
    }

    public function add(){
        if(!empty($this->request->data)){
            $this->request->data['Cliente']['aro_parent_id'] = 2;
            $this->Cliente->create();
            if($this->Cliente->save($this->request->data)){
                $this->Flash->bootstrap('Cliente cadastrado com sucesso', array('key' => 'success'));
                $this->redirect('/login'); 
            }
        }
    }

    public function edit($id = null) {
        if(!empty($this->request->data)){
            if($this->Cliente->save($this->request->data)){                
                $this->Flash->bootstrap('Alteração realizada com sucesso', array('key' => 'success'));
                $this->redirect('/');
            }
        } else {
            $fields = array('Cliente.id', 'Cliente.nome', 'Cliente.rua', 'Cliente.numero', 'Cliente.cep', 'Cliente.telefone');
            $conditions = array('Cliente.id' => $id, 'Cliente.deleted' => null);
            $this->request->data = $this->Cliente->find('first', compact('fields', 'conditions'));
        }        
    }

    public function view($id = null) {
        $fields = array('Cliente.id', 'Cliente.nome', 'Cliente.rua', 'Cliente.numero', 'Cliente.cep', 'Cliente.telefone');
        $conditions = array('Cliente.id' => $id, 'Cliente.deleted' => null);
        $this->request->data = $this->Cliente->find('first', compact('fields', 'conditions'));
    }

    public function login() {
        $this->layout = 'login';
         if ($this->request->is('post')) {
             if ($this->Auth->login()) {
                 return $this->redirect($this->Auth->redirectUrl());
             }
             $this->Flash->bootstrap('Usuário e/ou senha incorretos', array('key' => 'danger'));
         }
     }
 
    public function logout() {
        $this->Auth->logout();
        $this->Session->destroy();
        $this->redirect('/');        
    }

}