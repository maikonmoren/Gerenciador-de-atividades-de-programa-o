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
                <h2 class="card-title">Enviar Feedback</h2>
                <hr>
                <form class="form-signin" method="post" action="atividadeAction.php">
        <?php
      $pdo = Connection::getConexao();
      $sql = 'select * from feedback where id = '.$_GET['p_id'].' and aid ='.$_GET['a_id'].';';
      foreach($pdo->query($sql)as $row)
      {     
          echo '<h5 class="card-title">'.$row['nome'].'</h5>';
          echo '<hr>';
          echo '<h6>Atividade:<h6>';
          echo '<pre><div class="">';
          echo '<p>&nbsp;'.$row['info'].'</p></div></pre><hr>';
          echo  '<h6>Comparação das saidas:<h6>';
          echo ' <div class="card-body">';
          echo '<pre id="test">'.$row['resultado'].'</pre></div>';
          echo '<hr>';
     }
        ?>
            <div class="form-group">
  
                <input hidden name="a_id" value="<?php echo $_GET['a_id']?>">
                <input hidden name="p_id" value="<?php echo $_GET['p_id']?>">
                <input hidden name="cd" value="<?php echo $_GET['cd']?>">
                <input hidden name="opt" value="feedback">
          
              <label class="form-label">Resposta para aluno</label>
                <textarea name="feed" class="form-control" rows="10"cols="33"  name="feedback" required="" ></textarea>
          </div>
           <button class=" btn-lg btn-dark " type="submit">Enviar resposta</button>
           <a href="../View/painel.php?cd=<?php echo $_GET['cd']?>" > <button type="button"  class="btn-lg btn-secondary">Retornar para o painel</button></a>
     </form>
            </div>
            </div>
            </div>
        <script src="../vedor/highlight/highlight.pack.js"></script>
        <script>
         hljs.initHighlighting();   
        </script>
    </body>
</html>
