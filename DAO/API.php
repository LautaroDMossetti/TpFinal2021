<?php
    namespace DAO;

    class API{

        public function getAllStudents(){

            //Conection with the API
            $ch = curl_init();

            $url = "https://utn-students-api.herokuapp.com/api/Student";

            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            
            $response = curl_exec($ch);

            $arrayToDecode = json_decode($response, true);

            return $arrayToDecode;
        }

        public function getAllCareers(){

            //Conection with the API
            $ch = curl_init();

            $url = "https://utn-students-api.herokuapp.com/api/Career";

            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            
            $response = curl_exec($ch);

            $arrayToDecode = json_decode($response, true);

            return $arrayToDecode;
        }

        public function getAllJobPositions(){

            //Conection with the API
            $ch = curl_init();

            $url = "https://utn-students-api.herokuapp.com/api/JobPosition";

            $header = array(
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            
            $response = curl_exec($ch);

            $arrayToDecode = json_decode($response, true);

            return $arrayToDecode;
        }
    }
?>