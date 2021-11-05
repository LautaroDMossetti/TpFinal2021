<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\JobPosition as JobPosition;
    
    class JobPositionDAO implements IDAO
    {
        private $connection;
        private $tableName = "jobPositions";

        function Add($jobPosition){
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
        
        function GetAll(){

        }

        function Remove($id){

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