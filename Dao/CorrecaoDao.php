<?php

include_once("factory.php");
include_once("../Domain/atividade.php");
class CorrecaoDao {

    public $executavel;
   //teste de codigo do professor 
    public function verificaprofessor($atividade){
         try{
        $query = "select p_copilador from tb_pessoa where p_id =".$_SESSION['p_id'].";";
        $statement = Connection::getConexao()->prepare($query);
        $statement->execute();
        $linha = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() > 0){
            $jdk = $linha['p_copilador'];
             $saida = $this::copilacaoErro($atividade,$jdk);
            exec("del *.txt");
            exec("del *.class");
            exec("del *.java");
            return $saida;
        }
        
       } catch (PDOException $e){
           return  false;
       }      
    }
    public function copilacaoErro($atividade,$jdk){
         putenv($jdk);
         $arquivo_erro="error.txt";
         $executavel="*.class";
         $comando="javac ".$atividade->getA_arquivo();	
         $comando_erro=$comando." 2>".$arquivo_erro;
         $professor = fopen($atividade->getA_arquivo(), "w+");
         fwrite($professor, $atividade->getA_codigo());
         fclose($professor);
         exec("cacls  $executavel /g everyone:f"); 
         exec("cacls  $arquivo_erro /g everyone:f");
         shell_exec($comando_erro);
         $erro= file_get_contents($arquivo_erro);
         $entradas = $this::SeparaEntrada($atividade->getA_entrada().";");
         if(trim($erro)==""){
                for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($atividade->getA_arquivo(), PATHINFO_FILENAME) . " < entrada.txt");
                }
                return TRUE;
            }else if(!strpos($erro,"error")){
                 for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($atividade->getA_arquivo(), PATHINFO_FILENAME) . " < entrada.txt");
                }
                return True;
            }else{
                return FALSE;
            }
        
    }
   //fim de teste de codigo do professor
  //Inicia pegando os parametros do banco;
    public function IniciaParametros($atividade){
        try{
        $query = "select * from vw_copilador where ID = :id and pid = ".$_SESSION['p_id'].";";
        $statement = Connection::getConexao()->prepare($query);
        $statement->bindValue(":id", $atividade->getA_id());
        $statement->execute();
        $linha = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() > 0){
            $info = array(
                $linha['Arquivo'],$linha['codigo'],$linha['entrada'],$linha['copilador']
            );
            $entradas = $this::SeparaEntrada($info[2].";");
            //recupera se tem erro ou não na saida do aluno
            $a_saida = $this::CopilaAluno($atividade,$entradas,$info[3]);
            if($a_saida[0] == 2){
                return $a_saida;
            } else {
            $p_saida = $this::CopilaProfessor($info[0],$info[1],$entradas,$info[3]);
            $compara = $this::ComparaCódigo($a_saida,$p_saida, count($entradas));
            exec("del *.txt");
            exec("del *.class");
            exec("del *.java");
            return $compara;
            }
        
        }
        
       } catch (PDOException $e){
           return  $entradas = array(
                "erro","erro","erro","erro"
            );
       }      
    }
   // separa as variaveis para copilar
    public function SeparaEntrada($entrada){
        $entradas = array();
        $cont = 0;
        $in = "";
        for($i = 0;$i< strlen($entrada);$i++){
          if ($entrada{$i} === ';') {
                    $cont++;
                    $entradas[] = $in;
                    $in = "";
                } else {
                    $in = $in . $entrada{$i};
                }
        }
        return $entradas;
    }

    public function CopilaAluno($atividade,$entradas,$copilador){
         putenv($copilador);
         $arquivo_erro="error.txt";
         $executavel="*.class";
         $comando="javac ".$atividade->getA_arquivo();	
         $comando_erro=$comando." 2>".$arquivo_erro;
         $aluno = fopen($atividade->getA_arquivo(), "w+");
         fwrite($aluno, $atividade->getA_codigo());
         fclose($aluno);
         exec("cacls  $executavel /g everyone:f"); 
         exec("cacls  $arquivo_erro /g everyone:f");
         shell_exec($comando_erro);
         $erro= file_get_contents($arquivo_erro);
         if(trim($erro)==""){
                for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($atividade->getA_arquivo(), PATHINFO_FILENAME) . " < entrada.txt");
                }
                return $saida;
            }else if(!strpos($erro,"error")){
                 for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($atividade->getA_arquivo(), PATHINFO_FILENAME) . " < entrada.txt");
                }
                return $saida;
            }else{
                return $saidaerro = array(2,"<pre>".$erro."<pre>");
            }
    }
    public function CopilaProfessor($arquivo,$codigo,$entradas,$copilador){
         putenv($copilador);
         $arquivo_erro="error.txt";
         $executavel="*.class";
         $comando="javac ".$arquivo;	
         $comando_erro=$comando." 2>".$arquivo_erro;
         $professor = fopen($arquivo, "w+");
         fwrite($professor, $codigo);
         fclose($professor);
         exec("cacls  $executavel /g everyone:f"); 
         exec("cacls  $arquivo_erro /g everyone:f");
         shell_exec($comando_erro);
         $erro= file_get_contents($arquivo_erro);
         if(trim($erro)==""){
                for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($arquivo, PATHINFO_FILENAME) . " < entrada.txt");
                }
                return $saida;
            }else if(!strpos($erro,"error")){
                 for($i=0; $i<count($entradas);$i++){
                    $file_in = fopen('entrada.txt', "w+");
                    fwrite($file_in, $entradas[$i]);
                    fclose($file_in);
                    $saida[] = shell_exec("java " . pathinfo($arquivo, PATHINFO_FILENAME) . " < entrada.txt");
                }
                return $saida;
            }else{
                return $saidaerro = array($erro);
            }
        
    }
    public function ComparaCódigo($aluno, $professor , $entrada){
        $ponto = 0;
        $comparacao = "";
        for($i = 0; $i<$entrada ; $i++){
           if($aluno[$i]==$professor[$i]){
               $ponto++;
        
           }
           $comparacao =$comparacao."Entrada &nbsp; ".($i+1)
                   ."<br>Resultado do aluno:<div><code>".$aluno[$i]
                   ."</code></div><br>Resultado do Professor:<div><code>".$professor[$i]."</code></div><hr>";
        }
        
        
        if($ponto == $entrada){
            return $resultado = array(1,$comparacao);
        }
        if($ponto > 0){
            return $resultado = array(2,$comparacao);
        }
        if($ponto==0){
             return $resultado = array(2,$comparacao);
        }
        
       
        
    }
}
