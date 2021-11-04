<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Company as Company;
    use DAO\IDAO as IDAO;
    use DAO\Connection as Connection;
    

    class CompanyDAO implements IDAO{
        
        private $connection;
        private $tableName = "companies";

        public function getAll()
        {
            try
            {
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $company = new Company();

                    $company->setCompanyId($row["companyId"]);
                    $company->setNombre($row["nombre"]);
                    $company->setEstado($row["estado"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescripcion($row["descripcion"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function filterByName($nombre){
            try{
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE nombre LIKE '%". $nombre . "%';";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $company = new Company();

                    $company->setCompanyId($row["companyId"]);
                    $company->setNombre($row["nombre"]);
                    $company->setEstado($row["estado"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescripcion($row["descripcion"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getOne($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE companyId=". $id .";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $company = new Company();

                $company->setCompanyId($resultSet[0]["companyId"]);
                $company->setNombre($resultSet[0]["nombre"]);
                $company->setEstado($resultSet[0]["estado"]);
                $company->setCompanyLink($resultSet[0]["companyLink"]);
                $company->setCuit($resultSet[0]["cuit"]);
                $company->setDescripcion($resultSet[0]["descripcion"]);

                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function modify($modifiedCompany){
            try
            {
                $query = "UPDATE ".$this->tableName." SET nombre = '" . $modifiedCompany->getNombre() .
                "', estado = '" . $modifiedCompany->getEstado() ."', companyLink = '" . $modifiedCompany->getCompanyLink() .
                "', cuit = " . $modifiedCompany->getCuit() . ", descripcion = '" . $modifiedCompany->getDescripcion() .
                "' WHERE companyId=". $modifiedCompany->getCompanyId() . ";";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function add($Empresa)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (nombre, estado, companyLink, cuit, descripcion) VALUES (:nombre, :estado, :companyLink, :cuit, :descripcion);";
                
                $parameters["nombre"] = $Empresa->getNombre();
                $parameters["estado"] = $Empresa->getEstado();
                $parameters["companyLink"] = $Empresa->getCompanyLink();
                $parameters["cuit"] = $Empresa->getCuit();
                $parameters["descripcion"] = $Empresa->getDescripcion();

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
                $query = "DELETE FROM ".$this->tableName." WHERE companyId=". $id .";";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }

?>