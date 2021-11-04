<?php
    namespace DAO;

    use DAO\Connection as Connection;

    interface IDAO
    {
        function Add($Data);//Se usa la interfaz dao asi, por lo hablado en metodologia comision 4
        function GetAll();
        function Remove($id);
    }
?>