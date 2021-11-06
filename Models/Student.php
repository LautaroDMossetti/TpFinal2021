<?php
    namespace Models;

    use Models\User as User;

    class Student extends User{
        private $studentId;
        private $careerId;
        private $firstName;
        private $lastName;
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $phoneNumber;
        private $active;
 
        public function getStudentId()
        {
                return $this->studentId;
        }

        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

                return $this;
        }

        public function getCareerId()
        {
                return $this->careerId;
        }

        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;

                return $this;
        }

        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        public function getLastName()
        {
                return $this->lastName;
        }

        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        public function getFileNumber()
        {
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;

                return $this;
        }
 
        public function getGender()
        {
                return $this->gender;
        }

        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        public function getBirthDate()
        {
                return $this->birthDate;
        }
 
        public function setBirthDate($birthDate)
        {
                $this->birthDate = $birthDate;

                return $this;
        }

        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        public function getActive()
        {
                return $this->active;
        }

        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }

        public function toString(){
                return "studentId = " . $this->getStudentId() . ", careerId = " . $this->getCareerId() . ", firstName = " . $this->getFirstName() . ", lastName = " . $this->getLastName() . ", dni = " . $this->getDni() . ", fileNumber = " . $this->getFileNumber() . ", gender = " . $this->getGender() . ", birthDate = " . $this->getBirthDate() . ", email = " . $this->getEmail() . ", password = " . $this->getPassword() . ", phoneNumber = " . $this->getPhoneNumber() . ", active = " . $this->getActive();
        }

        public function toStringWithoutPassword(){
                return "studentId = " . $this->getStudentId() . ", careerId = " . $this->getCareerId() . ", firstName = " . $this->getFirstName() . ", lastName = " . $this->getLastName() . ", dni = " . $this->getDni() . ", fileNumber = " . $this->getFileNumber() . ", gender = " . $this->getGender() . ", birthDate = " . $this->getBirthDate() . ", email = " . $this->getEmail() . ", phoneNumber = " . $this->getPhoneNumber() . ", active = " . $this->getActive();
        }
    }
?>