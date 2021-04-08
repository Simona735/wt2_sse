<?php
require_once "Database.php";
$conn = (new Database())->getConnection();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');



$index = 0;

while (true){
    $stmt = $conn->query("SELECT * FROM `parameter`;");
    $setting = $stmt->fetch(PDO::FETCH_ASSOC);
    $parameter = $setting["parameter_a"];
    $y1Check = $setting["y1"];
    $y2Check = $setting["y2"];
    $y3Check = $setting["y3"];

    var_dump($parameter);
    $y1 = pow(sin($parameter * $index), 2);
    $y2 = pow(cos($parameter * $index), 2);
    $y3 = sin($parameter * $index) * cos($parameter * $index);

    $arr = array();

    if($y1Check){
        $arr["y1"] = $y1;
    }
    if($y2Check){
        $arr["y2"] = $y2;
    }
    if($y3Check){
        $arr["y3"] = $y3;
    }

    $msg = json_encode($arr);
    sendSSE(++$index, $msg);
    sleep(1);
}

function sendSSE($id, $msg){
    echo "id: $id\n";
    echo "event: data\n";
    echo "data: $msg\n\n";

    ob_flush();
    flush();

}