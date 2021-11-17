<?php
    namespace Controllers;

    use DAO\API as API;
    use \Exception as Exception;

    class APIController{
        private $API;

        public function __construct(){
            $this->API = new API();
        }
        
        public function GetAllStudents(){
            $APIData = $this->API->getAllStudents();

            if($APIData == null || key($APIData) != 0){
                return false;
            }

            return $APIData;
        }

        public function GetAllCareers(){
            $APIData = $this->API->getAllCareers();

            if($APIData == null || key($APIData) != 0){
                return false;
            }

            return $APIData;
        }

        public function GetAllJobPositions(){
            $APIData = $this->API->getAllJobPositions();

            if($APIData == null || key($APIData) != 0){
                return false;
            }

            return $APIData;
        }

        /*
        public function ValidateDatabase($APIStudents, $APICareers, $APIJobPositions){
            try{
                $studentController = new StudentController();
                $careerController = new CareerController();
                $jobPositionController = new JobPositionController();

                $studentController->ValidateStudentsAgainstAPI($APIStudents);
                $careerController->ValidateCareersAgainstAPI($APICareers);
                $jobPositionController->ValidateJobPositionsAgainstAPI($APIJobPositions);
            }catch(Exception $ex)
            {
                throw $ex;
            }

        }
        */

        /*
        public function TransferStudentsToDB(){
            $APIData = $this->API->GetAllStudents();

            $studentController = new StudentController();

            $studentController->RecieveFromAPI($APIData);
        }
        */

        /*
        public function TransferCareersToDB(){
            $APIData = $this->API->GetAllCareers();

            $careerController = new CareerController();

            $careerController->RecieveFromAPI($APIData);
        }
        */
    
        /*
        public function TransferJobPositionsToDB(){
            $APIData = $this->API->GetAllJobPositions();

            $jobPositionController = new JobPositionController();

            $jobPositionController->RecieveFromAPI($APIData);
        }
        */
    }
?>