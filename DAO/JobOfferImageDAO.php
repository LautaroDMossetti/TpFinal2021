<?php
    namespace DAO;
    use DAO\IDAO;
    use Models\JobOffer as JobOffer;
    use \Exception as Exception;
    use Models\JobOfferImage as JobOfferImage;

    class JobOfferImageDao implements IDAO{
        private $conection;
        private $tableName = "jobOfferImages";

        public function getOneByJobOfferId($jobOfferId){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId=:jobOfferId;";

                $parameters['jobOfferId'] = $jobOfferId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $jobOfferImage = new JobOfferImage();

                if($resultSet != null){  
                    $jobOfferImage->setJobOfferImageId($resultSet[0]['jobOfferImageId']);
                    $jobOfferImage->setJobOfferId($resultSet[0]['jobOfferId']);
                    $jobOfferImage->setImage($resultSet[0]['image']);
                }

                return $jobOfferImage;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferImageId=:jobOfferImageId;";

                $parameters['jobOfferImageId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $jobOfferImage = new JobOfferImage();

                if($resultSet != null){  
                    $jobOfferImage->setJobOfferImageId($resultSet[0]['jobOfferImageId']);
                    $jobOfferImage->setJobOfferId($resultSet[0]['jobOfferId']);
                    $jobOfferImage->setImage($resultSet[0]['image']);
                }

                return $jobOfferImage;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $jobOfferImageList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $jobOfferImage = new jobOfferImage();

                    $jobOfferImage->setJobOfferImageId($row['jobOfferImageId']);
                    $jobOfferImage->setJobOfferId($row['jobOfferId']);
                    $jobOfferImage->setImage($row['image']);
                    
                    array_push($jobOfferImageList, $jobOfferImage);
                }
                
                return $jobOfferImageList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE jobOfferImageId=:jobOfferImageId;";
                
                $parameters['jobOfferImageId'] = $id;
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function add($newJobOfferImage){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, image) VALUES (:jobOfferId, :image);";
                
                $parameters['jobOfferId'] = $newJobOfferImage->getJobOfferId();
                $parameters['image'] = $newJobOfferImage->getImage();
                
                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function modify($modifiedJobOfferImage){
            try
            {
                $query = "UPDATE ".$this->tableName." SET jobOfferId = :jobOfferId, image = :image WHERE jobOfferImageId=:jobOfferImageId;";

                $parameters['jobOfferImageId'] = $modifiedJobOfferImage->getJobOfferImageId();
                $parameters['jobOfferId'] = $modifiedJobOfferImage->getJobOfferId();
                $parameters['image'] = $modifiedJobOfferImage->getImage();

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