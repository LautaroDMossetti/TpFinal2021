<?php
    namespace Models;
    class Company{
        private $id;
        private $nombre;
        private $estado;
        private $companyLink;
        private $cuit;
        private $descripcion;
        
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre=$nombre;
        }
        public function getId(){
            return $this->id;
        }
        public function setId($Id){
            $this->id=$Id;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion=$descripcion;
        }
        public function getCuit(){
            return $this->cuit;
        }
        public function setCuit($cuit){
            $this->cuit=$cuit;
        }
        public function getCompanyLink(){
            return $this->companyLink;
        }
        public function setCompanyLink($companyLink){
            $this->companyLink=$companyLink;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }
    }
?>