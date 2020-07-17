<?php
$this->extend('/Common/index');

$this->assign('title', 'Pedidos');

$searchFields = $this->Form->input('Cliente.filtro', array(
    'required' => false,
    'label' => array('text' => 'Nome', 'class' => 'sr-only'),
    'class' => 'form-control mb-2 mr-sm-2',
    'div' => false,
    'placeholder' => 'Nome...'
));
$this->assign('searchFields', $searchFields);

$titulos = array('Nome', 'Telefone', 'Preço', 'Status', '', '');
$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();

foreach ($pedidos as $pedido) {
    if ($pedido['Pedido']['status'] == 'Aguardando') {
        $editLink = $this->Js->link('Alterar Pedido', '/pedidos/edit/' . $pedido['Pedido']['id'], array('update' => '#content'));
    } else {
        $editLink = "Não é possível alterar";
    }

    if ($pedido['Pedido']['status'] == 'Aguardando') {
        $editStatus = $this->Js->link('Confirmar', '/pedidos/status/' . $pedido['Pedido']['id'] . '/Confirmado', array('update' => '#content'));
    } 
    elseif ($pedido['Pedido']['status'] == 'Confirmado') {
        $editStatus = $this->Js->link('Preparar', '/pedidos/status/' . $pedido['Pedido']['id'] . '/Preparando', array('update' => '#content'));
    }
    elseif ($pedido['Pedido']['status'] == 'Preparando') {
        $editStatus = $this->Js->link('Pronto', '/pedidos/status/' . $pedido['Pedido']['id'] . '/Pronto', array('update' => '#content'));
    }
    elseif ($pedido['Pedido']['status'] == 'Pronto') {
        $editStatus = '';
    }

    $detalhe[] = array(
        $pedido['Cliente']['nome'],
        $pedido['Cliente']['telefone'],
        $pedido['Pedido']['total'],
        $pedido['Pedido']['status'],
        $editLink,
        $editStatus
    );
}
$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);