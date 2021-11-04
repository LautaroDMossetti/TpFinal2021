<?php
    namespace DAO;
    use DAO\IDAO as IDAO;
    use Controllers\APIController as APIController;
    use Models\JobPosition as JobPosition;
    class JobPositionDao implements IDAO{
        public function GetAll()
        {
            
        }
        public function Remove($id)
        {
            
        }
        public function Add($Data)
        {
            
        }
        public function getPositionById($id){
            $apiController= new APIController();
            $jobPosition=new JobPosition();
            $row=$apiController->GetJobPosition();
            if($id!=NULL){
                foreach($row as $position){
                    if($position->getIdJobPosition()==$id){
                        $jobPosition=$position;
                    }
                }
            }
            return $jobPosition;
        }

    }
?>