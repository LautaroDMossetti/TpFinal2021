<?php
    namespace DAO;

    use DAO\Connection as Connection;

    interface IDAO
    {
        function Add($Data);//Se usa la interfaz dao asi, por lo hablado en metodologia comicion 4
        function GetAll();
    }
?>