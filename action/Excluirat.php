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
                <h2 class="card-title">Deseja excluir atividade ?</h2>
                <hr>
                <form class="form-signin" method="post" action="atividadeAction.php">
               <input type="text" value="deleta" name="opt" hidden>
               <input type="text" value="<?php echo $_GET['at'];?>" name="id" hidden>

     <input id="" class=" btn-lg btn-dark btn-block " value="Deletar" type="submit">
      <button type="button" onclick="retorno()" class="btn-lg btn-block  btn-secondary">Não</button>
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
