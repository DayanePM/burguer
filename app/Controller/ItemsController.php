<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

    public $uses = array('Item', 'Pedido', 'Produto');

    public function add($produtoId) {
        $this->request->data['Pedido']['cliente_id'] = $this->Auth->user('id');
        if(!empty($this->request->data) && empty($this->Session->read('pedidoId'))){
            $this->Pedido->create();
            if($this->Pedido->save($this->request->data)){
                $pedidoId = $this->Pedido->getInsertID();
                $this->Session->write('pedidoId', $pedidoId);
                $this->salvaItem($produtoId, $pedidoId);
            }
            $this->redirect('/');
        } else {
            if(!empty($this->request->data) && !empty($this->Session->read('pedidoId'))){
                $this->salvaItem($produtoId, $this->Session->read('pedidoId'));
            }
        }

    }

    public function salvaItem($produtoId, $pedidoId) {
        $this->request->data['Item']['pedido_id'] = $pedidoId;
        $this->request->data['Item']['produto_id'] .= $produtoId;
        if(!empty($this->request->data)){
            $this->Item->create();
            if($this->Item->save($this->request->data)){
                $this->Flash->bootstrap('Item adicionado ao carrinho', array('key' => 'success'));
            }
            $this->redirect('/');
        }

    }

    public function delete($id) {
        if (!empty($id)) {
            $this->Item->id = $id;
            $this->Item->saveField('deleted', date('Y-m-d H:i:s'));
            $this->Flash->set('Produto excluído com sucesso!.', array('params' => array('class' => 'alert alert-success')));
            $this->redirect('/pedidos/edit/' . $this->Session->read('pedidoId'));
        }
    }

}