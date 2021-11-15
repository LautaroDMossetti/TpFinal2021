<?php
    namespace Controllers;

    use Controllers\JobPositionController as JobPositionController;
    use Controllers\CareerController as CareerController;
    use Controllers\CompanyController as CompanyController;
    use Controllers\CompanyUserController as CompanyUserController;
    use DAO\JobOfferDao as JobOfferDao;
    use Models\JobPosition as JobPosition;
    use Models\Alert as Alert;
    use \Exception as Exception;
    use Models\Career;
    use Models\JobOffer as JobOffer;

class JobOfferController{
        private $jobOfferDao;

        public function __construct()
        {
            $this->jobOfferDao = new JobOfferDao();
        }

        public function ShowListView($alert = ""){
            $jobOfferList = array();
            $jobOfferList = $this->jobOfferDao->getAll();
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }

        public function ShowPersonalListView($id,$alert = ""){
            $jobOfferList = array();
            $companyController = new CompanyController();

            $jobOfferList = $this->jobOfferDao->filterByCompanyId($id);
            $company = $companyController->GetOne($id);

            require_once(VIEWS_PATH."CompanysJobOfferList.php");
        }

        public function ShowJobOfferDetailsView($id, $alert = ""){
            $companyController = new CompanyController();
            $jobPositionController = new JobPositionController();
            $careerController = new CareerController();
            $companyUserController = new CompanyUserController();
        
            $jobOffer = $this->jobOfferDao->getOne($id);
            $company = $companyController->GetOne($jobOffer->getCompanyId());
            $companyUser = $companyUserController->GetOneByCompanyId($company->getCompanyId());
            $jobPosition = $jobPositionController->GetOne($jobOffer->getJobPositionId());
            $career = $careerController->GetOne($jobPosition->getCareerId());

            require_once(VIEWS_PATH."JobOfferDetailsView.php");
        }

        public function ShowModifyView($id, $alert = ""){
            $jobPositionController = new JobPositionController();
            $companyController = new CompanyController();
            
            $jobPositionList = $jobPositionController->GetAll();
            $companyList = $companyController->GetAll();

            $jobOfferToModify = $this->jobOfferDao->getOne($id);

            require_once(VIEWS_PATH."JobOfferModify.php");
        }

        public function ShowAddView($alert = ""){
            $jobPositionController = new JobPositionController();
            $companyController = new CompanyController();
            
            $jobPositionList = $jobPositionController->GetAll();
            $companyList = $companyController->GetAll();

            require_once(VIEWS_PATH."JobOfferAdd.php");
        }

        public function GetOne($id){
            $jobOffer = new JobOffer();

            $jobOffer = $this->jobOfferDao->getOne($id);

            return $jobOffer;
        }

        public function FilterByCompanyId($id){
            $jobOfferList = array();

            $jobOfferList = $this->jobOfferDao->filterByCompanyId($id);

            return $jobOfferList;
        }

        public function FilterByCareer($careerDescription){
            $alert = new Alert("", "");

            try{
                $jobOfferList = array();

                $jobOfferList = $this->jobOfferDao->getAll();
                
                $alert->setType("success");
                $alert->setMessage("Resultado de carreras de nombre ". $careerDescription);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."ShowJobOfferListView.php");
            }
        }

        public function Add($jobPositionId, $companyId, $description, $publicationDate, $expirationDate){
            $alert = new Alert("", "");
            
            try{
                $jobOffer = new JobOffer();

                $jobOffer->setJobPositionId($jobPositionId);
                $jobOffer->setCompanyId($companyId);
                $jobOffer->setDescription($description);
                $jobOffer->setPublicationDate($publicationDate);
                $jobOffer->setExpirationDate($expirationDate);

                $this->jobOfferDao->add($jobOffer);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo guardada con exito");
            }
            catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->showAddView($alert);
            }
        }

        public function FilterByJobPosition($jobPositionDescription){
            $alert = new Alert("", "");

            try{
                $jobOfferList = array();

                $jobOfferList = $this->jobOfferDao->getAll();
                
                $alert->setType("success");
                $alert->setMessage("Resultado de Puestos de nombre ". $jobPositionDescription);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."ShowJobOfferListView.php");
            }
        }

        public function SelfModify($id, $jobPositionId, $companyId, $description, $publicationDate, $expirationDate){
            $alert = new Alert("", "");
            
            try{
                $modifiedJobOffer = new JobOffer();

                $modifiedJobOffer->setJobOfferId($id);
                $modifiedJobOffer->setJobPositionId($jobPositionId);
                $modifiedJobOffer->setCompanyId($companyId);
                $modifiedJobOffer->setDescription($description);
                $modifiedJobOffer->setPublicationDate($publicationDate);
                $modifiedJobOffer->setExpirationDate($expirationDate);

                $this->jobOfferDao->modify($modifiedJobOffer);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo modificada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowPersonalListView($companyId, $alert);
            }
        }

        public function Modify($id, $jobPositionId, $companyId, $description, $publicationDate, $expirationDate){
            $alert = new Alert("", "");
            
            try{
                $modifiedJobOffer = new JobOffer();

                $modifiedJobOffer->setJobOfferId($id);
                $modifiedJobOffer->setJobPositionId($jobPositionId);
                $modifiedJobOffer->setCompanyId($companyId);
                $modifiedJobOffer->setDescription($description);
                $modifiedJobOffer->setPublicationDate($publicationDate);
                $modifiedJobOffer->setExpirationDate($expirationDate);

                $this->jobOfferDao->modify($modifiedJobOffer);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo modificada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        public function RemoveFromPersonalList($id, $companyId){
            $alert = new Alert("", "");
            $companyUserController = new CompanyUserController();
            
            try{
                $this->jobOfferDao->remove($id);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo eliminada con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowPersonalListView($companyId, $alert);
            }
        }

        public function Remove($id){
            $alert = new Alert("", "");
            
            try{
                $this->jobOfferDao->remove($id);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo eliminada con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }
        
    }
?>