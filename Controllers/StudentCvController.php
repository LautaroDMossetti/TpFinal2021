<?php
    namespace Controllers;

    use Models\Alert as Alert;
    use \Exception as Exception;
    use Models\Student as Student;
    use Models\StudentCv as StudentCv;
    use DAO\StudentCvDAO as StudentCvDAO;
    use Models\Company as Company;
    use Controllers\StudentController as StudentController;

    class StudentCvController{
        private $studentCvDAO;

        public function __construct()
        {
            $this->studentCvDAO = new StudentCvDAO();
        }

        public function GetOneByStudentId($studentId){
            $studentCv = new StudentCv();
            
            $studentCv = $this->studentCvDAO->getOneByStudentId($studentId);
            
            return $studentCv;
        }
        
        public function UploadCv($cv){
            $alert = new Alert("", "");
            $studentController = new StudentController();
            
            try{

                if(isset($_SESSION['studentId']) && $cv != null){
                    $studentId = $_SESSION['studentId'];

                    if($cv['error'] === 0){
                        if($cv['size'] < 1250000){
                            $exts = explode("/",$cv['type']);

                            if(in_array("pdf",$exts)){
                                $fileName = rand(100000000,1000000000)."-".$cv['name'];

                                move_uploaded_file($cv['tmp_name'], dirname(__DIR__)."../Uploads/StudentCvs/" . $fileName);

                                $newStudentCv = new StudentCv();

                                $newStudentCv->setStudentId($studentId);
                                $newStudentCv->setCv($fileName);

                                $oldStudentCv = $this->studentCvDAO->getOneByStudentId($studentId);

                                if($oldStudentCv->getStudentCvId() != null){
                                    $newStudentCv->setStudentCvId($oldStudentCv->getStudentCvId());

                                    $this->studentCvDAO->modify($newStudentCv);

                                    $alert->setType("success");
                                    $alert->setMessage("CV modificado con exito");
                                }else{
                                    $this->studentCvDAO->add($newStudentCv);

                                    $alert->setType("success");
                                    $alert->setMessage("CV subido con exito");
                                }
                            }else{
                                $alert->setType("danger");
                                $alert->setMessage("Solo se admiten documentos pdf");
                            }
                        }else{
                            $alert->setType("danger");
                            $alert->setMessage("Tamaño del archivo no puede exceder 1MB");
                        }
                    }else{
                        $alert->setType("danger");
                        $alert->setMessage("Error al subir CV");
                    }
                }else{
                    $alert->setType("danger");
                    $alert->setMessage("Error al subir CV");
                }
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $studentController->ShowStudentProfileView($studentId, $alert);
            }
        }
    }
?>