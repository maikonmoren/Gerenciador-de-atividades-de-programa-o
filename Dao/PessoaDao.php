<?php
    /**
     * Crud de pessoa 
     */
    
    include_once("factory.php");
    include_once("../Domain/Pessoa.php");

    class PessoaDAO{
   // salvar pessoa 		
	public function salvarPessoa($pessoa){
          try{
            $query = "select p_usuario , p_email from tb_pessoa where p_usuario = :usuario or p_email = :email; ";
            $statement = Connection::getConexao()->prepare($query);
            $statement->bindValue(":usuario",$pessoa->getUsuario());
            $statement->bindValue(":email",$pessoa->getEmail());
            $statement->execute();
            $dados = $statement->fetch(PDO::FETCH_ASSOC); 
                 if($statement->rowCount() == 1){
                     if($dados['p_usuario']== $pessoa->getUsuario()){
                         return $retorno = array(FALSE,"Usúario já existente");
                     }else if($dados['p_email']== $pessoa->getEmail()){
                         return $retorno = array(FALSE,"E-mail já utilizado");
                     }  
                 }else{
                 $query = "INSERT INTO tb_pessoa VALUES (null,:nome,:email,:usuario,:senha,1,:jdk);";
                 $pdo = Connection::getConexao()->prepare($query)->execute(array(
                   ':nome' => $pessoa->getNome(),
                   ':email'=> $pessoa->getEmail(),
                   ':usuario'=>$pessoa->getUsuario(),
                   ':senha'=>$pessoa->getSenha(),
                    ':jdk' =>$pessoa->getJdk()
                 ));
                 }
                 return $retorno = array(true,"Inscrição concluída");                           
            } catch(PDOException $e){
                return $retorno = array(FALSE,"Erro na inscrição ");
            }
        }
   // login     
        public function PessoaLogin($pessoa){
       try{
            $query = "select p_id,p_usuario,p_tipo from tb_pessoa where p_usuario = :usuario and p_senha=:senha ";
            $statement = Connection::getConexao()->prepare($query);
            $statement->bindValue(":usuario",$pessoa->getUsuario());
            $statement->bindValue(":senha",$pessoa->getSenha());
            $statement->execute();
            $linha = $statement->fetch(PDO::FETCH_ASSOC);    
            if($statement->rowCount() == 1){
                     session_start();
                     $_SESSION['p_id'] = $linha['p_id'] ;
                     $_SESSION['p_usuario'] = $linha['p_usuario'];
                     $_SESSION['p_tipo'] = $linha['p_tipo'];    
                     return (true);
                                
            }else
                return (false);  
            } catch(PDOException $e){
                return (false); 
            }  
        }
    }
   
        
 
    
?>