<?php

function checkLogin($nrp, $password)
{
    $con = open_connection();

    $query_login = "
        SELECT * FROM users WHERE nrp='$nrp' AND password = '" . md5($password) . "';
    ";

    $data = $con->query($query_login);

    if ($data->num_rows) {
        return true;
    }else{
        return false;
    }
}

?>