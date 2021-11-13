<?php
    namespace Controllers;

    use Controllers\CompanyController as CompanyController;
    use DAO\JobOfferDao as JobOfferDao;
    use Models\JobOffer as JobOffer;
    use Models\Alert as Alert;
    use \Exception as Exception;

    class JobOfferController{
        private $jobOfferDao;

        public function __construct()
        {
            $this->jobOfferDao = new JobOfferDao();
        }

        public function ShowAddView($idJobPosition){
            require_once(VIEWS_PATH."jobOfferAdd.php");
        }

        public function ShowListView($alert = ""){
            $jobOfferList = $this->jobOfferDao->GetAll();
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }

        /*
        public function ShowOfferByCompanyView($id){
            $jobsList=$this->jobOfferDao->serchByCompany($id);
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }

        public function ShowOfferByJobView($id){
            $jobsList=$this->jobOfferDao->serchByJob($id);
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }
        

        public function ShowModifyView($idJobOffer){
            require_once(VIEWS_PATH."JobOfferModify.php");
        }
        */

        public function Remove($id){
            $alert = new Alert("", "");

            try{
                $this->jobOfferDao->remove($id);

                $alert->setType("success");
                $alert->setMessage("Oferta de trabajo eliminada con exito");
            }catch(Exception $ex)
            {
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        public function Add($companyName,$idJobPosition,$fecha,$detalle){
            $alert = new Alert("", "");

            try{
                $jobOffer=new JobOffer();

                $companyController = new CompanyController();

                $compny = $companyController->getOneByName($companyName);

                if($compny != null){
                    $jobOffer->setFecha($fecha);
                    $jobOffer->setDetalle($detalle);
                    $jobOffer->setIdCompany($compny->getCompanyId());
                    $jobOffer->setIdJobPosition($idJobPosition);
                    
                    $this->jobOfferDao->Add($jobOffer); 

                    $alert->setType("success");
                    $alert->setMessage("Oferta de Trabajo guardada con exito");
                }else{
                    $alert->setType("danger");
                    $alert->setMessage("Error al solicitar empresa");
                }
            }catch(Exception $ex)
            {
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        public function modify($IdJobOffer,$idCompany,$idJobPosition,$fecha,$detalle){
            $alert = new Alert("", "");

            try{
                $joboffer=new JobOffer();

                $joboffer->setIdJobOffer($IdJobOffer);
                $joboffer->setFecha($fecha);
                $joboffer->setDetalle($detalle);
                $joboffer->setIdCompany($idCompany);
                $joboffer->setIdJobPosition($idJobPosition);

                $this->jobOfferDao->modify($joboffer);

                $alert->setType("success");
                $alert->setMessage("Oferta de Trabajo modificada con exito");
            }catch(Exception $ex)
            {
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }
    }
?>