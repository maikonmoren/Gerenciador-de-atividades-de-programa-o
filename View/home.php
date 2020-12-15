<?php
    //include './controlador.php';
    session_start();
    include '../Dao/factory.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" >
     <link rel="shortcut icon" href="../Img/logo_size_1.jpg">
    <title>Home</title>
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
        <div id="content">
            <nav class="navbar" style="background-color: yellowgreen">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light">
                        <i class="fas fa-align-justify"></i>
                    </button>
                     <h2 class="text-white">Home</h2>
               
                   
                    <div class="btn-group">
                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['p_usuario'];?> <i class="fas fa-user-circle"></i> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a  href="../action/sair.php" class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
                      <button href="" class="dropdown-item" type="button"  data-toggle="modal" data-target="#suporte">
                            <i class="fas fa-question-circle"></i>&nbsp;Suporte</button>
  </div>
</div>
                </div>
              
            </nav>
            <div class='form-inline'>
            <?php
            if($_SESSION['p_tipo'] == 2){
            echo '<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#criarturma">
            Criar uma sala </button>&nbsp;';   
                
            }
            
             ?>
             <div class="input-group">
            <div class="input-group-prepend">
    <span class="btn btn-dark active" id="inputGroup-sizing-default" disable>Insira o código da sala</span>
    
  </div>
                 <input type="text" id="busca" class="form-control col-sm-7" data-toggle="modal" data-target="">
             </div>
                     
           
       </div> 
            <hr>
           <?php if($_SESSION['p_tipo']== 1){
            echo ' <p>Para se tornar um professor vá clique opção conta ao lado esquerdo da tela</p><hr>';   
                
            }?>
           
            <br>
            
         
             <?php
                       
                        $pdo = Connection::getConexao();
                        $sql = 'select t_nome, t_desc , t_att, t_codigo  from tb_turma;';
                        foreach($pdo->query($sql)as $row)
                        {
                            $t_nome=$row['t_nome'];
                            echo '<div>';
                            
                            echo '<div class="">';
                            
                            echo '<div class="card">';
                            
			    echo '<div class="card-header"><h5 class="card-text">'.$row['t_nome'].'</h5></div>';
                           echo '<h6 hidden>'.$row['t_codigo'].'</h6>';
                            echo '<div class="card-body">';
                            
                            echo '<p class="card-text">'.$row['t_desc'].'</p>';
                 
                            if($row['t_att'] === '0'){
                                echo '<button id="btn_sala2" value="'.$row['t_codigo'].'"type="button" '
                                 . 'class="btn btn-dark" data-toggle="modal" data-target="#turmaaberta">'
                                 .   'Entrar na sala <i class="fas fa-lock-open"></i></button> ';
                                
                            }else{
                                echo '<button id="btn_sala" value="'.$row['t_codigo'].'"type="button" '
                                 . 'class="btn btn-dark" data-toggle="modal" data-target="#turmasenha">'
                                 .   'Entrar na sala  <i class="fas fa-lock"></i></button> ';
                            }
                            
                            echo '</div></div></div><br/>';
                        }
                        ?>
           
          
<!-- Modal Nova-turma -->
<div class="modal fade" id="criarturma" tabindex="-1" role="dialog" aria-labelledby="t_criarturma" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="t_criarturma">Criar uma sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form class="form-signin" method="post" action="../action/turmaAction.php">
                            <div class="form-label-group">
                            <input type="text" id="t_nome" name="t_nome" class="form-control" placeholder="Nome da turma" required autofocus>
                            <label for="t_nome">Nome</label>        
                            </div>
                            <div class="form-label-group">
                                <input type="text" id="t_desc" name="t_desc" class="form-control" placeholder="Descrição" required>
                                <label for="t_desc">Descrição</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                            &nbsp;  &nbsp;<input type="checkbox" style="background-color: black ;" class="custom-control-input" name="t_privado" id="t_privado" checked>
                             <label class="custom-control-label" for="t_privado">Sala Privada</label>
                             </div>
                            <div class="form-label-group" id="e_senha">
                                <input type="password" id="turma_senha" name="t_senha" class="form-control" placeholder="Usúario" required>
                                <label for="turma_senha">Senha</label>
                            </div>
                            <input name="opt"  value="cad_turma" hidden/>
                            <button class=" btn-lg btn-dark btn-block " type="submit"><h4>Criar a sala</h4></button>
                             <button type="button"  class="btn-lg btn-block btn-secondary" data-dismiss="modal">Fechar janela</button>
                        </form>
<div class="modal-footer">
       
        
</div>
</div>  
</div>
</div>
</div>
<!-- fim do modal -->
<!-- modal sala com senha -->
<div class="modal fade" id="turmasenha" tabindex="-1" role="dialog" aria-labelledby="t_senhaturma" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="t_senhaturma">Sala privada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form class="form-signin" method="post" action="../action/turmaAction.php">
          <p class="card-text">Digite a senha para entrar na sala </p>                  
          <div class="form-label-group" id="e_senha">
                                <input type="password" id="salaprivada" name="salaprivada" class="form-control" placeholder="Senha" required="required">
                                <label for="salaprivada">Senha</label>
                            </div>
                            
                            <input type="text" id="cd_turma" name="cd_turma" class="form-control" required="required" hidden>  
                            <input name="opt"  value="turma_senha" hidden/>
                            <input  class="btn-lg btn-dark btn-block text-uppercase" value="Entrar na sala" type="submit" >
                              <button type="button"  class=" btn-block btn-lg btn-secondary" data-dismiss="modal">Fechar janela</button>
                        </form>
</div>  
</div>
</div>
</div>
<!-- modal sala sem senha -->
<div class="modal fade" id="turmaaberta" tabindex="-1" role="dialog" aria-labelledby="t_senhaturma" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="t_senhaturma">Sala aberta </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form class="form-signin" method="post" action="../action/turmaAction.php">
          <p class="card-text">Deseja entrar nesta sala ?</p>
          <input type="text" id="cd_turma2" name="cd_turma2" class="form-control" required="required" hidden > 
          <input name="opt" id="opt" value="pe_tu" hidden/>
          <input  class=" btn-lg btn-dark btn-block text-uppercase" value="Entrar na sala" type="submit">
          <button type="button"  class="btn-lg btn-secondary btn-block" data-dismiss="modal">Fechar janela</button>
      </form>
<div class="modal-footer">
       
        
</div>
</div>  
</div>
</div>
</div>

  <div class="modal fade" id="suporte" tabindex="-1" role="dialog" aria-labelledby="t_criarturma" aria-hidden="true">
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

    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script>

  $('button').click(function(){
  var valor = $(this).val();
  var nome = $(this).attr('name');
  $('#cd_turma').val(valor);
  $('#cd_turma2').val(valor);
  
});
    
    $(function () {
        $("#t_privado").click(function () {
            if ($(this).is(":checked")) {
                $("#e_senha").show();
                $("#turma_senha").attr("required", "required");
                $("#e_senha2").show();
                
            
                
            } else {
                $("#turma_senha").removeAttr("required");
                $("#e_senha").hide();
                $("#e_senha2").hide();
               
              
            }
        });
    });
         $("#busca").keyup(function(){
    var stringPesquisa = $(this).val();
    $('h6').parent().hide();
    $('h6:contains('+stringPesquisa+')').parent().show();
  });
    </script>
    
</body>
</html>
