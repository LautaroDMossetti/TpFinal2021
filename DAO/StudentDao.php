<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IDAO as IDAO;
    use Models\Student as Student;    
    use DAO\Connection as Connection;

    class StudentDAO implements IDAO
    {
        private $connection;
        private $tableName = "students";

        public function Add($student)
        {
            
        }

        public function GetAll()
        {
            
        }

        public function Remove($id)
        {
            
        }
    }
?>