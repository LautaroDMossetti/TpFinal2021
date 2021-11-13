<?php
    namespace Controllers;

    use Models\Career as Career;
    use Models\Alert as Alert;
    use Exception as Exception;
    use DAO\CareerDAO as CareerDAO;

    class CareerController{
        private $careerDAO;
        
        public function __construct()
        {
            $this->careerDAO = new CareerDAO();
        }

        public function UpdateDatabase($APIData){
            $this->careerDAO->updateDatabase($APIData);
        }

        public function GetAll(){
            $careersList = array();
            $careersList = $this->careerDAO->getAll();
            
            return $careersList;
        }

        public function GetOne($id){
            $career = new Career();
            $career = $this->careerDAO->getOne($id);

            return $career;
        }

        /*
        public function ValidateCareersAgainstAPI($APIData){
            try{
                $this->careerDAO->validateCareersAgainstAPI($APIData);
            }catch(Exception $ex)
            {
                throw $ex;
            }
            
        }
        */

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->careerDAO->recieveFromAPI($APIData);
        }
        */
    }
?>