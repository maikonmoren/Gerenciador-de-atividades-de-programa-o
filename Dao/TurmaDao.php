<link href="../vedor/css/bootstrap.css" rel="stylesheet">
<link href="../vedor/css/snippets.css" rel="stylesheet">
<?php
   
    include_once("factory.php");
    include_once("../Domain/turma.php");

    class TurmaDao{
       
	public function salvarTurma($turma){
         try{
                 $query = "INSERT INTO tb_turma VALUES (:codigo,:nome,:t_desc,:dono,:att,:senha);";
                 $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ":codigo"=>$turma->getT_codigo(),
                   ":nome"=>$turma->getT_nome(),
                   ":t_desc"=>$turma->getT_desc(),
                   ":dono"=>$turma->getT_dono(),
                   ":att"=>$turma->getT_att(),
                   ":senha"=>$turma->getT_senha(),
                 ));
                 return (true);                           
            } catch(PDOException $e){
                return (false);  
            }  
        }
          public function TurmaLogin($turma){
            $query = "select t_codigo from tb_turma where t_codigo = :codigo and t_senha=:senha ";
            $statement = Connection::getConexao()->prepare($query);
            $statement->bindValue(":codigo",$turma->getT_codigo2());
            $statement->bindValue(":senha",$turma->getT_senha());
            $statement->execute();
            if($statement->rowCount() == 1){
                return true;                             
            }else{
                return false; 
            }  
        }
        // faz o relacionamento entre pessoa e sala
          public function pe_tuAdd($id_sala){
          
            $query = "select p_id from pe_tu where p_id =".$_SESSION['p_id']." and t_codigo='".$id_sala."';";
            $pdo = Connection::getConexao()->prepare($query);
            $pdo->execute();
            if($pdo->rowCount() == 1){
                return true;
          }else{
            $query = "INSERT INTO pe_tu VALUES (".$_SESSION['p_id'].",'".$id_sala."');";
            $pdo = Connection::getConexao()->prepare($query);
            if($pdo->execute()){
                return true;
            }else{ 
                return false;    
          }
          }
          }
          public function excluirTurma($t_codigo){
          try{
              $query = "delete from tb_turma where t_codigo='".$t_codigo."'";
          $pdo = Connection::getConexao()->prepare($query);
            if($pdo->execute()){
               return true;
            }else{ 
               return false;    
          }
          } catch (PDOException $e){
          echo 'erro'. $e->getMessage();
          }
    
    }
    public function atSala($turma){
          try{
                 $query = "UPDATE tb_turma set t_nome = :nome ,t_desc = :t_desc where t_codigo = :codigo;";
                 $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ":nome"=>$turma->getT_nome(),
                   ":t_desc"=>$turma->getT_desc(),
                   ":codigo"=>$turma->getT_codigo2(),
                 ));
                 return (true);                           
            } catch(PDOException $e){
                return (false);  
            }
        
    }
    }