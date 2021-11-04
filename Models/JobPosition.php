<?php 
    namespace Models;
    class JobPosition{
        private $IdJobPosition;
        private $descripcion;

        public function getIdJobPosition(){
            return $this->IdJobPosition;
        }
        public function setIdJobPosition($id){
            $this->IdJobPosition=$id;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion=$descripcion;
        }
    }
?>