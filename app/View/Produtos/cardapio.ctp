<?php


$clienteID = 1;

$burguers = array();
$bebidas = array();
$acompanhamentos = array();
$sobremesas = array();
foreach ($produtos as $produto) {
    if ($produto['Produto']['tipo'] == 'Hamburguer') {
        $foto = $this->Html->image($produto['Produto']['foto'], array('style' => 'height: 100px; width: 150px;'));
        $nome = $this->Html->para('h4', $produto['Produto']['nome']);
        $adicionar = $this->Js->link('Adicionar', '/items/add/' . $produto['Produto']['id'], array('update' => '#content'));
        $burguers[] = array(    
            $foto,    
            $nome,
            $produto['Produto']['descricao'],
            $produto['Produto']['preco'],
            $adicionar
        );
    }
    if ($produto['Produto']['tipo'] == 'Acompanhamento') {
        $foto = $this->Html->image($produto['Produto']['foto'], array('style' => 'height: 100px; width: 150px;'));
        $nome = $this->Html->para('h4', $produto['Produto']['nome']);
        $adicionar = $this->Js->link('Adicionar', '/items/add/' . $produto['Produto']['id'], array('update' => '#content'));
        $acompanhamentos[] = array(    
            $foto,    
            $nome,
            $produto['Produto']['descricao'],
            $produto['Produto']['preco'],
            $adicionar
        );
    }
    if ($produto['Produto']['tipo'] == 'Bebida') {
        $foto = $this->Html->image($produto['Produto']['foto'], array('style' => 'height: 100px; width: 150px;'));
        $nome = $this->Html->para('h4', $produto['Produto']['nome']);
        $adicionar = $this->Js->link('Adicionar', '/items/add/' . $produto['Produto']['id'], array('update' => '#content'));
        $bebidas[] = array(    
            $foto,    
            $nome,
            $produto['Produto']['descricao'],
            $produto['Produto']['preco'],
            $adicionar
        );
    }
    if ($produto['Produto']['tipo'] == 'Sobremesa') {
        $foto = $this->Html->image($produto['Produto']['foto'], array('style' => 'height: 100px; width: 150px;'));
        $nome = $this->Html->para('h4', $produto['Produto']['nome']);
        $adicionar = $this->Js->link('Adicionar', '/items/add/' . $produto['Produto']['id'], array('update' => '#content'));
        $sobremesas[] = array(    
            $foto,    
            $nome,
            $produto['Produto']['descricao'],
            $produto['Produto']['preco'],
            $adicionar
        );
    }
}

echo $this->Flash->render('warning'); 
echo $this->Flash->render('success');

if (!empty($burguers)) {
    echo $this->Html->tag('h2', 'Lanches');
    $burguerBody = $this->Html->tableCells($burguers);
    echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
        $this->Html->tag('table', $burguerBody, array('class' => 'table table-borderless'))
    );
}

if (!empty($acompanhamentos)) {
    echo $this->Html->tag('h2', 'Proções');
    $acompanhamentosBody = $this->Html->tableCells($acompanhamentos);
    echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
        $this->Html->tag('table', $acompanhamentosBody, array('class' => 'table table-borderless'))
    );
}

if (!empty($bebidas)) {
    echo $this->Html->tag('h2', 'Bebidas');
    $bebidaBody = $this->Html->tableCells($bebidas);
    echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
        $this->Html->tag('table', $bebidaBody, array('class' => 'table table-borderless'))
    );
}

if (!empty($sobremesas)) {
    echo $this->Html->tag('h2', 'Sobremesas');
    $sobremesasBody = $this->Html->tableCells($sobremesas);
    echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
        $this->Html->tag('table', $sobremesasBody, array('class' => 'table table-borderless'))
    );
}


$this->Js->buffer('$(".nav-item").removeClass("active");');
$this->Js->buffer('$(".nav-item a[href$=\'filmes\']").addClass("active");');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}

?>