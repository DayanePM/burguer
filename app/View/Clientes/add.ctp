<?php
$inputDefaults = array(
    'class' => 'form-control',
    'required' => false,
    'div' => array('class' => 'form-group'),
    'error' => array('attributes' => array('class' => 'invalid-feedback')),
    'type' => 'text'
);

$form = $this->Form->create('Cliente', array('class' => 'form-signin', 'inputDefaults' => $inputDefaults));

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
        'label' => 'Número',
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
        'label' => 'Telefone',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
    
);

$form .= $this->Html->div('form-row', 
    $this->Form->input('Cliente.email', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Email',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Cliente.senha', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Senha',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$form .= $this->Form->submit('Cadastar', array('type' => 'submit', 'class' => 'btn btn-success mr-3', 'div' => false, 'update' => '#content'));
$form .= $this->Js->link('Cancelar', '/Clientes', array('class' => 'btn btn-secondary', 'update' => '#content'));
$form .= $this->Form->end();

echo $this->Html->para('h1', 'Cadastre-se', array('class' => 'mt-4 mb-4'));
echo $form;

$this->Js->buffer('$(".form-error").addClass("is-invalid")');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}


?>