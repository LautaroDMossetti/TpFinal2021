<?php
    namespace Controllers;

    use Exception as Exception;
    use Models\Company as Company;
    use Models\Alert as Alert;
    use Models\CompanyUser as CompanyUser;
    use Models\Student as Student;
    use DAO\CompanyUserDAO as CompanyUserDAO;
    use Controllers\JobOfferController as JobOfferController;
    use Controllers\StudentController as StudentController;
    use Controllers\CompanyController as CompanyController;
    use Controllers\StudentXJobOfferController as StudentXJobOfferController;
use Models\JobOffer;

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

        public function GetOneByCompanyId($id){
            $companyUser = new CompanyUser();
            $companyUser = $this->companyUserDAO->getOnebyCompanyId($id);

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

        public function ShowPersonalJobOfferListView($id,$alert = ""){
            $jobOfferList = array();

            $jobOfferController = new JobOfferController();
            $companyController = new CompanyController();

            $jobOfferList = $jobOfferController->FilterByCompanyId($id);
            $company = $companyController->GetOne($id);

            require_once(VIEWS_PATH."CompanysJobOfferList.php");
        }

        public function ShowJobOfferApplications($jobOfferId, $alert = ""){
            $studentXJobOfferController = new StudentXJobOfferController();
            $studentController = new StudentController();
            $jobOfferController = new JobOfferController();

            $studentList = array();
            
            $jobOffer = $jobOfferController->GetOne($jobOfferId);
            $applicationList = $studentXJobOfferController->filterByJobOfferId($jobOfferId);

            foreach($applicationList as $row){
                $student = $studentController->GetOne($row->getStudentId());

                array_push($studentList, $student);
            }

            require_once(VIEWS_PATH."JobOfferApplicationsView.php");
        }

        public function FilterApplicationsListByLastName($lastName, $jobOfferId){
            $alert = new Alert("", "");
            
            try{
                $studentXJobOfferController = new StudentXJobOfferController();
                $studentController = new StudentController();
                $jobOfferController = new JobOfferController();

                $studentList = array();
                
                $jobOffer = $jobOfferController->GetOne($jobOfferId);
                $applicationList = $studentXJobOfferController->filterByJobOfferId($jobOfferId);

                foreach($applicationList as $row){
                    $student = $studentController->GetOne($row->getStudentId());

                    array_push($studentList, $student);
                }

                $alert->setType("success");
                $alert->setMessage("Resultados de Apellido ". $lastName);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."JobOfferApplicationsView.php");
            }
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

        public function FilterJobOfferListByCareer($careerDescription, $companyId){
            $alert = new Alert("", "");

            try{
                $jobOfferList = array();
            
                $jobOfferController = new JobOfferController();
                $companyController = new CompanyController();

                $jobOfferList = $jobOfferController->FilterByCompanyId($companyId);
                $company = $companyController->GetOne($companyId);
                
                $alert->setType("success");
                $alert->setMessage("Resultado de Carreras de nombre ". $careerDescription);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."CompanysJobOfferList.php");
            }
        }

        public function FilterJobOfferListByJobPosition($jobPositionDescription, $companyId){
            $alert = new Alert("", "");

            try{
                $jobOfferList = array();
            
                $jobOfferController = new JobOfferController();
                $companyController = new CompanyController();

                $jobOfferList = $jobOfferController->FilterByCompanyId($companyId);
                $company = $companyController->GetOne($companyId);
                
                $alert->setType("success");
                $alert->setMessage("Resultado de Puestos de nombre ". $jobPositionDescription);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."CompanysJobOfferList.php");
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