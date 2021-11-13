<?php
    namespace Controllers;

    use DAO\CompanyDao as CompanyDao;
    use Exception as Exception;
    use Models\Company as Company;
    use Models\Alert as Alert;

    class CompanyController{
        private $companyDao;
        
        public function __construct()
        {
            $this->companyDao = new CompanyDao();
        }

        public function GetAll(){
            $companyList = array();
            $companyList = $this->companyDao->getAll();
            
            return $companyList;
        }

        public function GetOne($id){
            $company = new Company();
            $company = $this->companyDao->getOne($id);

            return $company;
        }
        
        public function ShowListView($alert = ""){
            $companyList = array();
            $companyList = $this->companyDao->getAll();
            require_once(VIEWS_PATH."List-Company.php");
        }
        
        public function ShowAddView($alert = ""){
            require_once(VIEWS_PATH."CompanyAdd.php");
        }

        public function ShowModifyView($id, $alert = ""){
            $companyToModify = $this->companyDao->getOne($id);
            require_once(VIEWS_PATH."CompanyModify.php");
        }
        
        public function AddFromController($cuit, $nombre, $estado, $companyLink, $descripcion){
            $newCompany = new Company();

            $newCompany->setNombre($nombre);
            $newCompany->setCuit($cuit);
            $newCompany->setEstado($estado);
            $newCompany->setCompanyLink($companyLink);
            $newCompany->setDescripcion($descripcion);

            $this->companyDao->add($newCompany);
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
                $this->showAddView($alert);
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
                $this->ShowListView($alert);
            }
        }

        public function GetOneByName($nombre){
            $company = new Company();

            try{
                $company = $this->companyDao->getOneByName($nombre);
            }catch(Exception $ex){
                throw $ex;
            }finally{
                return $company;
            }

        }

        public function GetOneByCuit($cuit){
            $company = new Company();

            try{
                $company = $this->companyDao->getOneByCuit($cuit);
            }catch(Exception $ex){
                throw $ex;
            }finally{
                return $company;
            }

        }

        public function SelfModify($id, $nombre, $descripcion, $cuit, $estado, $companyLink){
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
                $alert->setMessage("Modificacion realizada con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowModifyView($modifiedCompany->getCompanyId(), $alert);
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
                $this->ShowListView($alert);
            }
        }

        public function FilterByName($nombre){
            $alert = new Alert("", "");

            try{
                $companyList = array();

                $companyList = $this->companyDao->filterByName($nombre);

                $alert->setType("success");
                $alert->setMessage("Resultado de empresas de nombre ". $nombre);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."List-Company.php");
            }
        }

        public function ShowCompanyProfileView($id){
            $alert = new Alert("", "");

            try{
                $company = new Company();
                $company = $this->companyDao->getOne($id);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH.'CompanyProfile.php');
            }
        }
    }
?>