<?php
    namespace DAO;

    use DAO\IDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use Models\StudentXJobOffer as StudentXJobOffer;
    use \Exception as Exception;

    class StudentXJobOfferDAO implements IDAO{
        private $conection;
        private $tableName = "studentsXJobOffers";

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE studentXJobOfferId=:studentXJobOfferId;";

                $parameters['studentXJobOfferId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $studentXJobOffer = new studentXJobOffer();

                if($resultSet != null){  
                    $studentXJobOffer->setStudentXJobOfferId($resultSet[0]["studentXJobOfferId"]);
                    $studentXJobOffer->setStudentId($resultSet[0]["studentId"]);
                    $studentXJobOffer->setJobOfferId($resultSet[0]["jobOfferId"]);
                }

                return $studentXJobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOneByBothIds($studentId, $jobOfferId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE studentId=:studentId AND jobOfferId=:jobOfferId;";

                $parameters['studentId'] = $studentId;
                $parameters['jobOfferId'] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $studentXJobOffer = new studentXJobOffer();

                if($resultSet != null){  
                    $studentXJobOffer->setStudentXJobOfferId($resultSet[0]["studentXJobOfferId"]);
                    $studentXJobOffer->setStudentId($resultSet[0]["studentId"]);
                    $studentXJobOffer->setJobOfferId($resultSet[0]["jobOfferId"]);
                }

                return $studentXJobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function removeByBothIds($studentId,$jobOfferId){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE studentId=:studentId AND jobOfferId=:jobOfferId;";
                
                $parameters['studentId'] = $studentId;
                $parameters['jobOfferId'] = $jobOfferId;
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $studentXJobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $studentXjobOffer = new StudentXjobOffer();

                    $studentXjobOffer->setStudentXJobOfferId($row['studentXJobOfferId']);
                    $studentXjobOffer->setStudentId($row['studentId']);
                    $studentXjobOffer->setJobOfferId($row['jobOfferId']);
                    
                    array_push($studentXJobOfferList, $studentXjobOffer);
                }
                
                return $studentXJobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE studentXJobOfferId=:studentXJobOfferId;";
                
                $parameters['studentXJobOfferId'] = $id;
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function add($newStudentXJobOffer){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (studentId, jobOfferId) VALUES (:studentId, :jobOfferId);";
                
                $parameters['studentId'] = $newStudentXJobOffer->getStudentId();
                $parameters['jobOfferId'] = $newStudentXJobOffer->getJobOfferId();
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByJobOfferId($id){
            try
            {
                $studentXJobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId=:jobOfferId;";

                $parameters['jobOfferId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $studentXjobOffer = new StudentXjobOffer();

                    $studentXjobOffer->setStudentXJobOfferId($row['studentXJobOfferId']);
                    $studentXjobOffer->setStudentId($row['studentId']);
                    $studentXjobOffer->setJobOfferId($row['jobOfferId']);
                    
                    array_push($studentXJobOfferList, $studentXjobOffer);
                }
                
                return $studentXJobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByStudentId($id){
            try
            {
                $studentXJobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE studentId=:studentId;";

                $parameters['studentId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $studentXjobOffer = new StudentXjobOffer();

                    $studentXjobOffer->setStudentXJobOfferId($row['studentXJobOfferId']);
                    $studentXjobOffer->setStudentId($row['studentId']);
                    $studentXjobOffer->setJobOfferId($row['jobOfferId']);
                    
                    array_push($studentXJobOfferList, $studentXjobOffer);
                }
                
                return $studentXJobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function modify($modifiedStudentXjobOffer){
            try
            {
                $query = "UPDATE ".$this->tableName." SET studentId = :studentId, jobOfferId = :jobOfferId WHERE studentXjobOfferId=:studentXjobOfferId;";

                $parameters['studentXjobOfferId'] = $modifiedStudentXjobOffer->getStudentXJobOfferId();
                $parameters['studentId'] = $modifiedStudentXjobOffer->getStudentId();
                $parameters['jobOfferId'] = $modifiedStudentXjobOffer->getJobOfferId();

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