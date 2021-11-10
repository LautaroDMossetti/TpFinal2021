<?php
    namespace Controllers;

use DAO\CompanyDAO;
use DAO\JobOfferDao as JobOfferDao;
use DAO\StudentDAO;
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
        public function showModifyView($idJobOffer){
            require_once(VIEWS_PATH."JobOfferModify.php");
        }
        public function Remove($id){
            $this->JobOfferDao->remove($id);
            require_once(VIEWS_PATH."ShowJobOfferList");
        }
        public function add($companyName,$idJobPosition,$fecha,$detalle){
            $joboffer=new JobOffer();
            $companyDap=new CompanyDAO;
            $joboffer->setFecha($fecha);
            $joboffer->setDescripcion($detalle);
            $compny=$companyDap->getOne($companyName);
            $joboffer->setIdCompany($compny->getIdCompany());
            $joboffer->setIdJobPosition($idJobPosition);
            $this->jobOfferDao->Add($joboffer);
        }
        public function modify($idCompany,$idJobPosition,$fecha,$detalle){
            $joboffer=new JobOffer();
            $joboffer->setFecha($fecha);
            $joboffer->setDescripcion($detalle);
            $joboffer->setIdCompany($idCompany);
            $joboffer->setIdJobPosition($idJobPosition);
            $this->jobOfferDao->modify($joboffer);
        }
        public function Alpy($idJobOffer,$idStudent){
            $studentDao=new StudentDAO();
            if(isset($idJobOffer)){
                if(true==$studentDao->checkJobOffer($idJobOffer)){
                    $studentDao->aply($idJobOffer,$idStudent);
                }
            }
        }
    }
?>