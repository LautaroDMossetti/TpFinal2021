<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IDAO as IDAO;
    use Models\Student as Student;    
    use DAO\Connection as Connection;


    class StudentDAO implements IDAO
    {
        private $connection;
        private $tableName = "students";

        public function getAll()
        {
            try
            {
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE active = :active;";

                $parameters['active'] = true;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $student = new Student();

                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);
                    

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAllIgnoreActive()
        {
            try
            {
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $student = new Student();

                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);
                    

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByLastName($lastName){
            try{
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE active = :active AND lastName LIKE :lastName;";

                $parameters['active'] = true;
                $parameters['lastName'] = '%'.$lastName.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $student = new Student();

                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByName($nombre){
            try{
                $studentList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE active = :active AND firstName LIKE :firstName;";

                $parameters['active'] = true;
                $parameters['firstName'] = '%'.$nombre.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $student = new Student();

                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Funcion para actualizar la base de datos comparando con la API, pero sin agregar nuevos estudiantes a la base de datos, solo modificando los existentes.
        public function updateDatabaseNoAdd($APIData){
            try{
                $studentList = $this->getAllIgnoreActive();

                foreach($studentList as $student){
                    $i = 0;

                    while($i != count($APIData) && $APIData[$i]['dni'] != $student->getDni()){
                        $i++;
                    }

                    if($i != count($APIData) && $APIData[$i]['dni'] == $student->getDni()){
                        $APIStudent = new Student();

                        $APIStudent->setCareerId($APIData[$i]["careerId"]);
                        $APIStudent->setFirstName($APIData[$i]["firstName"]);
                        $APIStudent->setLastName($APIData[$i]["lastName"]);
                        $APIStudent->setDni($APIData[$i]["dni"]);
                        $APIStudent->setFileNumber($APIData[$i]["fileNumber"]);
                        $APIStudent->setGender($APIData[$i]["gender"]);
                        $APIStudent->setBirthDate($APIData[$i]["birthDate"]);
                        $APIStudent->setEmail($APIData[$i]["email"]);
                        $APIStudent->setPhoneNumber($APIData[$i]["phoneNumber"]);

                        if($APIData[$i]["active"]){
                            $APIStudent->setActive(1);
                        }else{
                            $APIStudent->setActive(0);
                        }

                        if(strcmp($student->toStringNoPassword(),$APIStudent->toStringNoPassword()) != 0){
                            $APIStudent->setStudentId($student->getStudentId());
                            $this->modifyNoPassword($APIStudent);
                        }
                    }
                }
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modifyNoPassword($modifiedStudent){
            try
            {
                $query = "UPDATE ".$this->tableName." SET careerId = :careerId, firstName = :firstName, lastName = :lastName, dni = :dni, fileNumber = :fileNumber, gender = :gender, birthDate = :birthDate, email = :email, phoneNumber = :phoneNumber, active = :active WHERE studentId=:studentId;";

                $parameters['studentId'] = $modifiedStudent->getStudentId();
                $parameters['careerId'] = $modifiedStudent->getCareerId();
                $parameters['firstName'] = $modifiedStudent->getFirstName();
                $parameters['lastName'] = $modifiedStudent->getLastName();
                $parameters['dni'] = $modifiedStudent->getDni();
                $parameters['fileNumber'] = $modifiedStudent->getFileNumber();
                $parameters['gender'] = $modifiedStudent->getGender();
                $parameters['birthDate'] = $modifiedStudent->getBirthDate();
                $parameters['email'] = $modifiedStudent->getEmail();
                $parameters['phoneNumber'] = $modifiedStudent->getPhoneNumber();
                $parameters['active'] = $modifiedStudent->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE studentId=:studentId AND active = :active;";

                $parameters['active'] = true;
                $parameters['studentId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $student = new Student();

                if($resultSet != null){
                    $student->setStudentId($resultSet[0]["studentId"]);
                    $student->setCareerId($resultSet[0]["careerId"]);
                    $student->setFirstName($resultSet[0]["firstName"]);
                    $student->setLastName($resultSet[0]["lastName"]);
                    $student->setDni($resultSet[0]["dni"]);
                    $student->setFileNumber($resultSet[0]["fileNumber"]);
                    $student->setGender($resultSet[0]["gender"]);
                    $student->setBirthDate($resultSet[0]["birthDate"]);
                    $student->setEmail($resultSet[0]["email"]);
                    $student->setPassword($resultSet[0]["password"]);
                    $student->setPhoneNumber($resultSet[0]["phoneNumber"]);
                    $student->setActive($resultSet[0]["active"]);
                }

                if($student->getStudentId() != null){
                    return $student;
                }else{
                    return false;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modifyPassword($studentId, $newPassword){
            try
            {
                $query = "UPDATE ".$this->tableName." SET password = :password WHERE studentId=:studentId;";

                $parameters['studentId'] = $studentId;
                $parameters['password'] = $newPassword;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify($modifiedStudent){
            try
            {
                $query = "UPDATE ".$this->tableName." SET careerId = :careerId, firstName = :firstName, lastName = :lastName, dni = :dni, fileNumber = :fileNumber, gender = :gender, birthDate = :birthDate, email = :email, password = :password, phoneNumber = :phoneNumber, active = :active WHERE studentId=:studentId;";

                $parameters['studentId'] = $modifiedStudent->getStudentId();
                $parameters['careerId'] = $modifiedStudent->getCareerId();
                $parameters['firstName'] = $modifiedStudent->getFirstName();
                $parameters['lastName'] = $modifiedStudent->getLastName();
                $parameters['dni'] = $modifiedStudent->getDni();
                $parameters['fileNumber'] = $modifiedStudent->getFileNumber();
                $parameters['gender'] = $modifiedStudent->getGender();
                $parameters['birthDate'] = $modifiedStudent->getBirthDate();
                $parameters['email'] = $modifiedStudent->getEmail();
                $parameters['password'] = $modifiedStudent->getPassword();
                $parameters['phoneNumber'] = $modifiedStudent->getPhoneNumber();
                $parameters['active'] = $modifiedStudent->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function add($student)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, password, phoneNumber, active) VALUES (:careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :password, :phoneNumber, :active);";
                
                $parameters['careerId'] = $student->getCareerId();
                $parameters['firstName'] = $student->getFirstName();
                $parameters['lastName'] = $student->getLastName();
                $parameters['dni'] = $student->getDni();
                $parameters['fileNumber'] = $student->getFileNumber();
                $parameters['gender'] = $student->getGender();
                $parameters['birthDate'] = $student->getBirthDate();
                $parameters['email'] = $student->getEmail();
                $parameters['password'] = $student->getPassword();
                $parameters['phoneNumber'] = $student->getPhoneNumber();
                $parameters['active'] = $student->getActive();


                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE studentId=:studentId;";

                $parameters['studentId'] = $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
        public function recieveFromAPI($APIData){       
            try{

                foreach($APIData as $row){
                    $student = new Student();

                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["dni"] . '00');
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);

                    $this->add($student);
                }

            }catch(Exception $ex){
                throw $ex;
            }
        }
        */
    }
?>