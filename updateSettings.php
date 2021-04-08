<?php
require_once "Database.php";

$conn = (new Database())->getConnection();

if (isset($_POST["parameter"])){
    $parameter = floatval($_POST["parameter"]);
    $y1Check = 0;
    $y2Check = 0;
    $y3Check = 0;
    if (isset($_POST["y1Check"])) {
        $y1Check = intval($_POST["y1Check"]);
    }
    if (isset($_POST["y2Check"])){
        $y2Check = intval($_POST["y2Check"]);
    }
    if (isset($_POST["y3Check"])){
        $y3Check = intval($_POST["y3Check"]);
    }

    $stmt = $conn->query("UPDATE `parameter` SET `parameter_a`=".$parameter.",`y1`=".$y1Check.",`y2`=".$y2Check.",`y3`=".$y3Check." ;");

    echo "success";
    header('Location:index.php');
}else{
    echo "error";
}