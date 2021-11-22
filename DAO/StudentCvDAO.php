<?php
    namespace DAO;
    use DAO\IDAO;
    use \Exception as Exception;
    use Models\StudentCv as StudentCv;

    class StudentCvDAO implements IDAO{
        private $conection;
        private $tableName = "studentCvs";

        public function getOneByStudentId($studentId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE studentId=:studentId;";

                $parameters['studentId'] = $studentId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $studentCv = new StudentCv();

                if($resultSet != null){  
                    $studentCv->setStudentCvId($resultSet[0]['studentCvId']);
                    $studentCv->setStudentId($resultSet[0]['studentId']);
                    $studentCv->setCv($resultSet[0]['cv']);
                }

                return $studentCv;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE studentCvId=:studentCvId;";

                $parameters['studentCvId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $studentCv = new StudentCv();

                if($resultSet != null){  
                    $studentCv->setStudentCvId($resultSet[0]['studentCvId']);
                    $studentCv->setStudentId($resultSet[0]['studentId']);
                    $studentCv->setCv($resultSet[0]['cv']);
                }

                return $studentCv;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $studentCvList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $studentCv = new StudentCv();

                    $studentCv->setStudentCvId($row['studentCvId']);
                    $studentCv->setStudentId($row['studentId']);
                    $studentCv->setCv($row['cv']);
                    
                    array_push($studentCvList, $studentCv);
                }
                
                return $studentCvList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE studentCvId=:studentCvId;";
                
                $parameters['studentCvId'] = $id;
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function add($newStudentCv){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId, cv) VALUES (:studentId, :cv);";
                
                $parameters['studentId'] = $newStudentCv->getStudentId();
                $parameters['cv'] = $newStudentCv->getCv();
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function modify($modifiedStudentCv){
            try
            {
                $query = "UPDATE ".$this->tableName." SET studentId = :studentId, cv = :cv WHERE studentCvId=:studentCvId;";

                $parameters['studentCvId'] = $modifiedStudentCv->getStudentCvId();
                $parameters['studentId'] = $modifiedStudentCv->getStudentId();
                $parameters['cv'] = $modifiedStudentCv->getCv();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>