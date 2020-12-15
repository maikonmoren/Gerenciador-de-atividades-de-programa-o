<!DOCTYPE html>
<html>
<?php  
session_start(); 
include '../Dao/factory.php';
$pdo = Connection::getConexao();
$sql = 'select t_dono from tb_turma where t_codigo ="'.$_GET['cd'].'";';
$consulta=$pdo->query($sql);
$row=$consulta->fetch();
$dono = $row['t_dono'];
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="shortcut icon" href="../Img/logo_size_1.jpg">
    <title>Sala</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../vedor/css/bootstrap.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../vedor/css/barra.css">
    <link rel="stylesheet" href="../vedor/css/modal.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

       <div class="wrapper">
        <!-- Sidebar  -->
                <nav id="sidebar">
                     <div class="sidebar-header">
                         
                     <h3 class="justify-content-end">Cd-Web</h3> 
                <strong>CW</strong>
            </div>
            <hr/>
            <ul class="list-unstyled components">
                <li>
                    <a href="home.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <?php
                        if($_SESSION['p_tipo'] != 2){
                            $pdo = Connection::getConexao();
                            $sql = 'select count(a_id) as n from pe_at where pe_at_situacao = 0 and p_id ='.$_SESSION['p_id'].';';
                            $consulta=$pdo->query($sql);
                            $row=$consulta->fetch();
                            $n_atvidade = $row['n'];
                           
                     echo '<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Atividades&nbsp;';
                     if($n_atvidade > 0){
                        echo '<small><span class="badge badge-danger"><i class="fas fa-plus"></i></span></small>';
                        }
                        echo '</a>';
                        echo '<ul class="collapse list-unstyled" id="pageSubmenu">';
                        echo '<li><a href="painel_aluno.php?opt=0">Historico de atividades&nbsp;'; 
                        if($n_atvidade > 0){
                         echo '<span class="badge badge-danger">'.$n_atvidade.'</span>';
                        }
                         echo '</a></li></ul>';
                            }
                        ?>
                        
                    
                </li>
                <li>
                    <a href="minhasala.php">
                        <i class="fas fa-users"></i>
                       Minhas salas
                    </a>
                </li>
                <li>
                    <a href="conta.php">
                        <i class="fas fa-user"></i>
                        Conta
                    </a>
              
               <?php
                          if($_SESSION['p_tipo'] == 3){
                        $pdo = Connection::getConexao();
                        $sql = 'select count(pedido_st) as n from admin_pedido where pedido_st = 0;';
                        $consulta=$pdo->query($sql);
                        $row=$consulta->fetch();
                        $n_p = $row['n'];
                        $sql2 = 'select count(s_situacao) as n2 from suporte where s_situacao = 0;';
                        $consulta2=$pdo->query($sql2);
                        $row2=$consulta2->fetch();
                        $n_s = $row2['n2'];
                    echo '<a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cog"></i>
                        Admininstração&nbsp;';
                     if($n_p > 0 || $n_s>0){
                        echo '<small><span class="badge badge-danger">&nbsp;<i class="fas fa-plus"></i></span></small>';
                        }
                        echo '</a>';
                        echo '<ul class="collapse list-unstyled" id="pageSubmenu1">';
                        echo '<li><a href="adm.php">Solicitação de professor&nbsp;'; 
                        if($n_p > 0){
                         echo '<span class="badge badge-danger">'.$n_p.'</span>';
                        }
                         echo '</a>';
                         echo '<li><a href="adm_suporte.php">Solicitação de suporte &nbsp;'; 
                        if($n_s > 0){
                         echo '<span class="badge badge-danger">'.$n_s.'</span>';
                        }
                         echo '</a></li></ul>';
                   }
               
               
               ?>
            </ul>
            <hr/>
        </nav>
        <!-- Page Content  -->
  
            </nav>
            
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar" style="background-color: yellowgreen">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light">
                        <i class="fas fa-align-justify"></i>
                    </button>
                     <h2 class="text-white">Sala :<?php echo $_GET['cd']; ?></h2>
               
                   
                    <div class="btn-group">
                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['p_usuario'];?> <i class="fas fa-user-circle"></i> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                     <a href="../action/sair.php" class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
                      <button href="" class="dropdown-item" type="button"  data-toggle="modal" data-target="#suporte">
                            <i class="fas fa-question-circle"></i>&nbsp;Suporte</button>
  </div>
</div>
                </div>
              
            </nav>
            <div class="form-inline">
                <?php
                  echo '<div class="dropdown">' ;
                   echo ' <button class="btn btn-dark " type="button" id="dropdownMenu2" '
                       . 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opções  <i class="fas fa-plus"></i></button>';
                   echo '<div class="dropdown-menu" aria-labelledby="dropdownMenu2">';
                if($dono == $_SESSION['p_id']){
                   echo '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#criaatividade">Nova Atividade</button>';
                   echo '<button class="dropdown-item" data-toggle="modal" data-target="#atsala" type="button">Editar sala</button>';
                   echo '<button class="dropdown-item" data-toggle="modal" data-target="#exsala" type="button">Excluir sala</button>';
                  
                }else{
                    echo '<button class="dropdown-item" type="button">Sair da sala</button>';
                }
                 echo ' </div></div>';
                 
            ?>  &nbsp;&nbsp; <?php if($dono == $_SESSION['p_id']){
                   echo '<a href="painel.php?cd='.$_GET['cd'].'" class="btn btn-dark">Painel do professor &nbsp;<i class="fas fa-align-justify"></i></a>&nbsp; &nbsp; ';
                }?>
                <div class="input-group">
  <div class="input-group-prepend">
    <span class="btn btn-dark active" id="inputGroup-sizing-default" disable>Código da sala :</span>
  </div>
   <input type="text" class="form-control" value="<?php echo $_GET['cd']; ?>"disabled>
</div>
            </div><br>
            
              <?php
                       $pdo = Connection::getConexao();
                        $sql = 'select  a.a_id,a.a_titulo,a.a_info , a.a_data, pa.pe_at_situacao as st from tb_atividade a inner join '
                                . 'pe_at pa where a.a_id = pa.a_id and a.t_codigo="'.$_GET['cd'].'"and pa.p_id = '.$_SESSION['p_id'].';';
                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<div class=""><div class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$row['a_titulo'].'</h5>';
                            echo '<p class="card-text"><small>'.$row['a_info'].'</small></p>';
                            echo '<p class="card-text"><small>Entregar até &nbsp;'.$row['a_data'].'</small></p>';
                            
                            if($dono==$_SESSION['p_id']){
                              echo '<a href="../action/ExcluirAction.php?at='.$row['a_id'].'&opt=ex" class="btn btn-warning"></i>Editar&nbsp;<i class="fas fa-edit"></i></a> &nbsp;';
                              echo '&nbsp; <a href="../action/Excluirat.php?at='.$row['a_id'].'&opt=ex" class="btn btn-danger"></i>Excluir &nbsp;<i class="fas fa-trash-alt"></i></a> ';
             
                            }else{
                                if($row['st']>0){
                                echo ' <a disabled class="btn disabled btn-secundary"></i>Atividade enviada &nbsp;<i class="fas fa-check"></i></a> ';
                            }else{
                                if($row['a_data']>date('y/m/d')){
                               echo ' <a href="atividade.php?at='.$row['a_id'].'&cd='.$_GET['cd'].'" class="btn btn-dark">Enviar atividade &nbsp;<i class="fas fa-copy"></i></a> ';
                            }else{
                               echo ' <a disabled class="btn btn-secundary desabled">Atividade não foi enviada&nbsp;<i class="fas fa-times"></i></a> ';
                            }
                              
                    
                        }
                        }echo '</div></div><br/>';
                        }
                        ?>
           
        </div>
    </div>
    
    <div class="modal fade " id="criaatividade" tabindex="-1" role="dialog" aria-labelledby="atividade" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="atividade">Nova Atividade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
          <form method="POST" action="../action/atividadeAction.php">
  <div class="form-group">
    <label for="a_titulo">Titulo</label>
    <input type="text" class="form-control" id="a_titulo" name="a_titulo" placeholder="Nome" required>
  </div>
  <div class="form-group">
    <label for="a_info">Instruções</label>
    <textarea class="form-control" id="a_info" name="a_info" rows="3" required></textarea>
  </div>
  <div class="form-group">
      <label for="a_arquivo">Arquivo</label><br>
      <input id="a_arquivo" name="a_arquivo" type='file' accept=".java,.c,.C" onchange='openFile(event)'>
  </div>
  <div class="form-group">
      <label for="a_entrada">Entradas</label><br><small class="text-center">Para adicionar diversas entradas bastas separar por “;” e
        para adicionar duas ou mais entrada no mesmo 
        conjunto basta separar com um espaço. Exemplo: 1 2 0; 2 5 6; 100 200 300</small> 
    <input type="text" class="form-control" id="a_entrada" name="a_entrada" placeholder="Nome" required>
  </div>
  <div class="form-group">
    <label for="a_data">Entregar até</label>
    <input type="date" name="a_data" class="form-control" id="a_data">
  </div>
              <hr>
          <textarea id="result" name="a_codigo" hidden required></textarea>
          <input name="t_codigo" value="<?php echo$_GET['cd'];?>" hidden>
          <input name="opt" value="cad_atividade" hidden>
          <input id="" class=" btn-lg btn-dark btn-block text-uppercase" value="Cadastrar nova atividade" type="submit">
</form>
<div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
</div>
</div>  
</div>
</div>
</div>
    <!-- exsala -->
        <div class="modal fade " id="exsala" tabindex="-1" role="dialog" aria-labelledby="atividade" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="../action/turmaAction.php">
        <div class="form-group">
      <label>Deseja realmente excluir está sala</label>
    
  </div>
          <input name="t_codigo" value="<?php echo$_GET['cd'];?>" hidden>
          <input name="opt" value="ex_sala" hidden>
          <div class="modal-footer">
              <input class=" btn-lg btn-dark btn-block" value="Sim , excluir" type="submit">
</form>

        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
</div>
</div>  
</div>
</div>
</div>
       <!-- at_sala -->
 <?php $pdo = Connection::getConexao();
                        $sql = 'select * from tb_turma where t_codigo ="'.$_GET['cd'].'";';
                        foreach($pdo->query($sql)as $linha)
                        {
                            $nome = $linha['t_nome'];
                            $desc = $linha['t_desc'];
                            $att = $linha['t_att'];
                        }?>
<div class="modal fade" id="atsala" tabindex="-1" role="dialog" aria-labelledby="t_criarturma" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="t_criarturma">Alterar sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form class="form-signin" method="post" action="../action/turmaAction.php">
                            <div class="form-group">
                                <label for="t_nome">Nome</label>    
                                <input type="text" id="t_nome" name="at_nome" class="form-control" placeholder="Nome da turma" 
                                 value="<?php echo $nome;?>" required autofocus>    
                            </div>
                            <div class="form-group">
                            <label for="t_desc">Descrição</label>
                            <textarea type="text" id="t_desc" name="at_desc" class="form-control" placeholder="Descrição" required><?php echo $desc; ?></textarea>
                            </div>
          <hr>                 <input name="at_codigo"  value="<?php echo $_GET['cd']; ?>" hidden/>
                            <input name="opt"  value="at_turma" hidden/>
                            <button type="submit" class=" btn-lg btn-dark " >Alterar sala &nbsp;</button>
                            <button type="button"  class="btn-lg btn-secondary" data-dismiss="modal">Fechar janela</button>
                        </form>
          
</div>  
</div>
</div>
</div>  <div class="modal fade" id="suporte" tabindex="-1" role="dialog" aria-labelledby="t_criarturma" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="t_criarturma">Suporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <form class="form-signin" method="post" action="../action/pessoaAction.php">
                            <div class="form-label">
                                <label for="t_desc">Descreva seu problema: </label><br><small>(Max. de 400 caráteres)</small>
                                <textarea  rows="10" cols="33" type="text" id="t_desc" name="resumo" class="form-control" placeholder="Descrição" required></textarea>
                            </div>
                            <br>
                            <input name="opt"  value="suporte" hidden/>
                            <button class=" btn-lg btn-dark btn-block " type="submit"><h4>Enviar solicitação</h4></button>
                            <button type="button"  class="btn-lg btn-secondary btn-block" data-dismiss="modal">Fechar  janela</button>
                        </form>
</div>  
</div>
</div>
</div>
                       

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        </script>
        <script type="text/javascript">
  var openFile = function(event) {
    var input = event.target;
    var resutado = document.getElementById("result");

    var reader = new FileReader();
    reader.onload = function(){
      var text = reader.result;
      resutado.innerHTML = text;
      console.log(reader.result.substring(0, 200));
    };
    reader.readAsText(input.files[0]);
  };
  
  $(function () {
        $("#t_privado").click(function () {
            if ($(this).is(":checked")) {
                $("#e_senha").show();
                $("#turma_senha").attr("required", "required");
                $("#e_senha2").show();
                
            
                
            } else {
                $("#turma_senha").removeAttr("required");
                $("#e_senha").hide();
               
              
            }
        });
    });
            
        </script>
</body>

</html>