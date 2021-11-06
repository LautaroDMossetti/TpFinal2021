<?php
    namespace Controllers;

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Student as Student;
    use Models\Career as Career;
    use Models\JobPosition as JobPosition;
    use Controllers\APIController as APIController;
    use Controllers\StudentController as StudentController;
    use Models\Alert as Alert;
    use \Exception as Exception;

    class AccountController{

        public function Login($email, $password){
            $alert = new Alert("", "");
            $alert2 = new Alert("", "");
            
            $homeController = new HomeController();

            $studentController = new StudentController();

            //API
            $apiController = new APIController();

            $APIStudents = $apiController->GetAllStudents();
            $APICareers = $apiController->GetAllCareers();
            $APIJobPositions = $apiController->getAllJobPositions();

            try{
                if($APIStudents != null && $APICareers != null && $APIJobPositions != null && key($APIStudents) == 0 && key($APICareers) == 0 && key($APIJobPositions) == 0){
                    $apiController->ValidateDatabase($APIStudents, $APICareers, $APIJobPositions);
                }else{
                    $alert->setType("warning");
                    $alert->setMessage("Error al comunicarse con la API, el sistema utilizara los registros de la base de datos mas recientes");
                }
            }catch(Exception $ex)
            {
                $alert->setType("warning");
                $alert->setMessage("Error al comunicarse con la API, el sistema utilizara los registros de la base de datos mas recientes");
            }finally{

                $studentsList = array();

                try{
                    $studentsList = $studentController->getAllStudents();
                }catch(Exception $ex)
                {
                    $alert->setType("danger");
                    $alert->setMessage("Error al comunicar con la base de datos");

                    $homeController->Index($alert);
                }

                //Login as admin
                if($email == 'admin123@admin123.com' && $password == 'adminPass'){

                    $loggedUser = new Admin();

                    $loggedUser->setAdminId(1);//Temporal value
                    $loggedUser->setEmail($email);
                    $loggedUser->setPassword($password);

                    $_SESSION['loggedUser'] = $loggedUser;

                    $this->ShowMainView($alert);
                }
                //Login as student
                elseif($email != null){
                    $i = 0;

                    while($i != count($studentsList) && $studentsList[$i]->getEmail() != $email){
                        $i++;
                    }

                    if($i != count($studentsList) && $studentsList[$i]->getEmail() == $email){
                        if($studentsList[$i]->getPassword() == $password){

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

                            $this->ShowMainView($alert);
                        }else{
                            $alert2->setType("danger");
                            $alert2->setMessage('Datos incorrectos');
                            $homeController->Index($alert, $alert2);
                        }
                    }else{
                        $alert2->setType("danger");
                        $alert2->setMessage('Datos incorrectos');
                        $homeController->Index($alert, $alert2);
                    }
                }else{
                    $alert2->setType("danger");
                    $alert2->setMessage('Ingrese un email');
                    $homeController->Index($alert, $alert2);
                }
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

        public function ShowMainView($alert = ""){
            require_once(VIEWS_PATH."main.php");
        }

        public function ShowProfileView(){
            require_once(VIEWS_PATH."StudentProfile.php");
        }
    }
?>