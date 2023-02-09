<?php

require("models/libs/encriptar.php");

class Model
{

    function __construct()
    {
        $this->security = new Security();
        $this->db = new Database();
    }
}
