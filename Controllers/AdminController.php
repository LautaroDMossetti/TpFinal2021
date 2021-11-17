<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;
    use Controllers\JobOfferController as JobOfferController;
    use Models\Alert as Alert;
    use Exception as Exception;


    class AdminController{

        public function ShowAdminView($alert = ""){
            require_once(VIEWS_PATH."AdministrationView.php");
        }

        public function ShowDeclineApplicationView($studentId, $jobOfferId){
            $studentController = new StudentController();
            $jobOfferController = new JobOfferController();

            $student = $studentController->GetOne($studentId);
            $jobOffer = $jobOfferController->GetOne($jobOfferId);

            require_once(VIEWS_PATH."DeclineApplicationView.php");
        }

        public function DeclineApplication($studentId, $jobOfferId, $reason = "Decision del Personal Academico"){
            $alert = new Alert("", "");

            try{
                $studentXJobOfferController = new StudentXJobOfferController();
                $studentController = new StudentController();
                $jobOfferController = new JobOfferController();
                
                $jobOffer = $jobOfferController->GetOne($jobOfferId);
                
                $student = $studentController->GetOne($studentId);

                $jobOfferController->SendApplicationDeclinationMail($jobOffer, $student, $reason);
                
                $studentXJobOfferController->RemoveByBothIds($studentId,$jobOfferId);

                $alert->setType("success");
                $alert->setMessage("Postulacion declinada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $studentController->ShowStudentApplications($studentId, $alert);
            }
        }
    }