<?php
    namespace Controllers;

    use Models\Alert as Alert;
    use Exception as Exception;


    class AdminController{

        public function ShowAdminView($alert = ""){
            require_once(VIEWS_PATH."AdministrationView.php");
        }
    }