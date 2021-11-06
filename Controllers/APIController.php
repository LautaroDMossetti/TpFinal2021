<?php
    namespace Controllers;

    use DAO\API as API;
    use Controllers\StudentController as StudentController;
    use Controllers\CareersController as CareersController;
    use Controllers\JobPositionController as JobPositionController;
    use \Exception as Exception;

    class APIController{
        private $API;

        public function __construct(){
            $this->API = new API();
        }
        
        public function GetAllStudents(){
            $APIData = $this->API->getAllStudents();

            return $APIData;
        }

        public function GetAllCareers(){
            $APIData = $this->API->getAllCareers();

            return $APIData;
        }

        public function GetAllJobPositions(){
            $APIData = $this->API->getAllJobPositions();

            return $APIData;
        }

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