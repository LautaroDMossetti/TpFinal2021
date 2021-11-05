<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Career as Career;
    
    class CareerDAO implements IDAO
    {
        private $connection;
        private $tableName = "careers";

        function Add($career){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (description, active) VALUES (:description, :active);";
                

                $parameters['description'] = $career->getDescription();
                $parameters['active'] = $career->getActive();

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
                    $career = new Career();

                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);

                    $this->add($career);
                }

            }catch(Exception $ex){
                throw $ex;
            }
        }
        */
    }
?>