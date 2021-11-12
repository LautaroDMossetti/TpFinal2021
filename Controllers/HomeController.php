<?php
    namespace Controllers;

    use Controllers\APIController as APIController;

    class HomeController
    {
        public function Index($alert = "")
        {
            require_once(VIEWS_PATH."login.php");
        }
    }
?>