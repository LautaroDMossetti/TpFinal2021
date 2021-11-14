<?php
    namespace Controllers;

    use DAO\StudentXJobOfferDAO as StudentXJobOfferDAO;
    use Models\StudentXJobOffer as StudentXJobOffer;
    use Controllers\JobOfferController as JobOfferController;
    use Models\Alert as Alert;
    use \Exception as Exception;

    class StudentXJobOfferController{
        private $studentXJobOfferDAO;

        public function __construct()
        {
            $this->studentXJobOfferDAO = new StudentXJobOfferDAO();
        }

        public function GetAll(){
            $studentXJobOfferList = $this->studentXJobOfferDAO->getAll();

            return $studentXJobOfferList;
        }

        public function filterByStudentId($id){
            $studentXJobOfferList = $this->studentXJobOfferDAO->filterByStudentId($id);

            return $studentXJobOfferList;
        }

        public function filterByJobOfferId($id){
            $studentXJobOfferList = $this->studentXJobOfferDAO->filterByJobOfferId($id);

            return $studentXJobOfferList;
        }

        public function RemoveByBothIds($studentId, $jobOfferId){
            $this->studentXJobOfferDAO->removeByBothIds($studentId, $jobOfferId);
        }

        public function Add($studentId, $jobOfferId){
            $alert = new Alert("", "");

            $jobOfferController = new JobOfferController();
            
            try{

                $studentXJobOffer = new StudentXJobOffer();

                $studentXJobOffer->setStudentId($studentId);
                $studentXJobOffer->setJobOfferId($jobOfferId);

                $this->studentXJobOfferDAO->add($studentXJobOffer);

                $alert->setType("success");
                $alert->setMessage("Postulacion guardada con exito");
            }
            catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $jobOfferController->ShowJobOfferDetailsView($jobOfferId, $alert);
            }
        }

        public function Modify($id, $studentId, $jobOfferId){
            $alert = new Alert("", "");
            
            try{
                $modifiedStudentXJobOffer = new StudentXJobOffer();

                $modifiedStudentXJobOffer->setStudentXJobOfferId($id);
                $modifiedStudentXJobOffer->setStudentId($studentId);
                $modifiedStudentXJobOffer->setJobOfferId($jobOfferId);

                $this->studentXJobOfferDAO->modify($modifiedStudentXJobOffer);

                $alert->setType("success");
                $alert->setMessage("Postulacion modificada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                //$this->ShowListView($alert);
            }
        }

        public function Remove($id){
            $alert = new Alert("", "");
            
            try{
                $this->studentXJobOfferDAO->remove($id);

                $alert->setType("success");
                $alert->setMessage("Postulacion eliminada con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                //$this->ShowListView($alert);
            }
        }
        
    }
?>