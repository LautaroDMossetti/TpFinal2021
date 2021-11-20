<?php
    namespace Models;

    class JobOfferImage{
        private $jobOfferImageId;
        private $jobOfferId;
        private $image;

        public function getJobOfferImageId()
        {
                return $this->jobOfferImageId;
        }

        public function setJobOfferImageId($jobOfferImageId)
        {
                $this->jobOfferImageId = $jobOfferImageId;

                return $this;
        }

        public function getJobOfferId()
        {
                return $this->jobOfferId;
        }

        public function setJobOfferId($jobOfferId)
        {
                $this->jobOfferId = $jobOfferId;

                return $this;
        }

        public function getImage()
        {
                return $this->image;
        }

        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }
    }

?>