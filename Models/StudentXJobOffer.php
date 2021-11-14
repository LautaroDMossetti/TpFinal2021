<?php
    namespace Models;

    class StudentXJobOffer{
        private $studentXJobOfferId;
        private $studentId;
        private $jobOfferId;

        public function getStudentXJobOfferId()
        {
                return $this->studentXJobOfferId;
        }

        public function setStudentXJobOfferId($studentXJobOfferId)
        {
                $this->studentXJobOfferId = $studentXJobOfferId;

                return $this;
        }

        public function getStudentId()
        {
                return $this->studentId;
        }

        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

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
    }
?>