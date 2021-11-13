<?php
    namespace Controllers;

    use Models\Student as Student;
    use Models\Alert as Alert;
    use Exception as Exception;
    use DAO\StudentDao as StudentDao;
    use Controllers\CareerController as CareerController;
    use Models\Career;

class StudentController{
        private $studentDao;
        
        public function __construct()
        {
            $this->studentDao = new StudentDao();
        }

        public function AddFromController($newStudent){
            $this->studentDao->add($newStudent);
        }

        public function GetOne($id){
            $student = new Student();
            $student = $this->studentDao->getOne($id);

            return $student;
        }

        public function GetAll(){

            $studentList = $this->studentDao->getAll();
            return $studentList;

        }

        public function ShowListView($alert = ""){
            $studentsList = array();
            $studentsList = $this->studentDao->getAll();
            require_once(VIEWS_PATH."StudentsListView.php");
        }

        public function ShowAddView($alert = ""){
            $careerController = new CareerController();

            $careersList = $careerController->GetAll();

            require_once(VIEWS_PATH."StudentAdd.php");
        }

        public function ShowModifyView($id, $alert = ""){
            $studentToModify = $this->studentDao->getOne($id);
            require_once(VIEWS_PATH."StudentModify.php");
        }

        public function ShowStudentProfileView($id){
            $careerController = new CareerController();

            $student = $this->studentDao->getOne($id);

            $studentCareer = $careerController->GetOne($student->getCareerId());
            require_once(VIEWS_PATH."StudentProfile.php");
        }

        public function SelfModify($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $email, $password, $birthDate, $phoneNumber, $active){
            $alert = new Alert("", "");
            
            try{
                $modifiedStudent = new Student();

                $modifiedStudent->setStudentId($studentId);
                $modifiedStudent->setCareerId($careerId);
                $modifiedStudent->setFirstName($firstName);
                $modifiedStudent->setLastName($lastName);
                $modifiedStudent->setDni($dni);
                $modifiedStudent->setFileNumber($fileNumber);
                $modifiedStudent->setGender($gender);
                $modifiedStudent->setEmail($email);
                $modifiedStudent->setPassword($password);
                $modifiedStudent->setBirthDate($birthDate);
                $modifiedStudent->setPhoneNumber($phoneNumber);
                $modifiedStudent->setActive($active);

                $this->studentDao->modify($modifiedStudent);

                $alert->setType("success");
                $alert->setMessage("Estudiante modificado con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowModifyView($modifiedStudent->getStudentId(),$alert);
            }
        }

        public function Modify($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $email, $password, $birthDate, $phoneNumber, $active){
            $alert = new Alert("", "");
            
            try{
                $modifiedStudent = new Student();

                $modifiedStudent->setStudentId($studentId);
                $modifiedStudent->setCareerId($careerId);
                $modifiedStudent->setFirstName($firstName);
                $modifiedStudent->setLastName($lastName);
                $modifiedStudent->setDni($dni);
                $modifiedStudent->setFileNumber($fileNumber);
                $modifiedStudent->setGender($gender);
                $modifiedStudent->setEmail($email);
                $modifiedStudent->setPassword($password);
                $modifiedStudent->setBirthDate($birthDate);
                $modifiedStudent->setPhoneNumber($phoneNumber);
                $modifiedStudent->setActive($active);

                $this->studentDao->modify($modifiedStudent);

                $alert->setType("success");
                $alert->setMessage("Estudiante modificado con exito");
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        public function FilterByLastName($lastName){
            $alert = new Alert("", "");

            try{
                $studentsList = array();

                $studentsList = $this->studentDao->filterByLastName($lastName);

                $alert->setType("success");
                $alert->setMessage("Resultado de Estudiantes de apellido ". $lastName);
            }catch(Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                require_once(VIEWS_PATH."StudentsListView.php");
            }
        }

        public function Add($careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $email, $password, $birthDate, $phoneNumber, $active){
            $alert = new Alert("", "");
            
            try{

                $student = new Student();

                $student->setCareerId($careerId);
                $student->setfirstname($firstName);
                $student->setlastName($lastName);
                $student->setDni($dni);
                $student->setFileNumber($fileNumber);
                $student->setGender($gender);
                $student->setEmail($email);
                $student->setPassword($password);
                $student->setBirthDate($birthDate);
                $student->setPhoneNumber($phoneNumber);
                $student->setActive($active);

                $this->studentDao->add($student);

                $alert->setType("success");
                $alert->setMessage("Estudiante guardado con exito");
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
                $this->studentDao->remove($id);

                $alert->setType("success");
                $alert->setMessage("Estudiante eliminado con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $this->ShowListView($alert);
            }
        }

        /*
        public function ValidateStudentsAgainstAPI($APIData){
            try{
                $this->studentDao->validateStudentsAgainstAPI($APIData);
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }
        */

        /*
        //Funcion para recibir datos desde a la API y guardarlos en una BD;
        public function RecieveFromAPI($APIData){
            $this->studentDao->recieveFromAPI($APIData);
        }
        */
    }
?>