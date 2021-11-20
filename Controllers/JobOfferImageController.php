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
        
        public function UploadImage($jobOfferId, $image){
            $alert = new Alert("", "");
            $jobOfferController = new JobOfferController();

            var_dump($image);
            /*
            try{
                
                $img_name = $_FILES['my_image']['name'];
                $img_size = $_FILES['my_image']['size'];
                $tmp_name = $_FILES['my_image']['tmp_name'];
                $error = $_FILES['my_image']['error'];
                
                if ($error === 0) {
                    if ($img_size > 125000) {
                        $em = "Sorry, your file is too large.";
                        header("Location: index.php?error=$em");
                    }else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                
                        $allowed_exs = array("jpg", "jpeg", "png"); 
                
                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                            $img_upload_path = 'uploads/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            // Insert into Database
                        }else {
                            $em = "You can't upload files of this type";
                            header("Location: index.php?error=$em");
                        }
                    }
                }else {
                    $em = "unknown error occurred!";
                    header("Location: index.php?error=$em");
                }

                $alert->setType("success");
                $alert->setMessage("Imagen subida con exito");
            }catch (Exception $ex){
                $alert->setType("danger");
                $alert->setMessage($ex->getMessage());
            }finally{
                $jobOfferController->ShowModifyView($jobOfferId, $alert);
            }
            */
        }
    }
?>