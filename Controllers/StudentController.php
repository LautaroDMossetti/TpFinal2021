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

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->studentDao->recieveFromAPI($APIData);
        }
        */
    }
?>