<?php
    namespace Controllers;

    use Controllers\APIController as APIController;

    class HomeController
    {
        public function Index($alert = "", $alert2 = "")
        {
            require_once(VIEWS_PATH."login.php");
        }
    }
?>