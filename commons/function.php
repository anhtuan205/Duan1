<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
function uploadFile($file,$folderUpload){
    $spathStorage = $folderUpload . time() . $file['name'];
    $from = $file['tmp_name'];
    $to=PATH_ROOT . $spathStorage;
    if (move_uploaded_file($from,$to)){
        return $spathStorage;


    }
    return null;

}
function deleteFile($file){
    $spathDelete = PATH_ROOT . $file;
    if(file_exists($spathDelete)){
        unlink($spathDelete);
    }
}
function deleteSessionError() {
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        session_unset();
        session_destroy();
    }

}
function uploadFileAlbum($file,$folderUpload, $key){
    $spathStorage = $folderUpload . time() . $file['name'][$key];
    $from = $file['tmp_name'][$key];
    $to=PATH_ROOT . $spathStorage;
    if (move_uploaded_file($from,$to)){
        return $spathStorage;


    }
    return null;

}

// format date
function formatDate($date)
{
    return date("d-y-M", strtotime($date));
}
