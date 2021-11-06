<?php
    namespace Controllers;

    use Models\Career as Career;
    use Models\Alert as Alert;
    use Exception;
    use DAO\CareerDAO as CareerDAO;

    class CareerController{
        private $careerDAO;
        
        public function __construct()
        {
            $this->careerDAO = new CareerDAO();
        }

        public function ValidateCareersAgainstAPI($APIData){
            try{
                $this->careerDAO->validateCareersAgainstAPI($APIData);
            }catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->careerDAO->recieveFromAPI($APIData);
        }
        */
    }
?>