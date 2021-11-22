<?php
    namespace Controllers;

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Student as Student;
    use Controllers\CompanyController as CompanyController;
    use Controllers\CompanyUserController as CompanyUserController;
    use Models\Alert as Alert;
    use \Exception as Exception;
    use Models\Company as Company;
    use Models\CompanyUser as CompanyUser;

    class AccountController{

        public function SignInAsUnregisteredCompanyUser($email, $password, $cuit, $nombre, $estado, $companyLink, $descripcion){
            $alert = new Alert("", "");
            
            $companyController = new CompanyController();
            $companyUserController = new CompanyUserController();
            $newCompanyUser = new CompanyUser();
            $newCompany = new Company();
            $homeController = new HomeController();
            
            try{
                $companyController->AddFromController($cuit, $nombre, $estado, $companyLink, $descripcion);

                $newCompany = $companyController->GetOneByCuit($cuit);

                $newCompanyUser->setCompanyId($newCompany->getCompanyId());
                $newCompanyUser->setEmail($email);
                $newCompanyUser->setPassword($password);

                $companyUserController->AddFromController($newCompanyUser);

                $alert->setType("success");
                $alert->setMessage("Cuenta de Empresa creada con exito, ahora puede ingresar con su nueva cuenta");

                $homeController->Index($alert);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());

                $accountType = "empresaSinRegistrar";

                $this->ShowSignInView($alert, $accountType, $email, $password, $cuit);
            }
        }

        public function SignInAsCompanyUser($email, $password, $cuit){
            $alert = new Alert("", "");

            $companyController = new CompanyController();
            $companyUserController = new CompanyUserController();
            $homeController = new HomeController();

            $companiesList = array();

            try{
                $companiesList = $companyController->GetAll();

                if($email != null && $password != null && $cuit != null){
                    $i = 0;
    
                    while($i != count($companiesList) && $companiesList[$i]->getCuit() != $cuit){
                        $i++;
                    }
    
                    if($i != count($companiesList) && $companiesList[$i]->getCuit() == $cuit){
                        $newCompanyUser = new CompanyUser();
    
                        $newCompanyUser->setCompanyId($companiesList[$i]->getCompanyId());
                        $newCompanyUser->setEmail($email);
                        $newCompanyUser->setPassword($password);
                        
                        $companyUserController->AddFromController($newCompanyUser);
    
                        $alert->setType("success");
                        $alert->setMessage("Cuenta de Empresa creada con exito, ahora puede ingresar con su nueva cuenta");
    
                        $homeController->Index($alert);
                        
                    }else{
                        $alert->setType("progress");
                        $alert->setMessage("Ingrese los datos de su Empresa");
    
                        $accountType = "empresaSinRegistrar";
    
                        $this->ShowUnregisteredCompanySignInView($alert, $accountType, $email, $password, $cuit);
                    }
                }
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());

                $accountType = "empresa";

                $this->ShowSignInView($alert, $accountType);
            }


        }

        public function SignInAsStudent($email, $dni){
            $alert = new Alert("", "");
            
            $homeController = new HomeController();

            $studentController = new StudentController();

            //API
            $apiController = new APIController();

            $studentsList = $apiController->GetAllStudents();

            if($studentsList == false){
                $alert->setType("danger");
                $alert->setMessage('Error al comunicar con la API');
                $this->ShowSignInView($alert);
            }elseif($email != null){
                $i = 0;

                while($i != count($studentsList) && $studentsList[$i]['email'] != $email){
                    $i++;
                }

                if($i != count($studentsList) && $studentsList[$i]['email'] == $email){
                    if($studentsList[$i]['dni'] == $dni){
                            
                        if($studentsList[$i]['active'] == true){

                            try{
                                $newStudent = new Student();
                                $newStudent->setStudentId($studentsList[$i]['studentId']);
                                $newStudent->setCareerId($studentsList[$i]['careerId']);
                                $newStudent->setFirstName($studentsList[$i]['firstName']);
                                $newStudent->setLastName($studentsList[$i]['lastName']);
                                $newStudent->setDni($studentsList[$i]['dni']);
                                $newStudent->setFileNumber($studentsList[$i]['fileNumber']);
                                $newStudent->setGender($studentsList[$i]['gender']);
                                $newStudent->setBirthDate($studentsList[$i]['birthDate']);
                                $newStudent->setEmail($studentsList[$i]['email']);
                                $newStudent->setPassword($studentsList[$i]['dni'] . "00");
                                $newStudent->setPhoneNumber($studentsList[$i]['phoneNumber']);
                                $newStudent->setActive($studentsList[$i]['active']);
                                
                                $studentController->AddFromController($newStudent);
                                
                                $alert->setType("success");
                                $alert->setMessage('Cuenta creada con exito, ahora puede logearse con su nueva cuenta, recuerde que su contraseña es su dni con dos ceros agregados al final');
                                $homeController->Index($alert);
                            }catch(Exception $ex){
                                $alert->setType("danger");
                                $alert->setMessage($ex->getMessage());
                                
                                $this->ShowSignInView($alert);
                            }
                        }else{
                            $alert->setType("danger");
                            $alert->setMessage('Este estudiante ya no pertenece dentro del sistema');
                            $homeController->Index($alert);
                        }
                    }else{
                        $alert->setType("danger");
                        $alert->setMessage('Datos incorrectos');
                        $this->ShowSignInView($alert);
                    }
                }else{
                    $alert->setType("danger");
                    $alert->setMessage('Datos incorrectos');
                    $this->ShowSignInView($alert);
                }
            }else{
                $alert->setType("danger");
                $alert->setMessage('Ingrese sus datos');
                $this->ShowSignInView($alert);
            }
        }

        public function Login($email, $password){
            $alert = new Alert("", "");
            $alert2 = new Alert("", "");

            $i = 0;
            
            $homeController = new HomeController();
            $apiController = new APIController();
            $careerController = new CareerController();
            $jobPositionController = new JobPositionController();
            $studentController = new StudentController();
            $companyUserController = new CompanyUserController();

            $careersList = $apiController->GetAllCareers();
            $jobPositionsList = $apiController->GetAllJobPositions();
            $studentsList = $apiController->GetAllStudents();

            try{
                
                if($careersList != false && $jobPositionsList != false){
                    $careerController->UpdateDatabase($careersList);
                    $jobPositionController->UpdateDatabase($jobPositionsList);
                    $studentController->UpdateDatabaseNoAdd($studentsList);
                }else{
                    $alert2->setType("warning");
                    $alert2->setMessage("Error al validar la base de datos con la API, el sistema utilizara los ultimos registros de la base de datos");
                }

                $studentsList = array();
                $studentsList = $studentController->GetAllIgnoreActive();
                $companyUsersList = $companyUserController->GetAll();

                //Login as admin
                if($email == 'admin123@admin123.com' && $password == 'adminPass'){

                    $loggedUser = new Admin();

                    $loggedUser->setAdminId(1);//Temporal value
                    $loggedUser->setEmail($email);
                    $loggedUser->setPassword($password);

                    $_SESSION['loggedUser'] = $loggedUser;

                    $this->ShowMainView($alert, $alert2);
                }
                elseif($email != null){
                    $i = 0;
                    
                    while($i != count($companyUsersList) && $companyUsersList[$i]->getEmail() != $email){
                        $i++;
                    }

                    if($i != count($companyUsersList) && $companyUsersList[$i]->getEmail() == $email){
                        if($companyUsersList[$i]->getPassword() == $password){
                            $loggedUser = new CompanyUser();
    
                            $loggedUser->setCompanyUserId($companyUsersList[$i]->getCompanyUserId());
                            $loggedUser->setCompanyId($companyUsersList[$i]->getCompanyId());
                            $loggedUser->setEmail($companyUsersList[$i]->getEmail());
                            $loggedUser->setPassword($companyUsersList[$i]->getPassword());

                            $_SESSION['loggedUser'] = $loggedUser;
                            
                            $this->ShowMainView($alert, $alert2);
                        }else{
                            $alert->setType("danger");
                            $alert->setMessage('Datos incorrectos');
                            $homeController->Index($alert);
                        }
                    }else{
                        $i = 0;

                        while($i != count($studentsList) && $studentsList[$i]->getEmail() != $email){
                            $i++;
                        }

                        if($i != count($studentsList) && $studentsList[$i]->getEmail() == $email){
                            if($studentsList[$i]->getPassword() == $password){
                                if($studentsList[$i]->getActive() == true){
                                    $loggedUser = new Student();

                                    $loggedUser->setStudentId($studentsList[$i]->getStudentId());
                                    $loggedUser->setCareerId($studentsList[$i]->getCareerId());
                                    $loggedUser->setFirstName($studentsList[$i]->getFirstName());
                                    $loggedUser->setLastName($studentsList[$i]->getLastName());
                                    $loggedUser->setDni($studentsList[$i]->getDni());
                                    $loggedUser->setFileNumber($studentsList[$i]->getFileNumber());
                                    $loggedUser->setGender($studentsList[$i]->getGender());
                                    $loggedUser->setBirthDate($studentsList[$i]->getBirthDate());
                                    $loggedUser->setEmail($studentsList[$i]->getEmail());
                                    $loggedUser->setPassword($studentsList[$i]->getPassword());
                                    $loggedUser->setPhoneNumber($studentsList[$i]->getPhoneNumber());
                                    $loggedUser->setActive($studentsList[$i]->getActive());
                                    
                                    $_SESSION['loggedUser'] = $loggedUser;
                                    
                                    $this->ShowMainView($alert, $alert2);
                                }else{
                                    $alert->setType("danger");
                                    $alert->setMessage('Este estudiante ya no pertenece dentro del sistema');
                                    $homeController->Index($alert);
                                }
                            }else{
                                $alert->setType("danger");
                                $alert->setMessage('Datos incorrectos');
                                $homeController->Index($alert);
                            }
                        }else{
                            $alert->setType("danger");
                            $alert->setMessage('Datos incorrectos');
                            $homeController->Index($alert);
                        }
                    }
                }else{
                    $alert->setType("danger");
                    $alert->setMessage('Ingrese sus datos');
                    $homeController->Index($alert);
                }
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());

                $homeController->Index($alert);
            }
        }

        public function Logout(){
            session_destroy();

            $alert = new Alert("", "");
            $homeController = new HomeController();

            $alert->setType("success");
            $alert->setMessage('Cierre de session exitoso');

            $homeController->Index($alert);
        }

        public function ShowMainView($alert = "", $alert2 = ""){
            require_once(VIEWS_PATH."main.php");
        }

        public function ShowProfileView(){
            require_once(VIEWS_PATH."StudentProfile.php");
        }

        public function ShowSignInView($alert = "",$accountType = ""){
            require_once(VIEWS_PATH."signIn.php");
        }

        public function ShowUnregisteredCompanySignInView($alert , $accountType, $email, $password, $cuit){
            require_once(VIEWS_PATH."signIn.php");
        }
    }
?>