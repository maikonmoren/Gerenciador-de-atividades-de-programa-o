<!DOCTYPE html>
<html>
    <?php
    session_start();
    include '../Dao/factory.php';
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="../Img/logo_size_1.jpg">
        <title>Painel do aluno</title>
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
                     <h2 class="text-white">Histórico de atividades</h2>
               
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
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="btn btn-dark active" id="inputGroup-sizing-default" disable>Filtrar por</span>
  </div>
                      <select type="" id="busca" class="form-control col-sm-4">
                          <option value="">Selecione</option>
                          <option value="2">Resolvidos</option>
                          <option value="1">Visualizados</option>
 
                      </select>
</div>
          <hr>
         <?php          $pdo = Connection::getConexao();
                        $sql = 'select s.*,p.p_nome from suporte s inner join tb_pessoa p where p.p_id = s.p_id;';
                        foreach($pdo->query($sql)as $row)
                        {
                           
                            echo '<div class="card">';
                             echo '<h6 hidden>'.$row['s_situacao'].'</h6>';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$row['p_nome'].'</h5>';
                            echo '<hr>';
                            echo '<div class="card-text">'.$row['s_texto'].'</div>';
                            if($row['s_situacao']==2){
                               echo '<div>Solução:</div>';
                               echo '<p class="card-text"><small>'.$row['s_solucao'].'</small></p>';
                               echo ' <button" disabled class="btn btn-secondary disabled"></i>Problema resolvido&nbsp;<i class="fas fa-copy"></i> ';
                            }else if($row['s_situacao']==1){
                                 echo '<p class="card-text"><small>'.$row['s_solucao'].'</small></p>';
                                 echo ' <a href="../action/solucao.php?s='.$row['s_id'].'" class="btn btn-dark"></i>Enviar outra solução&nbsp;<i class="fas fa-copy"></i></a> ';
                            }elseif ($row['s_situacao']==0) {
                                  echo '<p class="card-text"><small>'.$row['s_solucao'].'</small></p>';
                                 echo ' <a href="../action/solucao.php?s='.$row['s_id'].'" class="btn btn-dark"></i>Enviar solução&nbsp;<i class="fas fa-copy"></i></a> ';
                     }
                          
                            echo '</div></div><br/>'; 
      
        }?>
                       
               
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
            var openFile = function (event) {
                var input = event.target;
                var resutado = document.getElementById("result");

                var reader = new FileReader();
                reader.onload = function () {
                    var text = reader.result;
                    resutado.innerHTML = text;
                    console.log(reader.result.substring(0, 200));
                };
                reader.readAsText(input.files[0]);
            };
            $("#busca").change(function(){
    var stringPesquisa = $(this).val();
    $('h6').parent().hide();
    $('h6:contains('+stringPesquisa+')').parent().show();
  });

        </script>
    </body>

</html>