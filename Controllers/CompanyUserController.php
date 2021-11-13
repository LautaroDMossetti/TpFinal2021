<?php
    namespace Controllers;

    use Exception as Exception;
    use Models\Company as Company;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use DAO\CompanyUserDAO as CompanyUserDAO;
    use Controllers\CompanyController as CompanyController;

    class CompanyUserController{
        private $companyUserDAO;

        public function __construct()
        {
            $this->companyUserDAO = new CompanyUserDAO();
        }

        public function AddFromController($newCompanyUser){
            $this->companyUserDAO->add($newCompanyUser);
        }

        public function GetAll(){
            $companyUsersList = $this->companyUserDAO->getAll();
            return $companyUsersList;
        }

        public function GetOne($id){
            $companyUser = new CompanyUser();
            $companyUser = $this->companyUserDAO->getOne($id);

            return $companyUser;
        }

        public function ShowListView($alert = ""){
            $companyUsersList = array();
            $companyUsersList = $this->companyUserDAO->getAll();
            require_once(VIEWS_PATH."CompanyUsersList.php");
        }

        public function ShowModifyView($id, $alert = ""){
            $companyUserToModify = $this->companyUserDAO->getOne($id);
            require_once(VIEWS_PATH."CompanyUserModify.php");
        }

        public function ShowAddView($alert = ""){
            $companyController = new CompanyController();
            $companiesList = $companyController->GetAll();

            require_once(VIEWS_PATH."CompanyUserAdd.php");
        }

        public function ShowCompanyUserProfileView($id){
            $alert = new Alert("", "");

            try{
                $companyController = new CompanyController();
                $companyUser = new CompanyUser();
                $company = new Company();

                $companyUser = $this->companyUserDAO->getOne($id);
                $company = $companyController->GetOne($companyUser->getCompanyId());

            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH.'CompanyProfile.php');
            }
        }

        public function SelfModify($id, $companyId, $email, $password){
            $alert = new Alert("", "");
            
            try{
                $modifiedCompanyUser = new CompanyUser();

                $modifiedCompanyUser->setCompanyUserId($id);
                $modifiedCompanyUser->setCompanyId($companyId);
                $modifiedCompanyUser->setEmail($email);
                $modifiedCompanyUser->setPassword($password);

                $this->companyUserDAO->modify($modifiedCompanyUser);

                $alert->setType("success");
                $alert->setMessage("Modificacion con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowModifyView($id, $alert);
            }
        }

        public function Modify($id, $companyId, $email, $password){
            $alert = new Alert("", "");
            
            try{
                $modifiedCompanyUser = new CompanyUser();

                $modifiedCompanyUser->setCompanyUserId($id);
                $modifiedCompanyUser->setCompanyId($companyId);
                $modifiedCompanyUser->setEmail($email);
                $modifiedCompanyUser->setPassword($password);

                $this->companyUserDAO->modify($modifiedCompanyUser);

                $alert->setType("success");
                $alert->setMessage("Usuario Empresa modificado con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        public function FilterByEmail($email){
            $alert = new Alert("", "");

            try{
                $companyUsersList = array();

                $companyUsersList = $this->companyUserDAO->filterByEmail($email);

                $alert->setType("success");
                $alert->setMessage("Resultado de empresas de email ". $email);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."CompanyUsersList.php");
            }
        }

        public function Add($companyId, $email, $password){
            $alert = new Alert("", "");
            
            try{

                $companyUser = new CompanyUser();

                $companyUser->setCompanyId($companyId);
                $companyUser->setEmail($email);
                $companyUser->setPassword($password);

                $this->companyUserDAO->add($companyUser);

                $alert->setType("success");
                $alert->setMessage("Usuario Empresa guardado con exito");
            }
            catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowAddView($alert);
            }
        }

        public function Remove($id){
            $alert = new Alert("", "");
            
            try{
                $this->companyUserDAO->remove($id);

                $alert->setType("success");
                $alert->setMessage("Usuario Empresa eliminado con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }
    }
?>