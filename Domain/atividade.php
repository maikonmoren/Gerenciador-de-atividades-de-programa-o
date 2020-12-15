<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of atividade
 *
 * @author maikon.rosa
 */
class atividade {
        private $a_id;
        private $a_titulo;
        private $a_info;
        private $a_codigo;
        private $a_arquivo;
        private $a_entrada;
        private $a_data;
        private $t_codigo;
        
        function getA_id() {
            return $this->a_id;
        }

        function getA_titulo() {
            return $this->a_titulo;
        }

        function getA_codigo() {
            return $this->a_codigo;
        }
        function getA_entrada() {
            return $this->a_entrada;
        }

        function setA_entrada($a_entrada) {
            $this->a_entrada = $a_entrada;
        }

        function getA_data() {
            return $this->a_data;
        }

        function setA_id($a_id) {
            $this->a_id = $a_id;
        }

        function setA_titulo($a_titulo) {
            $this->a_titulo = $a_titulo;
        }

        function setA_codigo($a_codigo) {
            $this->a_codigo = $a_codigo;
        }

        function setA_data($a_data) {
            $this->a_data = $a_data;
        }
        function getT_codigo() {
            return $this->t_codigo;
        }

        function setT_codigo($t_codigo) {
            $this->t_codigo = $t_codigo;
        }
        function getA_info() {
            return $this->a_info;
        }

        function setA_info($a_info) {
            $this->a_info = $a_info;
        }

        function getA_arquivo() {
            return $this->a_arquivo;
        }

        function setA_arquivo($a_arquivo) {
            $this->a_arquivo = $a_arquivo;
        }



}
