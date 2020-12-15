<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("factory.php");
include_once("../Domain/atividade.php");

/**
 * Description of AtividadeDao
 *
 * @author maikon.rosa
 * 
 * Essa é a parte mais complicada do sistema  e a mais importante 
 * já que ela é responsavel pela funcionalidade principal do sistema de 
 * corrigir a atividade 
 */
class AtividadeDao {
    
    public function deleteAtividae($atividade){
            try{
          $query = "delete from tb_atividade where a_id =".$atividade;
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

    public function salvarAtividade($atividade) {
        try {
            $query = "INSERT INTO tb_atividade VALUES (null,:titulo,:info,:arquivo,:codigo,:entrada,:data,:t_codigo);";
            $pdo = Connection::getConexao()->prepare($query)->execute(array(
                ":titulo" => $atividade->getA_titulo(),
                ":info" => $atividade->getA_info(),
                ":arquivo" => $atividade->getA_arquivo(),
                ":codigo" => $atividade->getA_codigo(),
                ":entrada" => $atividade->getA_entrada(),
                ":data" => $atividade->getA_data(),
                ":t_codigo" => $atividade->getT_codigo(),
            ));
            return (true);
        } catch (PDOException $e) {
            return (false);
        }
    }

    public function BDfeito($st,$erro,$a_id){
         $query = "UPDATE pe_at set pe_at_situacao = :st,pe_at_erro = :erro where p_id = :id and a_id = :a_id;";
         $stmt = Connection::getConexao()->prepare($query);
         if($stmt->execute(array(
               ":st" => $st,
                ":erro" => $erro,
                ":a_id" => $a_id,
                ":id" => $_SESSION['p_id'],
             
             
         ))){
             return true;
         }else{ 
             return false;
         }
           
    }
        public function envioFeed($feed,$p_id,$a_id){
            try {
         $query = "UPDATE pe_at set pe_at_feedback =:feed where p_id =:p_id and a_id = :a_id;";
         $stmt = Connection::getConexao()->prepare($query)->execute(array(
             ":feed" => $feed,
             ":p_id" => $p_id,
             ":a_id" => $a_id
             
         ));  
         return (true);
            } catch (Exception $ex) {
                echo 'erro'.$ex->getMessage();
                return (false);
            }
      
           
    }
        public function atatividade($atividade){
          try{
                 $query = "UPDATE tb_atividade set a_titulo = :nome ,a_info = :t_desc , a_entrada = :codigo  where a_id = :id;";
                 $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ":nome"=>$atividade->getA_titulo(),
                   ":t_desc"=>$atividade->getA_info(),
                   ":codigo"=>$atividade->getA_entrada(),
                   ":id" => $atividade->getA_id()
                 ));
                 return (true);              
            } catch(PDOException $e){
                echo '<scrpt>alert('.$e.')</script>';
                return (false);  
            }
        
    }

}
