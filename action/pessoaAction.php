<link href="../vedor/css/bootstrap.css" rel="stylesheet">
<link href="../vedor/css/snippets.css" rel="stylesheet">
<?php
        session_start();
        include_once("../Domain/pessoa.php");
        include_once("../Dao/PessoaDao.php");
        include_once("../Dao/AdmDao.php");
$opt = $_POST["opt"];

  
  if($opt == "login"){
      $pessoa = new pessoa();
      $pessoa->setUsuario($_POST["usuario"]);
      $pessoa->setSenha($_POST["senha"]);
      $dao = new PessoaDAO();
     
     if($dao->PessoaLogin($pessoa)){
          header('location: ../view/home.php');
          exit();
     }else{
         modal1("Senha ou usuário incorreto","../index.php");
       }
  }else if($opt == "registro"){
      $pessoa = new pessoa();
      $pessoa->setNome($_POST["nome"]);
      $pessoa->setEmail($_POST["email"]);
      $pessoa->setUsuario($_POST["usuario"]);
      $pessoa->setSenha($_POST["senha"]);
      $pessoa->setJdk($_POST["jdk"]);
      $dao = new PessoaDAO();
      $retorno = $dao->salvarPessoa($pessoa);
      if($retorno[0] === true){
          modal1($retorno[1],"../index.php");
      }else{
          modal2($retorno[1]);
      }
  }
  else if($opt == "pedido"){
      
      $resumo = array( $_SESSION['p_tipo'],$_POST["resumo"],$_SESSION['p_id']);
      $dao=new AdmDao();
      if($dao->salvarPedido($resumo)){
          modal("Pedido realizado");
      }else{
          modal("Erro ao fazer pedido realizado");
      }
      
  }else if($opt=="suporte"){
       $resumo = array($_POST["resumo"],$_SESSION['p_id']);
      $dao=new AdmDao();
      if($dao->suportePedido($resumo)){
          modal2("Pedido realizado");
      }else{
          modal2("Erro ao fazer pedido realizado");
      }
}else if($opt=="suporteR"){
    $dao = new AdmDao();
    if($dao->envioSolucao($_POST['texto'], $_POST['a_id'])){
        modal3("Solução enviada");    
    }else{
        modal3("Erro ao enviar solução");   
    }
}
  
  function modal($texto) {

    echo "    
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>" . $texto . "</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                window.location.href='../View/conta.php';        
            }
            </script>
            </body>
            ";
}

  function modal1($texto,$volta){
    echo "
  <link href='vedor/css/bootstrap.css' rel='stylesheet'>    
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-body'>
      <br/>
        <h4>".$texto."</h4>
      <br/>
        <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
      </div>
    </div>
  </div>
  <script>
          function cadRealizado(){
 window.location.href='".$volta."';          
}
               
                  </script>
 </body>
";
      
  }
  function modal2($texto){
       echo " 
            <link href='vedor/css/bootstrap.css' rel='stylesheet'>    
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>" . $texto . "</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                history.go(-1)  ;        
            }
            </script>
            </body>
            ";
      
  }
    function modal3($texto){
       echo " 
            <link href='vedor/css/bootstrap.css' rel='stylesheet'>    
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>".$texto. "</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                history.go(-2)  ;        
            }
            </script>
            </body>
            ";
      
  }
       