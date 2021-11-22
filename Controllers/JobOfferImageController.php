<?php
    namespace Controllers;

    use Models\Alert as Alert;
    use \Exception as Exception;
    use DAO\JobOfferImageDao as JobOfferImageDao;
    use Models\JobOfferImage as JobOfferImage;
    use Models\Company as Company;
    use Controllers\CompanyController as CompanyController;
    use Controllers\JobOfferController as JobOfferController;

    class JobOfferImageController{
        private $jobOfferImageDao;

        public function __construct()
        {
            $this->jobOfferImageDao = new JobOfferImageDao();
        }

        public function GetOneByJobOfferId($jobOfferId){
            $jobOfferImage = new JobOfferImage();
            
            $jobOfferImage = $this->jobOfferImageDao->getOneByJobOfferId($jobOfferId);
            
            return $jobOfferImage;
        }
        
        public function UploadImage($image){
            $alert = new Alert("", "");
            $jobOfferController = new JobOfferController();
            
            try{

                if(isset($_SESSION['jobOfferToModifyId']) && $image != null){
                    $jobOfferId = $_SESSION['jobOfferToModifyId'];

                    if($image['error'] === 0){
                        if($image['size'] < 1250000){
                            $exts = explode("/",$image['type']);

                            if(in_array("png",$exts) || in_array("jpg",$exts) || in_array("jpeg",$exts)){
                                $fileName = rand(100000000,1000000000)."-".$image['name'];

                                move_uploaded_file($image['tmp_name'], dirname(__DIR__)."../Uploads/Images/" . $fileName);

                                $newJobOfferImage = new JobOfferImage();

                                $newJobOfferImage->setJobOfferId($jobOfferId);
                                $newJobOfferImage->setImage($fileName);

                                $oldImage = $this->jobOfferImageDao->getOneByJobOfferId($jobOfferId);

                                if($oldImage->getJobOfferImageId() != null){
                                    $newJobOfferImage->setJobOfferImageId($oldImage->getJobOfferImageId());

                                    $this->jobOfferImageDao->modify($newJobOfferImage);

                                    $alert->setType("success");
                                    $alert->setMessage("Imagen modificada con exito");
                                }else{
                                    $this->jobOfferImageDao->add($newJobOfferImage);

                                    $alert->setType("success");
                                    $alert->setMessage("Imagen subida con exito");
                                }
                            }else{
                                $alert->setType("danger");
                                $alert->setMessage("Solo se admiten imagenes png, jpg y jpeg");
                            }
                        }else{
                            $alert->setType("danger");
                            $alert->setMessage("Tamaño del archivo no puede exceder 1MB");
                        }
                    }else{
                        $alert->setType("danger");
                        $alert->setMessage("Error al subir imagen");
                    }
                }else{
                    $alert->setType("danger");
                    $alert->setMessage("Error al subir imagen");
                }
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $jobOfferController->ShowModifyView($jobOfferId, $alert);
            }
        }
    }
?>