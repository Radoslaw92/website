<?php
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['brightness']) && isset($_POST['status']) && isset($_POST['Time_From']) && isset($_POST['Time_Until']) && isset($_POST['light'])) {
 // if (isset($_POST['brightness']) && isset($_POST['status'])) {

    $brightness = $_POST['brightness'];
    $status = $_POST['status'];
    $Time_From = $_POST['Time_From'];
    $Time_Until = $_POST['Time_Until'];
    $light = $_POST['light'];

 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    //$result = mysql_query("INSERT INTO Parts(Name, part_nr) VALUES('$Name', '$part_nr')");
    
    //insert into right columnt depending which light has been used.
    if($light == 'light1')
    {
    	$result = mysql_query("UPDATE brightness SET light_1 = '$brightness' WHERE ID = '1'"); 
    	$result = mysql_query("UPDATE status SET light_1 = '$status' WHERE ID = '1'");
    	$result = mysql_query("UPDATE time_from  SET light_1 = '$Time_From' WHERE ID = '1'");
    	$result = mysql_query("UPDATE time_until SET light_1 = '$Time_Until' WHERE ID = '1'");
    }
    
    else if($light == 'light2')
    {
    	$result = mysql_query("UPDATE brightness SET light_2 = '$brightness' WHERE ID = '1'");
    	$result = mysql_query("UPDATE status SET light_2 = '$status' WHERE ID = '1'");
    	$result = mysql_query("UPDATE time_from  SET light_2 = '$Time_From' WHERE ID = '1'");
    	$result = mysql_query("UPDATE time_until SET light_2 = '$Time_Until' WHERE ID = '1'");
    }
    
    else if($light == 'light3')
    {
        $result = mysql_query("UPDATE brightness SET light_3 = '$brightness' WHERE ID = '1'");
        $result = mysql_query("UPDATE status SET light_3 = '$status' WHERE ID = '1'");
        $result = mysql_query("UPDATE time_from  SET light_3 = '$Time_From' WHERE ID = '1'");
        $result = mysql_query("UPDATE time_until SET light_3 = '$Time_Until' WHERE ID = '1'");
    }



    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Part successfully inserted.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
