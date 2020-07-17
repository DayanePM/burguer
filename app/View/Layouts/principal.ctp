<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Valbernielson's Hamburgueria</title>

        <?php 
            echo $this->Html->css('bootstrap.min.css');
            echo $this->Html->css('album.css');
        ?>

    </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <?php
                echo $this->Html->link("Valbernielson's Hamburgueria", '/', array(
                    'class' => 'navbar-brand'
                ))
            ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <?php echo $this->Html->link('', '', array('class' => 'nav-link nav-color-text'));?>                          
                    </li>                                                         
                </ul>
                <?php
                    if (AuthComponent::user('id')) {
                        if (AuthComponent::user('aro_parent_id') == 2) {
                            if(!empty($this->Session->read('pedidoId'))){
                                echo $this->Js->link('Meu carrinho', '/pedidos/edit/' . $this->Session->read('pedidoId'), array('class' => 'nav-link', 'update' => '#content'));
                            }
                            echo $this->Js->link('Meus Pedidos', '/pedidos/view/' . AuthComponent::user('id'), array('class' => 'nav-link', 'update' => '#content'));
                            echo $this->Html->link('Sair', '/clientes/logout', array('class' => 'nav-link'));
                        } else {
                            echo $this->Js->link('Produtos', '/produtos/index/' . $this->Session->read('pedidoId'), array('class' => 'nav-link', 'update' => '#content'));
                            echo $this->Js->link('Clientes', '/clientes/index' . $this->Session->read('pedidoId'), array('class' => 'nav-link', 'update' => '#content'));   
                            if(!empty($this->Session->read('pedidoId'))){
                                echo $this->Js->link('Atualizar pedido', '/pedidos/edit/' . $this->Session->read('pedidoId'), array('class' => 'nav-link', 'update' => '#content'));
                            } else {
                                echo $this->Js->link('Pedidos', '/pedidos/index/' . $this->Session->read('pedidoId'), array('class' => 'nav-link', 'update' => '#content'));
                            }
                            echo $this->Js->link('Balanço', '/pedidos/balanco/' . AuthComponent::user('id'), array('class' => 'nav-link', 'update' => '#content'));
                            echo $this->Html->link('Sair', '/clientes/logout', array('class' => 'nav-link'));
                        }
                    } else {
                        echo $this->Html->link('Castre-se', '/clientes/add', array('class' => 'btn btn-secondary mr-4')); 
                        echo $this->Html->link('Login', '/clientes/login', array('class' => 'btn btn-secondary'));                                             
                    }                 
                ?>               
            </div>
    </nav>

        <main role="main" class="container" background-color="#f5f5f5" id="content">
            <?php
                echo $this->Html->tag('H1', 'espaço', array('class' => 'invisible'));
                echo $this->Flash->render();
                echo $this->fetch('content');                  
            ?>
        </main>
        <?php 
            echo $this->Html->script('jquery-3.4.1.min.js');
            echo $this->Html->script('bootstrap.bundle.min.js');
            echo $this->Js->writeBuffer();              
        ?>        
    </body>
</html>

