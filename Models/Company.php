<?php
    namespace Models;
    class Company{
<<<<<<< HEAD
=======
        private $id;
>>>>>>> 7598659b62f5917367bbdc8f122c57a47cdeb58c
        private $nombre;
        private $estado;
        private $companyLink;
        private $cuit;
        private $descripcion;
<<<<<<< HEAD
        private $id;
=======
        
>>>>>>> 7598659b62f5917367bbdc8f122c57a47cdeb58c
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