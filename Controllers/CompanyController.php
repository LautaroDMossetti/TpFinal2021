<?php
    namespace Controllers;

    use DAO\CompanyDAO;
    use Models\Company;

    class CompanyController{
        private $companyDao;
        
        public function __construct()
        {
            $this->companyDao = new CompanyDAO();
        }
        
        public function ShowListView(){
            $companyList = $this->companyDao->getAll();
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function ShowOneView($nombre){
            $companyList = $this->companyDao->getOne($nombre);
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function ShowAddView($message = ""){
            require_once(VIEWS_PATH."CompanyAdd.php");
            ?>
            <h5 style="text-align: center;"><?php echo $message; ?></h5>
            <?php
        }

        public function ShowModifyView($id, $message = ""){
            require_once(VIEWS_PATH."CompanyModify.php");
            ?>
            <h5 style="text-align: center;"><?php echo $message; ?></h5>
            <?php
        }
        
        public function Add($link,$cuit,$nombre,$descripcion,$estado){
            $company = new Company();

            $company->setCompanyLink($link);
            $company->setCuit($cuit);
            $company->setNombre($nombre);
            $company->setDescripcion($descripcion);
            $company->setEstado($estado);

            $this->companyDao->Add($company);
            $this->showAddView("Empresa guardada con exito");
        }

        public function Remove($id){
            $this->companyDao->remove($id);
            $this->ShowListView();
        }

        public function Modify($id, $nombre, $descripcion, $cuit, $estado, $companyLink){
            $modifiedCompany = new Company();

            $modifiedCompany->setId($id);
            $modifiedCompany->setNombre($nombre);
            $modifiedCompany->setDescripcion($descripcion);
            $modifiedCompany->setCuit($cuit);
            $modifiedCompany->setEstado($estado);
            $modifiedCompany->setCompanyLink($companyLink);

            $this->companyDao->modify($modifiedCompany);

            $this->ShowListView();
        }

        public function FilterByName($nombre){
            $companyList = array();

            $companyList = $this->companyDao->filterByName($nombre);

            require_once(VIEWS_PATH."List-Company.php");
        }

        public function ShowCompanyProfileView($id){
            $company = new Company();
            $company = $this->companyDao->getOne($id);

            require_once(VIEWS_PATH.'CompanyProfile.php');
        }
    }
?>