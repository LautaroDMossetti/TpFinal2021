<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Company as Company;
    use DAO\IDAO as IDAO;
    

    class CompanyDAO implements IDAO{
        
        private $companyList;
        public function getAll()
        {
            $this->retriveData();
            return $this->companyList;
        }
        public function retriveData(){
            $this->companyList=array();
            if(file_exists("Data/CompanyList.json")){
                $jsonContent=file_get_contents("Data/CompanyList.json");
                $ArrayToDecode=($jsonContent)?json_decode($jsonContent,true):array();
                foreach($ArrayToDecode as $row){
                    $company=new Company();
                    $company->setCompanyLink($row["companyLink"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescripcion($row["descripcion"]);
                    $company->setEstado($row["estado"]);
                    $company->setId($row["id"]);
                    $company->setNombre($row["nombre"]);
                    array_push($this->companyList,$company);

                }
            }
        }
        public function getOne($name){
            
            $result=array();
            $this->retriveData();
            foreach($this->companyList as $row){
                if($row["nombre"]==$name){
                    $company=new Company();
                    $company->setCompanyLink($row["companyLink"]);
                    $company->setCuit($row["cuit"]);
                    $company->setDescripcion($row["descripcion"]);
                    $company->setEstado($row["estado"]);
                    $company->setId($row["id"]);
                    $company->setNombre($row["nombre"]);
                    array_push($result,$company);   
                }
            }
            return $result;
        }
            
        public function saveData(){
            $arrayToEncode=array();
            foreach($this->companyList as $company){
                $valuesArray["companyLink"]=$company->getCompanyLink();
                $valuesArray["cuit"]=$company->getCuit();
                $valuesArray["estado"]=$company->getEstado();
                $valuesArray["id"]=$company->getId();
                $valuesArray["descripcion"]=$company->getDescripcion();
                $valuesArray["nombre"]=$company->getNombre();
                array_push($arrayToEncode,$valuesArray);
            }
            $jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents("Data/CompanyList.json",$jsonContent);
        }
        public function modify($Id,$empresa){//Fue la unica forma que se me ocurrio para la modificacion, seguramente este mal
            $this->retriveData();//Pide el id de la empresa, y la nueva empresa, con el primero se busca y con el segundo se modifica
            $aux=array();//
            foreach($this->companyList as $company){
                if($company->getId()==$Id){
                    $valuesArray["companyLink"]=$empresa->getCompanyLink();
                    $valuesArray["cuit"]=$empresa->getCuit();
                    $valuesArray["estado"]=$empresa->getEstado();
                    $valuesArray["id"]=$empresa->getId();
                    $valuesArray["descripcion"]=$empresa->getDescripcion();
                    $valuesArray["nombre"]=$empresa->getNombre();
                }
                else{
                    $valuesArray=$company;
                }
                array_push($aux,$valuesArray);
            }
            $jsonContent=json_encode($aux,JSON_PRETTY_PRINT);
            file_put_contents("Data/CompanyList.json",$jsonContent);
        }
        public function add($Empresa)
        {
            $this->retriveData();
            array_push($this->companyList,$Empresa);
            $this->saveData();
        }
    }

?>