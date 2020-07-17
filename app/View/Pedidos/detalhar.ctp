<?php

$total = 0;
foreach ($produtos as $produto) {
    $total += $produto['Produto']['Produto']['preco'];
    $foto = $this->Html->image($produto['Produto']['Produto']['foto'], array('style' => 'height: 100px; width: 150px;'));
    $burguers[] = array(   
        $foto,   
        $produto['Produto']['Produto']['nome'],
        $produto['Produto']['Produto']['descricao'],
        $produto['Produto']['Produto']['preco'],
    );
}

echo $this->Flash->render('warning'); 
echo $this->Flash->render('success');


echo $this->Html->tag('h2', 'Detalhes do pedido');
$burguerBody = $this->Html->tableCells($burguers);
echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
    $this->Html->tag('table', $burguerBody, array('class' => 'table table-borderless'))
);

echo $this->Html->tag('h4', 'Total = ' . $total, array('class' => 'float-right mr-5'));

echo $this->Js->link('voltar', '/pedidos/view/' . AuthComponent::user('id'), array('class' => 'btn btn-secondary', 'update' => '#content'));


$this->Js->buffer('$(".nav-item").removeClass("active");');
$this->Js->buffer('$(".nav-item a[href$=\'filmes\']").addClass("active");');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}

?>