<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\CompanyUser as CompanyUser;
    use DAO\IDAO as IDAO;
    use DAO\Connection as Connection;
    

    class CompanyUserDAO implements IDAO{
        
        private $connection;
        private $tableName = "companyUsers";

        public function add($newCompanyUser){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (companyId, email, password) VALUES (:companyId, :email, :password);";
                
                $parameters["companyId"] = $newCompanyUser->getCompanyId();
                $parameters["email"] = $newCompanyUser->getEmail();
                $parameters["password"] = $newCompanyUser->getPassword();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByEmail($email){
            try{
                $companyUsersList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE email LIKE :email;";

                $parameters['email'] = '%'.$email.'%';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row)
                {                
                    $companyUser = new CompanyUser();

                    $companyUser->setCompanyUserId($row["companyUserId"]);
                    $companyUser->setCompanyId($row["companyId"]);
                    $companyUser->setEmail($row["email"]);
                    $companyUser->setPassword($row["password"]);

                    array_push($companyUsersList, $companyUser);
                }

                return $companyUsersList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll(){
            try
            {
                $companyUsersList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $companyUser = new CompanyUser();

                    $companyUser->setCompanyUserId($row["companyUserId"]);
                    $companyUser->setCompanyId($row["companyId"]);
                    $companyUser->setEmail($row["email"]);
                    $companyUser->setPassword($row["password"]);

                    array_push($companyUsersList, $companyUser);
                }

                return $companyUsersList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($id){
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE companyUserId=:companyUserId;";

                $parameters['companyUserId'] = $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify($modifiedCompanyUser){
            try
            {
                $query = "UPDATE ".$this->tableName." SET companyId = :companyId, email = :email, password = :password WHERE companyUserId=:companyUserId;";

                $parameters['companyUserId'] = $modifiedCompanyUser->getCompanyUserId();
                $parameters['companyId'] = $modifiedCompanyUser->getCompanyId();
                $parameters['email'] = $modifiedCompanyUser->getEmail();
                $parameters['password'] = $modifiedCompanyUser->getPassword();

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
                $query = "SELECT * FROM ".$this->tableName." WHERE companyUserId=:companyUserId;";

                $parameters['companyUserId'] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $companyUser = new CompanyUser();

                if($resultSet != null){
                    $companyUser->setCompanyUserId($resultSet[0]["companyUserId"]);
                    $companyUser->setCompanyId($resultSet[0]["companyId"]);
                    $companyUser->setEmail($resultSet[0]["email"]);
                    $companyUser->setPassword($resultSet[0]["password"]);
                }

                return $companyUser;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOnebyCompanyId($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE companyId=:companyId;";
    
                $parameters['companyId'] = $id;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query, $parameters);
    
                $companyUser = new CompanyUser();
    
                if($resultSet != null){
                    $companyUser->setCompanyUserId($resultSet[0]["companyUserId"]);
                    $companyUser->setCompanyId($resultSet[0]["companyId"]);
                    $companyUser->setEmail($resultSet[0]["email"]);
                    $companyUser->setPassword($resultSet[0]["password"]);
                }
    
                return $companyUser;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }

?>