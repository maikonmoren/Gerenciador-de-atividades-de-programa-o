<?php
	include_once("pessoa.php");

    class turma{
      
      
        private $t_nome;
        private $t_desc;
        private $t_senha;
        private $t_codigo;
        private $t_codigo2;
        private $t_dono ;
        private $t_att;

       

        function getT_nome() {
            return $this->t_nome;
        }

        function getT_desc() {
            return $this->t_desc;
        }

        function getT_senha() {
            return $this->t_senha;
        }

        function getT_codigo() {
            return $this->t_codigo;
        }
        function getT_att(){
            return $this->t_att;
        }
        function getT_dono() {
            return $this->t_dono;
        }
        

        function setT_nome($t_nome) {
            $this->t_nome = $t_nome;
        }

        function setT_desc($t_desc) {
            $this->t_desc = $t_desc;
        }

        function setT_senha($t_senha) {
            $this->t_senha = sha1($t_senha);
        }

        function setT_codigo() {
            $this->t_codigo = "T".substr(uniqid(rand()), 5,7 )."C"
            .substr(uniqid(rand()), 0, 2)."C"
            .substr(uniqid(rand()), 0, 2);;
        }
        function setT_att($t_att) {
            $this->t_att = $t_att;
        }

        function setT_dono($t_dono) {
            $this->t_dono = $t_dono;
        }
        function getT_codigo2() {
            return $this->t_codigo2;
        }

        function setT_codigo2($t_codigo2) {
            $this->t_codigo2 = $t_codigo2;
        }


    }
