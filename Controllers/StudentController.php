<?php
    namespace Controllers;

    use Models\User as User;

    class StudentController{
        public function viewInfo(){
            require_once("Student-view.php");
        }
    }
?>