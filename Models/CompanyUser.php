<?php
    namespace Models;

    class CompanyUser extends User{
        private $companyUserId;
        private $companyId;

        public function getCompanyId()
        {
                return $this->companyId;
        }

        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;

                return $this;
        }

        public function getCompanyUserId()
        {
                return $this->companyUserId;
        }

        public function setCompanyUserId($companyUserId)
        {
                $this->companyUserId = $companyUserId;

                return $this;
        }
    }
?>