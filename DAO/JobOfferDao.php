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
                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId=:jobOfferId;";

                $parameters['jobOfferId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $jobOffer = new JobOffer();

                if($resultSet != null){  
                    $jobOffer->setJobOfferId($resultSet[0]["jobOfferId"]);
                    $jobOffer->setJobPositionId($resultSet[0]["jobPositionId"]);
                    $jobOffer->setCompanyId($resultSet[0]["companyId"]);
                    $jobOffer->setDescription($resultSet[0]["description"]);
                    $jobOffer->setPublicationDate($resultSet[0]["publicationDate"]);
                    $jobOffer->setExpirationDate($resultSet[0]["expirationDate"]);
                }

                return $jobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();

                    $jobOffer->setJobOfferId($row['jobOfferId']);
                    $jobOffer->setJobPositionId($row["jobPositionId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setPublicationDate($row["publicationDate"]);
                    $jobOffer->setExpirationDate($row["expirationDate"]);
                    
                    array_push($jobOfferList, $jobOffer);
                }
                
                return $jobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE jobOfferId=:jobOfferId;";
                
                $parameters['jobOfferId'] = $id;
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function add($newJobOffer){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, companyId, description, publicationDate, expirationDate) VALUES (:jobPositionId, :companyId, :description, :publicationDate, :expirationDate);";
                
                $parameters['jobPositionId'] = $newJobOffer->getJobPositionId();
                $parameters['companyId'] = $newJobOffer->getCompanyId();
                $parameters['description'] = $newJobOffer->getDescription();
                $parameters['publicationDate'] = $newJobOffer->getPublicationDate();
                $parameters['expirationDate'] = $newJobOffer->getExpirationDate();
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByCompanyId($id){
            try
            {
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE companyId=:companyId;";

                $parameters['companyId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();

                    $jobOffer->setJobOfferId($row['jobOfferId']);
                    $jobOffer->setJobPositionId($row["jobPositionId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setPublicationDate($row["publicationDate"]);
                    $jobOffer->setExpirationDate($row["expirationDate"]);
                    
                    array_push($jobOfferList, $jobOffer);
                }
                
                return $jobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function modify($modifiedJobOffer){
            try
            {
                $query = "UPDATE ".$this->tableName." SET jobPositionId = :jobPositionId, companyId = :companyId, description = :description, publicationDate = :publicationDate, expirationDate = :expirationDate WHERE jobOfferId=:jobOfferId;";

                $parameters['jobOfferId'] = $modifiedJobOffer->getJobOfferId();
                $parameters['jobPositionId'] = $modifiedJobOffer->getJobPositionId();
                $parameters['companyId'] = $modifiedJobOffer->getCompanyId();
                $parameters['description'] = $modifiedJobOffer->getDescription();
                $parameters['publicationDate'] = $modifiedJobOffer->getPublicationDate();
                $parameters['expirationDate'] = $modifiedJobOffer->getExpirationDate();

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