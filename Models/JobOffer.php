<?php
    namespace Models;
    class JobOffer{
        private $IdJobOffer;
        private $idJobPosition;
        private $idCompany;
        private $detalle;
        private $fecha;
        
        public function getIdJobPosition(){
            return $this->idJobPosition;
        }
        public function setIdJobPosition($id){
            $this->idJobPosition=$id;
        }
        public function getIdCompany(){
            return $this->idCompany;
        }
        public function setIdCompany($id){
            $this->idCompany=$id;
        }
        public function getIdJobOffer(){
            return $this->IdJobOffer;
        }
        public function setIdJobOffer($id){
            $this->IdJobOffer=$id;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function setFecha($fecha){
            $this->fecha=$fecha;
        }

        public function getDetalle()
        {
                return $this->detalle;
        }

        public function setDetalle($detalle)
        {
                $this->detalle = $detalle;

                return $this;
        }
    }

?>