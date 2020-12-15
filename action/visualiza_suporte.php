<!DOCTYPE html>
<?php
    include_once '../Dao/factory.php';
    session_start();
    ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../vedor/css/bootstrap.css" rel="stylesheet">
        <link href="../vedor/css/snippets.css" rel="stylesheet">
        <link rel="stylesheet" href="../vedor/highlight/styles/qtcreator_light.css">
    </head>
    <body>
        <div class='modal-dialog moda-lg-100'>
            <div class='modal-content'>
            <div class='modal-body'>
                <h2 class="card-title">Resposta do suporte</h2>
                <hr>
                <form class="form-signin" method="post" action="atividadeAction.php">
        <?php
      $pdo = Connection::getConexao();
      $sql = 'select * from suporte where P_id = '.$_SESSION['p_id'].';';
      foreach($pdo->query($sql)as $row)
      {     
          echo '<h5 class="card-title">Atividade:</h5>';
          echo '<p>&nbsp;'.$row['info'].'</p></div></pre><hr>';
          echo '<hr>';
          echo ' <div class="card-body">';
          echo '<pre><div class="">';
          echo  '<h6>&nbsp;&nbsp;Codigo do enviado:<h6>';
          echo '<pre id="test">'.$row['resultado'].'</pre></div>';
          echo '<hr>';
      echo '<h6>retorno :</h6>';
      echo '<div class="card-text"'.$row['retorno'] .'</div><hr>';
     }
        ?>
      <button class=" btn-lg btn-dark " onclick="voltar()" type="submit">Voltar</button>
          
     </form>
            </div>
            </div>
            </div>
        <script src="../vedor/highlight/highlight.pack.js"></script>
        <script>
         hljs.initHighlighting();   
         function voltar(){
             history.go(-1)  ;
         }
        </script>
    </body>
</html>
