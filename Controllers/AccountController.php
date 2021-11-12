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

        public function SignIn($email, $dni){
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
            }
            
            //Register Student
            if($email != null){
                $i = 0;

                while($i != count($studentsList) && $studentsList[$i]['email'] != $email){
                    $i++;
                }

                if($i != count($studentsList) && $studentsList[$i]['email'] == $email){
                    if($studentsList[$i]['dni'] == $dni){

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

                        try{
                            $studentController->Add($newStudent);
                        }catch(Exception $ex){
                            $alert->setType("danger");
                            $alert->setMessage($ex->getMessage());

                            $this->ShowSignInView($alert);
                        }

                        $alert->setType("success");
                        $alert->setMessage('Cuenta creada con exito, ahora puede logearse con su nueva cuenta, recuerde que su contraseña es su dni con dos ceros agregados al final');
                        $homeController->Index($alert);
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
            
            $homeController = new HomeController();
            $apiController = new APIController();
            $careerController = new CareerController();
            $jobPositionController = new JobPositionController();
            $studentController = new StudentController();

            $careersList = $apiController->GetAllCareers();
            $jobPositionsList = $apiController->GetAllJobPositions();

            if($careersList != false && $jobPositionsList != false){
                try{
                    $careerController->UpdateDatabase($careersList);
                    $jobPositionController->UpdateDatabase($jobPositionsList);

                }catch(Exception $ex){
                    $alert->setType("danger");
                    $alert->setMessage($ex->getMessage());

                    $homeController->Index($alert);
                }
            }else{
                $alert2->setType("warning");
                $alert2->setMessage("Error al validar Carreras y Puestos de Trabajo con la API, el sistema utilizara los ultimos registros de la base de datos");
            }

            try{
                $studentsList = $studentController->GetAllStudents();


            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());

                $homeController->Index($alert);
            }

            //Login as admin
            if($email == 'admin123@admin123.com' && $password == 'adminPass'){

                $loggedUser = new Admin();

                $loggedUser->setAdminId(1);//Temporal value
                $loggedUser->setEmail($email);
                $loggedUser->setPassword($password);

                $_SESSION['loggedUser'] = $loggedUser;

                $this->ShowMainView($alert, $alert2);
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

                        $this->ShowMainView($alert, $alert2);
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
            }else{
                $alert->setType("danger");
                $alert->setMessage('Ingrese sus datos');
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

        public function ShowSignInView($alert = ""){
            require_once(VIEWS_PATH."signIn.php");
        }
    }
?>