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
    </head>
    <body>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
            <div class='modal-body'>
                <h2 class="card-title">Enviar Feedback</h2>
                <hr>
     <form class="form-signin" method="post" action="pessoaAction.php">
        <?php
      $pdo = Connection::getConexao();
      $sql = 'select s.*,p.p_nome from suporte s inner join tb_pessoa p where p.p_id = s.p_id and s_id = '.$_GET['s'].';';
      foreach($pdo->query($sql)as $row)
      {     
          echo '<h5 class="card-title">Nome :'.$row['p_nome'].'</h5>';
          echo '<hr>';
          echo '<h6>Problema:<h6>';
          echo '<pre><div class="">';
          echo '<p>&nbsp;'.$row['s_texto'].'</p></div></pre><hr>';
     }
        ?>
            <div class="form-group">
  
                <input hidden name="a_id" value="<?php echo $_GET['s'] ;?>">
                <input hidden name="opt" value="suporteR">
          
                <label class="form-label">Solução para o aluno</label>
                <textarea name="texto" class="form-control" rows="10"cols="33"  placeholder="Descrição" required="" ></textarea>
          </div>
           <button class=" btn-lg btn-dark " type="submit">Enviar solução</button>
           <a href="../View/adm_suporte.php"> <button type="button"  class="btn-lg btn-secondary">Retornar para o painel</button></a>
     </form>
            </div>
            </div>
            </div>
    </body>
</html>
