<?php
    if(isset($_POST['brand-entered'])){
    $car_brand =$_POST['brand-entered'] ;
    $model = $_POST['model-entered'] ;
    $model_year = $_POST['model-year-entered']  ;
    $unique_id = $_POST['unique-id-entered']  ;
    };

    if(isset($_POST['unique-id-deleted'])){
        $delete_id = $_POST['unique-id-deleted'];
    };

    if(isset($_POST['unique-id-updated'])){
        $updated_brand = $_POST['brand-updated'];
        $updated_model = $_POST['model-updated'];
        $updated_year = $_POST['model-year-updated'];
        $updated_id = $_POST['unique-id-updated'];
    };


    DEFINE('DB_USER', 'caradmin');
    DEFINE('DB_PASSWORD', '12345678');

    $dsn = 'mysql:host=localhost;dbname=cars';

    try{
        $db = new PDO($dsn ,DB_USER ,DB_PASSWORD);
    }catch(PDOException $e){
        $err_msg = $e->getMessage();
        include('index.php');
        exit();
    }
?>


