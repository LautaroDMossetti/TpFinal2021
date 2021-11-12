<?php
    namespace Controllers;

    use Models\Student as Student;
    use Models\Alert as Alert;
    use Exception;
    use DAO\StudentDao as StudentDao;

    class StudentController{
        private $studentDao;
        
        public function __construct()
        {
            $this->studentDao = new StudentDao();
        }

        public function Add($newStudent){
            $this->studentDao->add($newStudent);
        }

        public function GetAllStudents(){
            try{
                $studentList = $this->studentDao->getAll();
                return $studentList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
        public function ValidateStudentsAgainstAPI($APIData){
            try{
                $this->studentDao->validateStudentsAgainstAPI($APIData);
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }
        */

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->studentDao->recieveFromAPI($APIData);
        }
        */
    }
?>