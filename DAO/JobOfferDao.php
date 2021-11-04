<?php
    namespace DAO;
    use DAO\IDAO;
    use Models\JobOffer as JobOffer;
    use \Exception as Exception;

    class JobOfferDao implements IDAO{
        private $conection;
        private $tableName="JobOfferDao";
        public function GetAll(){
            try{
                $jobOfferList=array();
                $querry="SELECT * FROM ".$this->tableName;
                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry);
                foreach($result as $row){
                    $job=new JobOffer();
                    $job->setDescripcion($row->getDescripcion());
                    $job->setFecha($row->getFecha());
                    $job->setIdJobOffer($row->getIdJobOffer());
                    $job->setIdCompany($row->getIdCompany());
                    $job->setIdJobPosition($row->getIdJobPosition());
                    array_push($jobOfferList,$job);
                }
                return $jobOfferList;
            }
            catch(Exception $ex){
                throw($ex);
            }
        }
        public function Remove($id)
        {
            try{
                
                $querry="DELETE FROM ".$this->tableName." WHERE idJobOffer=".$id;
                $this->conection=CONNECTION::GetInstance();
                $this->conection->Execute($querry);
            }
            catch(Exception $ex){
                throw($ex);
            }
            
        }
        public function Add($jobOffer){
            try{
                $querry="INSERT INTO ".$this->tableName."(fecha,idCompany,detalle,idJobPosition), VALUES (:fecha,:idCompany,:detalle,:idJobPosition)";
                $this->conection=CONNECTION::GetInstance();
                $parameters["fecha"]=$jobOffer->getFecha();
                $parameters["idCompany"]=$jobOffer->getIdCompany();
                $parameters["detalle"]=$jobOffer->getDetalle();
                $parameters["idJobPosition"]=$jobOffer->getIdJobPosition();
                $this->conection->ExecuteNonQuery($querry,$parameters);

                
            }
            catch(Exception $ex){
                throw($ex);
            }
        }
        public function serchByCompany($idCompany){
            try{
                $querry="SELECT idJobOffer, fecha, detelle, idJobPosition ".$this->tableName."WHERE idCompany=".$idCompany;
                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry);
                return $result;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
        public function serchByJob($idJobPosition){
            try{
                $querry="SELECT idJobOffer, fecha, detelle ".$this->tableName."WHERE idJobPosition".$idJobPosition;
                $this->conection=CONNECTION::GetInstance();
                $result=$this->conection->Execute($querry);
                return $result;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
        public function modify($jobOffer){
            try{
                $querry="UPDATE ".$this->tableName."SET idCompany=".$jobOffer->getIdCompany()." fecha=".$jobOffer->getFecha()." detalle=".$jobOffer->getDetalle()."idJobPosition=".$jobOffer->getIdJobPosition()."WHERE idJObOffer=".$jobOffer->getId();
                $this->conection=CONNECTION::GetInstance();
                $this->conection->Execute($querry);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }


?>