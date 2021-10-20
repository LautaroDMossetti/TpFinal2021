<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Company as Company;
    use DAO\IDAO as IDAO;
    

    class CompanyDAO implements IDAO{
        
        private $companyList = array();

        public function getAll()
        {
            $this->retriveData();
            return $this->companyList;
        }

        public function retriveData(){
            $this->companyList = array();

            if(file_exists((dirname(__DIR__) . "/Data/CompanyList.json"))){
                $jsonContent = file_get_contents((dirname(__DIR__) . "/Data/CompanyList.json"));

                $ArrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
                
                foreach($ArrayToDecode as $row){
                    $company=new Company();

                    $company->setId($row["id"]);
                    $company->setNombre($row["nombre"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescripcion($row["descripcion"]);
                    $company->setEstado($row["estado"]);

                    array_push($this->companyList,$company);

                }
            }
        }

        public function filterByName($nombre){
            $this->retriveData();

            $s2 = $nombre;
            $s2 = strtolower($s2);

            $filteredList = array();

            foreach($this->companyList as $company){

                $s1 = $company->getNombre();

                $s1 = strtolower($s1);

                if(str_contains($s1,$s2)){
                    array_push($filteredList,$company);
                }
            }

            return $filteredList;
        }

        public function getOne($id){
            $this->retriveData();
            
            foreach($this->companyList as $row){
                if($row->getId() == $id){

                    $company=new Company();

                    $company = $row;

                    return $company;
                }
            }

            return false;
        }
            
        public function saveData(){
            $arrayToEncode=array();

            foreach($this->companyList as $company){
                $valuesArray["id"]=$company->getId();
                $valuesArray["nombre"]=$company->getNombre();
                $valuesArray["companyLink"]=$company->getCompanyLink();
                $valuesArray["cuit"]=$company->getCuit();
                $valuesArray["estado"]=$company->getEstado();
                $valuesArray["descripcion"]=$company->getDescripcion();
                array_push($arrayToEncode,$valuesArray);
            }

            $jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            
            file_put_contents((dirname(__DIR__) . "/Data/CompanyList.json"),$jsonContent);

        }

        public function modify($modifiedCompany){
         
            $this->retriveData();

            $arrayToEncode = array();
            
            foreach($this->companyList as $company){
                
                if($company->getId() == $modifiedCompany->getId()){
                    $valuesArray["id"] = $modifiedCompany->getId();
                    $valuesArray["nombre"] = $modifiedCompany->getNombre();
                    $valuesArray["companyLink"] = $modifiedCompany->getCompanyLink();
                    $valuesArray["cuit"] = $modifiedCompany->getCuit();
                    $valuesArray["estado"] = $modifiedCompany->getEstado();
                    $valuesArray["descripcion"] = $modifiedCompany->getDescripcion();
                    array_push($arrayToEncode, $valuesArray);
                }else{
                    $valuesArray["id"]=$company->getId();
                    $valuesArray["nombre"]=$company->getNombre();
                    $valuesArray["companyLink"]=$company->getCompanyLink();
                    $valuesArray["cuit"]=$company->getCuit();
                    $valuesArray["estado"]=$company->getEstado();
                    $valuesArray["descripcion"]=$company->getDescripcion();
                    array_push($arrayToEncode,$valuesArray);
                }
            }
            
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents((dirname(__DIR__) . "/Data/CompanyList.json"),$jsonContent);
        }

        public function add($Empresa)
        {

            $this->retriveData();
            array_push($this->companyList,$Empresa);
            $this->saveData();

        }

        public function remove($id){

            $this->retriveData();

            if($id != null){

                $newList = array();

                foreach ($this->companyList as $company){
                    if($company->getId() != $id){
                        array_push($newList, $company);
                    }
                }

                $this->companyList = $newList;
                $this->saveData();
            }
        }
    }

?>