<?php

include('userLogin.php');
include('db-connection.php');

$base64_string = $_POST['image'];
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

// * base path
$base_path = "C:\\xampp\\htdocs\\pweb-quis\\images\\".$username;

// * buat direktori
if (!file_exists($base_path)) {
    if (!mkdir($base_path)) {
        $response = [
            'status' => 500,
            'success' => false,
            'message' => 'Gagal membuat folder'
        ];
        echo json_encode($response);
        return;
    }
}

// * system iterator
$fi = new FilesystemIterator($base_path, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi) + 1;

// * get data from base64 string
$data = explode(',', $base64_string);

// * generate image name
$filename = "X__".$fileCount."_". date("YmdHis") .".png";
$fullName = $base_path . '\\' . $filename;

// * write data
$ifp = fopen($fullName, "wb");
fwrite($ifp, base64_decode($data[1]));
fclose($ifp);
if (!$ifp){
    $response = [
        'status' => 500,
        'success' => false,
        'image' => $filename,
        'message' => "Gagal disimpan"
    ];
    echo json_encode($response);
    return;
}

// * log ke database
$timestamp = time();
$tz = 'Asia/Jakarta';
$dt = new DateTime("now", new DateTimeZone($tz));
$dt->setTimestamp($timestamp);

$query_log = "
    INSERT INTO logs (nrp, image_path, timestamp) VALUE ('$username', '$filename', '" . $dt->format("Y-m-d H:i:s") . "'); 
";
$con = open_connection();

if (!$con->query($query_log)) {
    close_connection($con);
    $response = [
        'status' => 500,
        'success' => false,
        'message' => 'Gagal insert ke database'
    ];
    echo json_encode($response);
    return;
}else{
    close_connection($con);
}

// * success response 
$fi = new FilesystemIterator($base_path, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);
$response = [
    'status' => 200,
    'success' => true,
    'message' => 'Berhasil menyimpan',
    'image' => $filename,
    'total' => $fileCount
];

echo json_encode($response);
return;

?>