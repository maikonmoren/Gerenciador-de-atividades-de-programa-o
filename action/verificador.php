<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verificador
 *
 * @author maikon.rosa
 */
class verificador {
  public function verificaLogin(){
      if (!$_SESSION['p_id']) {
	header('location: ../view/index.php');
      exit(); 
  }
}
public function verificaTurma($turma){
     if (!$_SESSION['turma'] || $_SESSION['turma'] != $turma ){
	header('location: ../view/home.php');
        exit(); 
}
}
}
