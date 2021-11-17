<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($alert = "")
        {
            require_once(VIEWS_PATH."login.php");
        }
    }
?>