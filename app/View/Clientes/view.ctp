<?php
$inputDefaults = array(
    'class' => 'form-control',
    'required' => false,
    'div' => array('class' => 'form-group'),
    'error' => array('attributes' => array('class' => 'invalid-feedback')),
    'type' => 'text',
    'disabled' => true
);

$form = $this->Form->create('Cliente', array('class' => 'form-signin', 'inputDefaults' => $inputDefaults));

$form .= $this->Form->hidden('Cliente.id');

$form .= $this->Html->div('form-row', 
    $this->Form->input('Cliente.nome', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Nome',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$form .= $this->Html->div('form-row', 
    $this->Form->input('Cliente.rua', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Rua',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Cliente.numero', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'numero',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
    
);

$form .= $this->Html->div('form-row', 
    $this->Form->input('Cliente.cep', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'CEP',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Cliente.telefone', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'telefone',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
    
);

$form .= $this->Form->submit('Alterar', array('type' => 'submit', 'class' => 'btn btn-success mr-3', 'div' => false, 'update' => '#content'));
$form .= $this->Js->link('Cancelar', '/clientes', array('class' => 'btn btn-secondary', 'update' => '#content'));
$form .= $this->Form->end();

echo $this->Html->para('h1', 'Detalhes do Cliente');
echo $form;

$this->Js->buffer('$(".form-error").addClass("is-invalid")');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}


?>