<?php
    namespace Models;
    class JobOffer{
        private $jobOfferId;
        private $jobPositionId;
        private $companyId;
        private $description;
        private $publicationDate;
        private $expirationDate;
        
        public function getJobOfferId()
        {
                return $this->jobOfferId;
        }

        public function setJobOfferId($jobOfferId)
        {
                $this->jobOfferId = $jobOfferId;

                return $this;
        }

        public function getJobPositionId()
        {
                return $this->jobPositionId;
        }

        public function setJobPositionId($jobPositionId)
        {
                $this->jobPositionId = $jobPositionId;

                return $this;
        }

        public function getCompanyId()
        {
                return $this->companyId;
        }

        public function setCompanyId($companyId)
        {
                $this->companyId = $companyId;

                return $this;
        }

        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public function getPublicationDate()
        {
                return $this->publicationDate;
        }

        public function setPublicationDate($publicationDate)
        {
                $this->publicationDate = $publicationDate;

                return $this;
        }

        public function getExpirationDate()
        {
                return $this->expirationDate;
        }

        public function setExpirationDate($expirationDate)
        {
                $this->expirationDate = $expirationDate;

                return $this;
        }
    }

?>