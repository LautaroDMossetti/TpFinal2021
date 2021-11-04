<?php
    namespace Controllers;
    use DAO\JobOfferDao as JobOfferDao;
    use Models\JobOffer;
    class JobOfferController{
        private $jobOfferDao;
        public function __construct()
        {
            $this->jobOfferDao=new JobOfferDao;
        }
        public function showAddView($idJobPosition, $mensaje=""){
            require_once(VIEWS_PATH."jobOfferAddView.php");
        }
        public function showListView(){
            $jobsList=$this->jobOfferDao->GetAll();
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }
        public function showOfferByCompanyView($id){
            $jobsList=$this->jobOfferDao->serchByCompany($id);
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }
        public function showOfferByJobView($id){
            $jobsList=$this->jobOfferDao->serchByJob($id);
            require_once(VIEWS_PATH."ShowJobOfferListView.php");
        }
        public function add($idCompany,$idJobPosition,$fecha,$detalle){
            $joboffer=new JobOffer();
            $joboffer->setFecha($fecha);
            $joboffer->setDescripcion($detalle);
            $joboffer->setIdCompany($idCompany);
            $joboffer->setIdJobPosition($idJobPosition);
            $this->jobOfferDao->Add($joboffer);
            //$this->showAddView();
        }
        public function modify($idCompany,$idJobPosition,$fecha,$detalle){
            $joboffer=new JobOffer();
            $joboffer->setFecha($fecha);
            $joboffer->setDescripcion($detalle);
            $joboffer->setIdCompany($idCompany);
            $joboffer->setIdJobPosition($idJobPosition);
            $this->jobOfferDao->modify($joboffer);
        }
    }
?>