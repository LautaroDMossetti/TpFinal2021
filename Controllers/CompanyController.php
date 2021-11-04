<?php
    namespace Controllers;

    use DAO\CompanyDAO;
    use Exception;
    use Models\Company;
    use Models\Alert as Alert;

    class CompanyController{
        private $companyDao;
        
        public function __construct()
        {
            $this->companyDao = new CompanyDAO();
        }
        
        public function ShowListView(){
            $companyList = array();
            $companyList = $this->companyDao->getAll();
            require_once(VIEWS_PATH."List-Company.php");
        }

        public function ShowListViewWithAlert(Alert $alert){
            $companyList = array();
            $companyList = $this->companyDao->getAll();
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function ShowAddView(){
            require_once(VIEWS_PATH."CompanyAdd.php");
        }

        public function ShowAddViewWithAlert(Alert $alert){
            require_once(VIEWS_PATH."CompanyAdd.php");
        }

        public function ShowModifyView($id){
            require_once(VIEWS_PATH."CompanyModify.php");
        }
        
        public function Add($link,$cuit,$nombre,$descripcion,$estado){
            $alert = new Alert("", "");
            
            try{

                $company = new Company();

                $company->setCompanyLink($link);
                $company->setCuit($cuit);
                $company->setNombre($nombre);
                $company->setDescripcion($descripcion);
                $company->setEstado($estado);

                $this->companyDao->Add($company);

                $alert->setType("success");
                $alert->setMessage("Empresa guardada con exito");
            }
            catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->showAddViewWithAlert($alert);
            }
        }

        public function Remove($id){
            $alert = new Alert("", "");
            
            try{
                $this->companyDao->remove($id);

                $alert->setType("success");
                $alert->setMessage("Empresa eliminada con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListViewWithAlert($alert);
            }
        }

        public function Modify($id, $nombre, $descripcion, $cuit, $estado, $companyLink){
            $alert = new Alert("", "");
            
            try{
                $modifiedCompany = new Company();

                $modifiedCompany->setCompanyId($id);
                $modifiedCompany->setNombre($nombre);
                $modifiedCompany->setDescripcion($descripcion);
                $modifiedCompany->setCuit($cuit);
                $modifiedCompany->setEstado($estado);
                $modifiedCompany->setCompanyLink($companyLink);

                $this->companyDao->modify($modifiedCompany);

                $alert->setType("success");
                $alert->setMessage("Empresa modificada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListViewWithAlert($alert);
            }
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