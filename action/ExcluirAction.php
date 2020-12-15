<!DOCTYPE html>
<?php
    include_once '../Dao/factory.php';
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
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
            <div class='modal-body'>
                <h2 class="card-title">Alterar atividade</h2>
                <hr>
                <form class="form-signin" method="post" action="atividadeAction.php">
        <?php
      $pdo = Connection::getConexao();
      $sql = 'select * from tb_atividade where a_id = '.$_GET['at'].';';
      foreach($pdo->query($sql)as $row)
      {     
     echo '<div class="form-group">
    <label for="a_titulo">Titulo</label>
    <input type="text" class="form-control" id="a_titulo" name="a_titulo" value="'.$row['a_titulo'].'" required>
      </div>' ;
     echo '<div class="form-group">
    <label for="a_info">Instruções</label>
    <textarea class="form-control" id="a_info" name="a_info" rows="3" value="'.$row['a_info'].'" required>'.$row['a_info'].'</textarea>
    </div>';
     echo ' <div class="form-group">
    <label for="a_entrada">Entradas</label><br><small class="text-center">Para adicionar diversas entradas bastas separar por “;” e
        para adicionar duas ou mais entrada no mesmo 
        conjunto basta separar com um espaço. Exemplo: 1 2 0; 2 5 6; 100 200 300</small> 
    <input type="text" class="form-control" id="a_entrada" name="a_entrada" value="'.$row["a_entrada"].'" required>
    </div>';
      }
   ?> 
                        <input type="text" value="altera" name="opt" hidden>
                        <input type="text" value="<?php echo $_GET['at'];?>" name="id" hidden>

     <input id="" class=" btn-lg btn-dark btn-block " value="Alterar atividade" type="submit">
      <button type="button" onclick="retorno()" class="btn-lg btn-block  btn-secondary">Retornar para o voltar</button>
     </form>
        <script src="../vedor/highlight/highlight.pack.js"></script>
        <script>
         hljs.initHighlighting();  
         function retorno(){
             history.go(-1);
         }
        </script>
    </body>
</html>
