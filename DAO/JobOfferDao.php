<?php
    namespace DAO;
    use DAO\IDAO;
    use Models\JobOffer as JobOffer;
    use \Exception as Exception;

    class JobOfferDao implements IDAO{
        private $conection;
        private $tableName = "jobOffers";


        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE IdJobOffer=:IdJobOffer;";

                $parameters['IdJobOffer'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $jobOffer = new JobOffer();

                if($resultSet != null){  
                    $jobOffer->setIdJobOffer($resultSet[0]["IdJobOffer"]);
                    $jobOffer->setIdJobPosition($resultSet[0]["idJobPosition"]);
                    $jobOffer->setIdCompany($resultSet[0]["idCompany"]);
                    $jobOffer->setDetalle($resultSet[0]["detalle"]);
                    $jobOffer->setFecha($resultSet[0]["fecha"]);
                }
                
                return $jobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $jobOfferList=array();
                $querry="SELECT * FROM ".$this->tableName;
                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry);
                foreach($result as $row){
                    $job=new JobOffer();
                    $job->setDetalle($row['detalle']);
                    $job->setFecha($row['fecha']);
                    $job->setIdJobOffer($row['IdJobOffer']);
                    $job->setIdCompany($row['idCompany']);
                    $job->setIdJobPosition($row['idJobPosition']);
                    array_push($jobOfferList,$job);
                }
                return $jobOfferList;
            }
            catch(Exception $ex){
                throw($ex);
            }
        }
        public function remove($id)
        {
            try{
                
                $querry="DELETE FROM ".$this->tableName." WHERE IdJobOffer=:IdJobOffer;";

                $parameters['IdJobOffer'] = $id;

                $this->conection=CONNECTION::GetInstance();
                $this->conection->Execute($querry, $parameters);
            }
            catch(Exception $ex){
                throw($ex);
            }
            
        }
        public function Add($jobOffer){
            try{
                $querry="INSERT INTO ".$this->tableName." (fecha, idCompany, detalle, idJobPosition) VALUES (:fecha, :idCompany, :detalle, :idJobPosition);";
                $parameters["fecha"]=$jobOffer->getFecha();
                $parameters["idCompany"]=$jobOffer->getIdCompany();
                $parameters["detalle"]=$jobOffer->getDetalle();
                $parameters["idJobPosition"]=$jobOffer->getIdJobPosition();
                $this->conection=CONNECTION::GetInstance();
                $this->conection->ExecuteNonQuery($querry,$parameters);

                
            }
            catch(Exception $ex){
                throw($ex);
            }
        }
        public function serchByCompany($idCompany){
            try{
                $querry="SELECT * FROM ".$this->tableName." WHERE idCompany=:idCompany;";

                $parameters['idCompany'] = $idCompany;

                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry, $parameters);

                return $result;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
        public function serchByJob($idJobPosition){
            try{
                $querry="SELECT * FROM ".$this->tableName." WHERE idJobPosition=:idJobPosition";

                $parameters['idJobPosition'] = $idJobPosition;

                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry, $parameters);

                return $result;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
        public function modify($jobOffer){
            try{
                $querry="UPDATE ".$this->tableName." SET idCompany=:idCompany, fecha=:fecha, detalle=:detalle, idJobPosition=:idJobPosition WHERE IdJobOffer=:IdJobOffer;";
                
                $parameters['IdJobOffer'] = $jobOffer->getIdJobOffer();
                $parameters['idCompany'] = $jobOffer->getIdCompany();
                $parameters['fecha'] = $jobOffer->getFecha();
                $parameters['detalle'] = $jobOffer->getDetalle();
                $parameters['idJobPosition'] = $jobOffer->getIdJobPosition();

                $this->conection=CONNECTION::GetInstance();
                $this->conection->Execute($querry, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }


?>