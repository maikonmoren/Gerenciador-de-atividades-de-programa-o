<link href="../vedor/css/bootstrap.css" rel="stylesheet">
<link href="../vedor/css/snippets.css" rel="stylesheet">
<?php
session_start();
     include_once("../Domain/turma.php");
        include_once("../Dao/TurmaDao.php");
$opt = $_POST["opt"];

$id = $_SESSION['p_id'];

  
  
  if($opt == "cad_turma"){
      $turma = new turma() ;
      $turma->setT_dono($id);
      $turma->setT_nome($_POST["t_nome"]);
      $turma->setT_desc($_POST["t_desc"]);
      if(isset($_POST['t_privado'])){
          $turma->setT_att(1);
          $turma->setT_senha($_POST["t_senha"]);        
      }else{
          $turma->setT_att(0);
      }
      $turma->setT_codigo();
      $dao = new TurmaDao();
     if($dao->salvarTurma($turma)){
         modal("Sala criada com sucesso","../view/home.php");
     }
           
  }else if($opt == "at_turma"){
      $turma = new turma() ;
      $turma->setT_nome($_POST["at_nome"]);
      $turma->setT_desc($_POST["at_desc"]);
      $turma->setT_codigo2($_POST['at_codigo']);
      $dao = new TurmaDao();
      if($dao->atSala($turma)){
             modal("Sala alterada","../view/turma.php?cd=".$_POST['at_codigo']);
      }else{
           modal("Erro ao alter","../view/turma.php?cd=".$_POST['at_codigo']);
      }
  }else if ($opt == "turma_senha"){
    
      $turma = new turma();
      $turma->setT_codigo2($_POST["cd_turma"]);
      $turma->setT_senha($_POST["salaprivada"]);    
      $dao = new TurmaDao();
      if($dao->TurmaLogin($turma)){
       if( $dao->pe_tuAdd($_POST["cd_turma"])){
        header('location: ../View/turma.php?cd='.$turma->getT_codigo2());
        exit();
       }ELSE{
           echo 'ERRO PE_TU';
       }
        
     }else{
         echo ("<script>
               window.alert('senha  incorreta')
               window.location.href='../view/home.php';
               </script>");
     } 
  }else if ($opt == "pe_tu"){
      echo "pe_tu ".$_POST["cd_turma2"];
      $dao = new TurmaDao();
      if($dao->pe_tuAdd($_POST["cd_turma2"])){
          header('location: ../View/turma.php?cd='.$_POST['cd_turma2']);
      }
      
  }else if($opt == "ex_sala"){
      $dao= new TurmaDao();
     if($dao->excluirTurma($_POST['t_codigo'])){
         modal("Sala excluida com sucesso","../view/home.php");
     }else{
        modal("Erro ao excluir sala","../view/turma.php?cd=".$_POST['t_codigo']);
     }
      
  }
    


  function modal($texto,$volta){
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
  
  function verifica($dono){
      $dao = new TurmaDao();
     if($dao->verificaDono($dono)){
         return true;
     }else{ 
         return false;
     }
  }
?>
 