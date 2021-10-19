<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."login.php");
            
            ?>

            <h5 style="text-align: center; color: red"><?php echo $message; ?></h5>
            
            <?php
        }
    }
?>