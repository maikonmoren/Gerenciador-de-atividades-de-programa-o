<link href="../vedor/css/bootstrap.css" rel="stylesheet">
<link href="../vedor/css/snippets.css" rel="stylesheet">
<?php
session_start();
include_once("../Dao/AtividadeDao.php");
include_once("../Dao/AdmDao.php");
include_once("../Dao/PessoaDao.php");

$opt = $_GET["opt"];
$id = $_GET["id"];

if($opt=="1"){
     $dao = new AdmDao();
     if($dao->stPedido($id)){
        if($dao->atPedido(1,$id)){
         modal("Professor adicionado");
        }else{
          modal("Erro ao alterar situação do pedido");  
        }
     }else{
          modal("Erro para adicionar permissão");
     }
}
if($opt=="2"){
   $dao = new AdmDao();
     if($dao->atPedido(2,$id)){
         modal("Pedido negado ");
     }else{
         modal("Erro para adicionar permissão");
     }
    
}else if($opt=="r_p"){
     $dao = new AdmDao();
     if($dao->rPedido($id)){
          modal("Permissão removida"); 
     }else{
          modal("Erro remover permissão");
     }
    
}

 function modal($texto) {

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
                window.location.href='../View/adm.php';        
            }
            </script>
            </body>
            ";
}
    function modal1($texto) {

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
                history.go(-1);        
            }
            </script>
            </body>
            ";
}
  

  
       