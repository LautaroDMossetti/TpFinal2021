<?php
    namespace Controllers;
    use Controllers\APIController as APIController;
    use Models\JobPosition as JobPosition;

    class JobPositionController{
        public function ShowPositionView(){
            $apiController=new APIController();
            $jobPositionList=$apiController->GetJobPosition();
            require_once("JobPositionView.php");
        }
        
    }
?>