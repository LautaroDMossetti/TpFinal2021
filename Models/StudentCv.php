<?php
    namespace Models;

    class StudentCv{
        private $studentCvId;
        private $studentId;
        private $cv;

        public function getStudentCvId()
        {
                return $this->studentCvId;
        }

        public function setStudentCvId($studentCvId)
        {
                $this->studentCvId = $studentCvId;

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

        public function getCv()
        {
                return $this->cv;
        }

        public function setCv($cv)
        {
                $this->cv = $cv;

                return $this;
        }
    }

?>