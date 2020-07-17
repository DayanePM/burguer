<?php
App::uses('AppController', 'Controller');

class PedidosController extends AppController {

    public function beforeFilter() {
        $this->Auth->allow(array('index'));
        $this->Auth->mapActions(['update' => ['finalizar', 'status']]); 
        $this->Auth->mapActions(['read' => ['detalhar']]);      
        parent::beforeFilter();
    }

    public $uses = array('Pedido', 'Item', 'Produto');

    public $paginate = array(
        'contain' => array('Cliente'),
        'fields' => array('Pedido.id', 'Pedido.created', 'Pedido.total', 'Pedido.status', 'Cliente.id', 'Cliente.nome', 'Cliente.telefone'),
        'conditions' => array('Pedido.deleted IS NULL'),
        'limit' => 10,
        'order' => array('Pedido.created' => 'asc')    
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

    public function edit($id = null) {
        $this->Session->write('pedidoId', $id);
        $fields = array('Item.id', 'Item.pedido_id', 'Item.produto_id');
        $conditions = array('Item.pedido_id' => $id, 'Item.deleted IS NULL');
        $items = $this->Item->find('all', compact('fields', 'conditions'));

        $produtos = $this->buscaProdutos($items);
        $this->set('produtos', $produtos);
    }

    public function buscaProdutos($items){
        foreach($items as $item) {
            $fields = array('Produto.id', 'Produto.nome', 'Produto.descricao', 'Produto.preco');
            $conditions = array('Produto.id' => $item['Item']['produto_id']);
            $produtos[] = array('Produto' => $this->Produto->find( 'first', compact('fields', 'conditions')), 'Item' => $item['Item']['id']);
        }

        return $produtos;
    }

    public function finalizar($id, $total){
        if (!empty($id)) {
            $this->Pedido->id = $id;
            $this->Pedido->saveField('status', 'Aguardando Confirmacao');
            $this->Pedido->saveField('total', $total);
            $this->Flash->set('Pedido Enviado', array('params' => array('class' => 'alert alert-success')));
            $this->Session->delete('pedidoId');
            $this->redirect('/');
        }
    }

    public function view($id = null) {
        $contain = false;
        $fields = array('Pedido.id', 'Pedido.created', 'Pedido.total', 'Pedido.cliente_id', 'Pedido.status');
        $order = array('Pedido.created' => 'desc');
        $conditions = array('Pedido.cliente_id' => $id);
        $pedidos = $this->Pedido->find('all', compact('contain', 'fields', 'conditions', 'order'));

        $this->set('pedidos', $pedidos);
    }

    public function detalhar($pedidoId = null) {
        $fields = array('Item.id', 'Item.pedido_id', 'Item.produto_id');
        $conditions = array('Item.pedido_id' => $pedidoId, 'Item.deleted IS NULL');
        $item = $this->Item->find('first', compact('fields', 'conditions'));

        $fields = array('Produto.id', 'Produto.nome', 'Produto.descricao', 'Produto.preco', 'Produto.foto');
        $conditions = array('Produto.id' => $item['Item']['produto_id']);
        $produtos[] = array('Produto' => $this->Produto->find( 'first', compact('fields', 'conditions')));

        $this->set('produtos', $produtos);

    }

    public function status($pedidoId, $status){
        if (!empty($pedidoId) && !empty($status)) {
            $this->Pedido->id = $pedidoId;
            $this->Pedido->saveField('status', $status);
            $this->Flash->set('Status Alterado com Sucesso', array('params' => array('class' => 'alert alert-success')));

            $this->redirect('/pedidos/index');
        }
        //$this->autoRender = false;
    }

}