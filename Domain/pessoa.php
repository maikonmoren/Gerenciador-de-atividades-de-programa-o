<?php
	

    class pessoa{
        private $id;
        private $nome;
        private $email;
        private $senha;
	private $usuario;
        private $jdk;
        function getJdk() {
            return $this->jdk;
        }

        function setJdk($jdk) {
            $this->jdk = "PATH=".$jdk;
        }

                
        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }
        function getEmail() {
            return $this->email;
        }

        function setEmail($email) {
            $this->email = $email;
        }

                function getSenha() {
            return $this->senha;
        }

        function getUsuario() {
            return $this->usuario;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function setSenha($senha) {
            $this->senha = sha1($senha);
        }

        function setUsuario($usuario) {
            $this->usuario = $usuario;
        }


        
    }
