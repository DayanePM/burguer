<?php
$inputDefaults = array(
    'class' => 'form-control',
    'required' => false,
    'div' => array('class' => 'form-group'),
    'error' => array('attributes' => array('class' => 'invalid-feedback')),
    'type' => 'text'
);

$form = $this->Form->create('Produto', array(
    'enctype' => 'multipart/form-data',
    'inputDefaults' => $inputDefaults
));
$form .= $this->Form->hidden('Produto.id');
$form .= $this->Html->div('form-row', 
    $this->Form->input('Produto.nome', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Nome',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$form .= $this->Html->div('form-row', 
    $this->Form->input('Produto.preco', array(
        'div' => array('class' => 'form-group col-md-6'),
        'label' => 'Preço',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Produto.tipo', array(
        'label' => 'Tipo do produto',
        'empty' => 'Selecione',
        'type' => 'select',
        'options' => array(
            'Hamburguer'=>'Hamburguer',
            'Pao'=>'Pão',
            'Adicional'=>'Adicional',
            'Acompanhamento'=>'Acompanhamento',
            'Molho'=>'Molho',
        ),
        'div' => array('class' => 'form-group col-md-6'),
        'error' => array('attributes' => array('class' => 'invalid-feedback'))  
    ))
    
);

$form .= $this->Html->div('form-row',
    $this->Form->input('Produto.descricao', array(
        'label' => 'Descrição',
        'type' => 'textarea',
        'div' => array('class' => 'form-group col-md-12'),
        'maxlength' => 300,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))  
    ))

);

$form .= $this->Form->submit('Alterar', array('type' => 'submit', 'class' => 'btn btn-success mr-3', 'div' => false, 'update' => '#content'));
$form .= $this->Js->link('Cancelar', '/produtos', array('class' => 'btn btn-secondary', 'update' => '#content'));
$form .= $this->Form->end();

echo $this->Html->para('h1', 'Alterar Produto');
echo $form;

$this->Js->buffer('$(".form-error").addClass("is-invalid")');
if($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}


?>