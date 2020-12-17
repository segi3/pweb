<?php

include('db-connection.php');

$con = open_connection();

$table_user = "
    CREATE TABLE users (
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nrp VARCHAR(32) NOT NULL,
        password VARCHAR(50) NOT NULL
    )
";

if ($con->query($table_user)) {
    echo "tabel user berhasil dibuat"; echo '<br>';echo '<br>';
}else{
    echo "tabel user gagal dibuat"; echo '<br>';echo '<br>';
}

$dummy_nrp = '05111840000094';
$dummy_password = md5('12345678');

$query_insert = "
    INSERT INTO users (nrp, password) VALUE ('$dummy_nrp', '$dummy_password');
";

if ($con->query($query_insert)) {
    echo 'berhasil input dummy'; echo '<br>';echo '<br>';
}else{
    echo 'gagal input dummy'; echo '<br>';echo '<br>';
}

$tabel_logs = "
    CREATE TABLE logs (
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nrp VARCHAR(32) NOT NULL,
        image_path VARCHAR(64) NOT NULL,
        timestamp TIMESTAMP
    )
";

if ($con->query($tabel_logs)) {
    echo "tabel logs berhasil dibuat"; echo '<br>';echo '<br>';
}else{
    echo "tabel logs gagal dibuat"; echo '<br>';echo '<br>';
}

close_connection($con);

?>