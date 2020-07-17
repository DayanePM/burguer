<?php
App::uses('AppController', 'Controller');

class ProdutosController extends AppController {

    public $uses = array('Produto', 'Item', 'Pedido');

    public function beforeFilter() {
        $this->Auth->allow(array('cardapio'));
        $this->Auth->mapActions(['read' => ['cardapio']]);      
        parent::beforeFilter();
    }

    public $paginate = array(
        'fields' => array('Produto.id', 'Produto.nome', 'Produto.preco', 'Produto.tipo'),
        'conditions' => array('Produto.deleted IS NULL'),
        'limit' => 10,
        'order' => array('Produto.nome' => 'asc')    
    );

    public function setPaginateConditions() {
        $filtro = '';
        if ($this->request->is('post')) {
            $filtro = $this->request->data['Produto']['filtro'];
            $this->Session->write('Produto.filtro', $filtro);
        } else {
            $filtro = $this->Session->read('Produto.filtro');
            $this->request->data('Produto.filtro', $filtro);
        }
        if (!empty($filtro)) {
            $this->paginate['conditions']['or'] = array(
                'Produto.nome LIKE' => '%' .trim($filtro) . '%'
            );
        }
    }

    public function add(){
        if(!empty($this->request->data)){
            if(!empty($this->request->data['Produto']['foto'])){
                move_uploaded_file($this->request->data['Produto']['foto']['tmp_name'], PATHFOTO . DS . $this->request->data['Produto']['foto']['name']);
                $this->request->data['Produto']['foto'] = $this->request->data['Produto']['foto']['name'];
            }
            $this->Produto->create();
            if($this->Produto->save($this->request->data)){
                $this->Flash->bootstrap('Produto cadastrado com sucesso', array('key' => 'success'));
                $this->redirect('/produtos'); 
            }
        }
    }

    public function edit($id = null) {
        if(!empty($this->request->data)){
            if($this->Produto->save($this->request->data)){                
                $this->Flash->bootstrap('Alteração realizada com sucesso', array('key' => 'success'));
                $this->redirect('/produtos');
            }
        } else {
            $fields = array('Produto.id', 'Produto.nome', 'Produto.preco', 'Produto.descricao', 'Produto.tipo');
            $conditions = array('Produto.id' => $id, 'Produto.deleted' => null);
            $this->request->data = $this->Produto->find('first', compact('fields', 'conditions'));
        }        
    }

    public function view($id = null) {
        $fields = array('Produto.id', 'Produto.nome', 'Produto.foto', 'Produto.preco', 'Produto.tipo', 'Produto.descricao');
        $conditions = array('Produto.id' => $id);
        $this->request->data = $this->Produto->find('first', compact('fields', 'conditions'));

        $produto = $this->Produto->find('first', compact('fields', 'conditions'));
        $this->set('produto', $produto);
    }

    public function cardapio() {
        $tipo = array('Hamburguer', 'Bebida', 'Acompanhamento', 'Sobremesa');
        $fields = array('Produto.id', 'Produto.nome', 'Produto.foto', 'Produto.preco', 'Produto.tipo', 'Produto.descricao');
        $conditions = array('Produto.deleted IS NULL', 'Produto.tipo' => $tipo);
        $produtos = $this->Produto->find('all', compact('fields', 'conditions'));
        $this->set('produtos', $produtos);       
    }

}