<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IDAO as Idao;
    use Models\Student as Student;    
    use DAO\Connection as Connection;

    class StudentDAO implements Idao
    {
        private $connection;
        private $tableName = "students";

        public function Add($student)
        {
            
        }

        public function GetAll()
        {
            
        }
    }
?>