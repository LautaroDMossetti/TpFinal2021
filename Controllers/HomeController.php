<?php
    namespace Controllers;

    use Controllers\APIController as APIController;

    class HomeController
    {
        public function Index($message = "")
        {
            

            require_once(VIEWS_PATH."login.php");
        }
    }
?>