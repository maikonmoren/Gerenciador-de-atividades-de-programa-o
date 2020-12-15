<?php

include_once("factory.php");

 
 class AdmDao {
   public function salvarPedido($resumo){
         try{
           $query = "INSERT INTO admin_pedido VALUES (null,:tipo,:texto,0,:id);";
            $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ':tipo' => $resumo[0],
                   ':texto'=> $resumo[1],
                   ':id'=>$resumo[2]
             ));
                 return (true);               
            } catch(PDOException $e){
                echo $e;
                return false;  
            }  
        }
          public function suportePedido($resumo){
         try{
           $query = "INSERT INTO suporte VALUES (null,:texto,0,'Não resolvido',:id);";
            $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ':texto'=> $resumo[0],
                   ':id'=>$resumo[1]
             ));
                 return (true);               
            } catch(PDOException $e){
                echo $e;
                return false;  
            }  
        }
     public function stPedido($dados){
         try{
           $query = "UPDATE tb_pessoa set p_tipo = p_tipo+1 where p_id = :id;";
           $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ':id'=> $dados,
           ));
                 return (true);               
            } catch(PDOException $e){
                echo $e;
                return false;  
            } 
            
        }
        public function rPedido($dados){
         try{
           $query = "UPDATE tb_pessoa set p_tipo = p_tipo-1 where p_id = :id;";
           $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ':id'=> $dados,
           ));
                 return (true);               
            } catch(PDOException $e){
                echo $e;
                return false;  
            }  
        }
        public function atPedido($dados,$id){
         try{
           $query = "UPDATE admin_pedido set pedido_st = ".$dados." where p_id = ".$id.";";
           $pdo = Connection::getConexao()->prepare($query)->execute();
                 return (true);               
            } catch(PDOException $e){
                echo $e;
                return false;  
            }  
        }
         public function envioSolucao($solu,$s_id){
            try {
         $query = "UPDATE suporte set s_solucao =:solu,s_situacao = 1 where s_id =:s_id;";
         $stmt = Connection::getConexao()->prepare($query)->execute(array(
             ":solu" => $solu,
             ":s_id" => $s_id
             
         ));  
         return (true);
            } catch (Exception $ex) {
                echo 'erro'.$ex->getMessage();
                return (false);
            }
      
           
    }
}
