
<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php 
            echo $this->Html->css('bootstrap.min.css');
            echo $this->Html->css('cadastro.css');
    ?>

  </head>

  <body>
    <main role="main" class="container" background-color="#0d0d0d" id="content">
        <?php 
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
