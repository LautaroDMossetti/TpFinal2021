<?php
    namespace Models;

    use Models\User as User;

    class Admin extends User{
        private $adminId;

        public function getAdminId()
        {
                return $this->adminId;
        }

        public function setAdminId($adminId)
        {
                $this->adminId = $adminId;

                return $this;
        }
    }


?>