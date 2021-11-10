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
        public function Remove($id)
        {
            
        }
        public function checkJobOffer($idJobOffer){
            try{
                $querry="SELECT * FROM ".$this->tableName."WHERE idJobOffer=".$idJobOffer;
                $this->conection->CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry);
                if($result==NULL){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
        public function aply($idJobOffer,$idSudent){
            try{
                $querry="UPDATE idJobOffer SET".$idJobOffer."WHERE idStudent=".$idSudent;
                $this->connection->CONNECTION::GetInstance();
                $this->connection->Execute($querry);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
?>