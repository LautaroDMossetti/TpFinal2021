<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\JobPosition as JobPosition;
    
    class JobPositionDAO implements IDAO
    {
        private $connection;
        private $tableName = "jobPositions";

        public function add($jobPosition){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, description) VALUES (:careerId, :description);";
                
                $parameters['careerId'] = $jobPosition->getCareerId();
                $parameters['description'] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function filterByDescription($description){
            try{
                $jobPositionList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE description LIKE :description;";

                $parameters['description'] = '%'.$description.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();

                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row["description"]);

                    array_push($jobPositionList, $jobPosition);
                }

                return $jobPositionList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $jobPositionList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();

                    $jobPosition->setJobPositionId($row['jobPositionId']);
                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row['description']);
                    
                    array_push($jobPositionList, $jobPosition);
                }

                return $jobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE jobPositionId=:jobPositionId;";

                $parameters['jobPositionId'] = $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE jobPositionId=:jobPositionId;";

                $parameters['jobPositionId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $jobPosition = new JobPosition();

                $jobPosition->setJobPositionId($resultSet[0]["jobPositionId"]);
                $jobPosition->setCareerId($resultSet[0]["careerId"]);
                $jobPosition->setDescription($resultSet[0]["description"]);

                return $jobPosition;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify($modifiedJobPosition){
            try
            {
                $query = "UPDATE ".$this->tableName." SET careerId = :careerId, description = :description WHERE jobPositionId=:jobPositionId;";

                $parameters['careerId'] = $modifiedJobPosition->getCareerId();
                $parameters['description'] = $modifiedJobPosition->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function validateJobPositionsAgainstAPI($APIData){
            try{
                foreach($APIData as $row){
                    $APIJobPosition = new JobPosition();
                    $APIJobPosition->setJobPositionId($row['jobPositionId']);
                    $APIJobPosition->setCareerId($row['careerId']);
                    $APIJobPosition->setDescription($row['description']);


                    $DBJobPosition = $this->getOne($row['jobPositionId']);

                    if($DBJobPosition != null && strcmp($DBJobPosition->toString(),$APIJobPosition->toString()) != 0){
                        $this->modify($APIJobPosition);
                    }
                }
            }catch(Exception $ex)
            {
                throw $ex;
            }

        }

        /*
        public function recieveFromAPI($APIData){       
            try{

                foreach($APIData as $row){
                    $jobPosition = new JobPosition();

                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row["description"]);

                    $this->add($jobPosition);
                }

            }catch(Exception $ex){
                throw $ex;
            }
        }
        */
    }
?>