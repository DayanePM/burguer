<?php
$this->extend('/Common/index');

$this->assign('title', 'Clientes');

$searchFields = $this->Form->input('Cliente.filtro', array(
    'required' => false,
    'label' => array('text' => 'Nome', 'class' => 'sr-only'),
    'class' => 'form-control mb-2 mr-sm-2',
    'div' => false,
    'placeholder' => 'Nome...'
));
$this->assign('searchFields', $searchFields);

$titulos = array('Nome', 'telefone', 'Endereco', 'cep',  '');
$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($clientes as $cliente) {
    $editLink = $this->Js->link('Alterar', '/clientes/edit/' . $cliente['Cliente']['id'], array('update' => '#content'));
    $deleteLink = $this->Js->link('Excluir', '/clientes/delete/' . $cliente['Cliente']['id'], array('update' => '#content', 'confirm' => 'Tem certeza?'));
    $viewLink = $this->Js->link($cliente['Cliente']['nome'], '/clientes/view/' . $cliente['Cliente']['id'], array('update' => '#content'));
    $detalhe[] = array(
        $viewLink, 
        $cliente['Cliente']['telefone'],
        $cliente['Cliente']['rua'] . ", " . $cliente['Cliente']['numero'],
        $cliente['Cliente']['cep'],
        $editLink . ' ' . $deleteLink
    );
}
$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);