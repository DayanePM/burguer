<?php
$detalhe = array();
foreach ($pedidos as $pedido) {
    if ($pedido['Pedido']['status'] == 'Aguardando') {
        $editLink = $this->Js->link('Alterar Pedido', '/pedidos/edit/' . $pedido['Pedido']['id'], array('update' => '#content'));
    } else {
        $editLink = "Não é possível alterar esse pedido";
    }
    $detalhes = $this->Js->link('Detalhes do pedido', '/pedidos/detalhar/' . $pedido['Pedido']['id'], array('update' => '#content'));
    $date = date_create($pedido['Pedido']['created']);
    $data = date_format($date, 'd-m-Y');
    $detalhe[] = array(
        $data,
        $pedido['Pedido']['total'],
        $pedido['Pedido']['status'],
        $editLink,
        $detalhes
    );
}

$titulos = array('Data', 'Total', 'Status',  '', '');
$header = $this->Html->tag('thead', $this->Html->tableHeaders($titulos));
$body = $this->Html->tableCells($detalhe);

$this->Paginator->options(array('update' => '#content'));

$links = array(
    $this->Paginator->first('Primeira', array('class' => 'page-link')),
    $this->Paginator->prev('Anterior', array('class' => 'page-link')),
    $this->Paginator->next('Próxima', array('class' => 'page-link')),
    $this->Paginator->last('Última', array('class' => 'page-link'))
);
$paginate = $this->Html->nestedList($links, array('class' => 'pagination'), array('class' => 'page-item'));
$paginate = $this->Html->tag('nav', $paginate);

$paginateBar = $this->Html->div('row',
    $this->Html->div('col-md-6', $paginate)
);

echo $this->Flash->render('warning'); 
echo $this->Flash->render('success');

echo $this->Html->tag('h1', 'Meus Pedidos');
echo $this->Html->div('my-3 p-3 bg-white rounded shadow-sm',
    $this->Html->tag('table', $header . $body, array('class' => 'table table-hover'))
);
echo $paginateBar;

if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}
?>