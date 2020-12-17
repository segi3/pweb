<?php

include('userLogin.php');
include('db-connection.php');

$username = $_POST['idUser'];
$password = $_POST["password"];

// * login middleware
if(!checkLogin($username, $password)){
    $response = [
        'status' => 401,
        'success' => false,
        'message' => 'Gagal login'
    ];

    echo json_encode($response);
    return false;
}

// * query log
$query_log = "
    SELECT * FROM logs WHERE nrp='$username';
";
$con = open_connection();

try {
    $data = $con->query($query_log);
}catch (Exception $e){
    $response = [
        'status' => 500,
        'success' => false,
        'message' => $con->error
    ];
    echo json_encode($response);
    return;
}

close_connection($con);

$results = [
    'status' => 200,
    'success' => true,
];

if ($data->num_rows > 0){
    while ($row = $data->fetch_assoc()) {
        array_push($results, $row);
    }
}

echo json_encode($results);
return;
?>