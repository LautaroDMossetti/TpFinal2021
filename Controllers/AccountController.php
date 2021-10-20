<?php
    namespace Controllers;

    use Controllers\HomeController as HomeController;
    use Models\Admin as Admin;
    use Models\Student as Student;
    use Controllers\APIController as APIController;

    class AccountController{

        public function Login($email, $password){
            
            $homeController = new HomeController();

            //API
            $apiController = new APIController();

            $studentsList = $apiController->GetAll();

            //Login as admin
            if($email == 'admin123@admin123.com' && $password == 'adminPass'){

                $loggedUser = new Admin();

                $loggedUser->setAdminId(1);//Temporal value
                $loggedUser->setEmail($email);
                $loggedUser->setPassword($password);

                $_SESSION['loggedUser'] = $loggedUser;

                $this->ShowMainView();
            }
            //Login as student
            elseif($email != null){
                $i = 0;

                while($i != count($studentsList) && $studentsList[$i]['email'] != $email){
                    $i++;
                }

                if($i != count($studentsList) && $studentsList[$i]['email'] == $email){
                    if($studentsList[$i]['dni'] == $password){

                        $loggedUser = new Student();
                        $loggedUser->setStudentId($studentsList[$i]['studentId']);
                        $loggedUser->setCareerId($studentsList[$i]['careerId']);
                        $loggedUser->setFirstName($studentsList[$i]['firstName']);
                        $loggedUser->setLastName($studentsList[$i]['lastName']);
                        $loggedUser->setDni($studentsList[$i]['dni']);
                        $loggedUser->setPassword($studentsList[$i]['dni']);//Temporal value
                        $loggedUser->setFileNumber($studentsList[$i]['fileNumber']);
                        $loggedUser->setGender($studentsList[$i]['gender']);
                        $loggedUser->setBirthDate($studentsList[$i]['birthDate']);
                        $loggedUser->setEmail($studentsList[$i]['email']);
                        $loggedUser->setPhoneNumber($studentsList[$i]['phoneNumber']);
                        $loggedUser->setActive($studentsList[$i]['active']);

                        $_SESSION['loggedUser'] = $loggedUser;

                        $this->ShowMainView();
                    }else{
                        $homeController->Index('Datos incorrectos');
                    }
                }else{
                    $homeController->Index('Datos incorrectos');
                }
            }else{
                $homeController->Index('Ingrese un email');
            }

        }

        public function Logout(){
            session_destroy();

            $this->ShowLoginView("Cierre de session exitoso");
        }

        public function ShowMainView(){
            require_once(VIEWS_PATH."main.php");
        }

        public function ShowLoginView($message = "")
        {
            require_once(VIEWS_PATH."login.php");
            
            ?>

            <h5 style="text-align: center; color: green"><?php echo $message; ?></h5>
            
            <?php
        }
    }
?>