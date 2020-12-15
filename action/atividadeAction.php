<link href="../vedor/css/bootstrap.css" rel="stylesheet">
<link href="../vedor/css/snippets.css" rel="stylesheet">
<?php
session_start();
include_once ('../Dao/CorrecaoDao.php');
include_once ('../Dao/AtividadeDao.php');
include_once ('../Domain/atividade.php');
$opt = $_POST["opt"];

if ($opt == "cad_atividade") {
    $atividade = new atividade();
    $atividade->setA_titulo($_POST['a_titulo']);
    $atividade->setA_info($_POST['a_info']);
    $atividade->setA_arquivo($_POST['a_arquivo']);
    $atividade->setA_codigo($_POST['a_codigo']);
    $atividade->setA_entrada($_POST['a_entrada']);
    $atividade->setA_data($_POST['a_data']);
    $atividade->setT_codigo($_POST['t_codigo']);
    $retorno = $atividade->getT_codigo();
    $dao = new CorrecaoDao();
    if($dao->verificaprofessor($atividade)==true){
        $dao1 = new AtividadeDao();
    if ($dao1->salvarAtividade($atividade)==TRUE) {
        modal("Atividade atribuída",$retorno);
    } else {
        modal("Erro ao Salvar", $retorno);
    }
        
    }else{
         modal("Erro no arquivo", $retorno);
    }
    
   
} else if ($opt == "fazer_atividade") {
    $atividade = new atividade();
    $atividade->setA_codigo($_POST['a_codigo']);
    $atividade->setA_arquivo($_POST['a_arquivo']);
    $atividade->setA_id($_POST['a_id']);
    $dao= new CorrecaoDao();
    $compara = $dao->IniciaParametros($atividade);
    $dao1 = new AtividadeDao();
    if($dao1->BDfeito($compara[0],'<code>'.$_POST['a_codigo'].'</code><hr>'.$compara[1],$_POST['a_id'])){
        if($compara[0] == 1){
            moda2("Atividade enviada correatamente");
        }else{
            moda2("<h1>Atividade com erro</h1><br>".$compara[1]);
        }
    }else{
        modal("Erro ao corrigir", $_POST['codigo']);
    };
}else if($opt == "feedback"){;
        $dao = new  AtividadeDao();

        if($dao->envioFeed($_POST['feed'],$_POST['p_id'],$_POST['a_id'])){
            modal1("Resposta enviada", $_POST['cd']);
        } else {
             modal1("Erro ao  enviar", $_POST['cd']);    
        }
        
}else if($opt == "altera"){
     $dao = new  AtividadeDao();
    $atividade = new atividade();
    $atividade->setA_id($_POST['id']);
    $atividade->setA_titulo($_POST['a_titulo']);
    $atividade->setA_info($_POST['a_info']);
    $atividade->setA_entrada($_POST['a_entrada']);
    if($dao->atatividade($atividade)){
        moda2("Atividade alterada");
    }else{
        modal("Erro ao alterar");
    }
    
    
} else if($opt == "deleta") {
    $dao = new  AtividadeDao();
    if($dao->deleteAtividae($_POST['id']))
        moda2 ("Deletada");
    else{
        moda2 ("Erro ao deletar");
    }
    
}

function modal1($texto, $retorno) {

    echo "  
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>".$texto."</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                window.location.href='../View/painel.php?cd=".$retorno."';        
            }
            </script>
            </body>
            ";
}
function modal($texto) {

    echo "  
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>".$texto."</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                 history.go(-1)       
            }
            </script>
            </body>
            ";
}
function moda2($texto) {

    echo "  
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-body'>
            <br/>
            <pre><h4>".$texto."</h4><pre>
            <br/>
            <button type='button' onclick='cadRealizado()' class='btn btn-dark float-right'>OK</button>
            </div>
            </div>
            </div>
            <script>
                function cadRealizado(){
                 history.go(-2)       
            }
            </script>
            </body>
            ";
}
?>
 