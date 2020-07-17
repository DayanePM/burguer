<?php
$this->extend('/Common/index');

$this->assign('title', 'Produtos');

$searchFields = $this->Form->input('Produto.filtro', array(
    'required' => false,
    'label' => array('text' => 'Nome', 'class' => 'sr-only'),
    'class' => 'form-control mb-2 mr-sm-2',
    'div' => false,
    'placeholder' => 'Nome...'
));
$this->assign('searchFields', $searchFields);

$titulos = array('Nome', 'Preço', 'Tipo',  '');
$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($produtos as $produto) {
    $editLink = $this->Js->link('Alterar', '/produtos/edit/' . $produto['Produto']['id'], array('update' => '#content'));
    $deleteLink = $this->Js->link('Excluir', '/produtos/delete/' . $produto['Produto']['id'], array('update' => '#content', 'confirm' => 'Tem certeza?'));
    $viewLink = $this->Js->link($produto['Produto']['nome'], '/produtos/view/' . $produto['Produto']['id'], array('update' => '#content'));
    $detalhe[] = array(
        $viewLink, 
        $produto['Produto']['preco'],
        $produto['Produto']['tipo'],
        $editLink . ' ' . $deleteLink
    );
}
$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);