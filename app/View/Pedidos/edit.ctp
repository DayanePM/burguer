<?php

$total = 0;
foreach ($produtos as $produto) {
    $remover = $this->Js->link('Remover', '/items/delete/' . $produto['Item'], array('update' => '#content'));
    $total += $produto['Produto']['Produto']['preco'];
    $burguers[] = array(      
        $produto['Produto']['Produto']['nome'],
        $produto['Produto']['Produto']['descricao'],
        $produto['Produto']['Produto']['preco'],
        $remover
    );
}

echo $this->Flash->render('warning'); 
echo $this->Flash->render('success');


echo $this->Html->tag('h2', 'Meu Carrinho');
$burguerBody = $this->Html->tableCells($burguers);
echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
    $this->Html->tag('table', $burguerBody, array('class' => 'table table-borderless'))
);

echo $this->Html->tag('h4', 'Total = ' . $total, array('class' => 'float-right mr-5'));

echo $this->Js->link('Adicionar Produto', '/', array('class' => 'btn btn-secondary', 'update' => '#content'));
echo $this->Js->link('Enviar Pedido', '/pedidos/finalizar/' . $this->Session->read('pedidoId') . '/' . $total, array('class' => 'btn btn-success ml-4', 'update' => '#content'));


$this->Js->buffer('$(".nav-item").removeClass("active");');
$this->Js->buffer('$(".nav-item a[href$=\'filmes\']").addClass("active");');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}

?>