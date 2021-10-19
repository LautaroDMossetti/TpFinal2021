<?php
    namespace Controllers;
    use DAO\CompanyDAO;
    use Models\Company;
    class CompanyController{
        private $companyDao;
        
        public function __construct()
        {
            $companyDao=new CompanyDAO();
        }
        
        public function showListView(){
            $companyList=$this->companyDao->getAll();
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function showOneView($nombre){
            $companyList=$this->companyDao->getOne($nombre);
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function showAddView(){
            require_once(VIEWS_PATH."CompanyAdd.php");
        }
        
        public function Add($link,$cuit,$nombre,$id,$descripcion,$estado){
            $company=new Company();
            $company->setCompanyLink($link);
            $company->setCuit($cuit);
            $company->setNombre($nombre);
            $company->setId($id);
            $company->setDescripcion($descripcion);
            $company->setEstado($estado);
            $this->companyDao->Add($company);
            $this->showAddView();
        }
    }
?>