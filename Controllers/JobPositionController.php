<?php
    namespace Controllers;

    use Models\JobPosition as JobPosition;
    use Models\Alert as Alert;
    use Exception;
    use DAO\JobPositionDAO as JobPositionDAO;

    class JobPositionController{
        private $jobPositionDAO;
        
        public function __construct()
        {
            $this->jobPositionDAO = new JobPositionDAO();
        }

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->jobPositionDAO->recieveFromAPI($APIData);
        }
        */
    }
?>