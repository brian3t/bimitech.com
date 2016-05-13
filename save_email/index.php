<?php

$email = isset($_REQUEST['email'])?$_REQUEST['email']:null;

if (empty($email)){
    echo json_encode(["status" => "failed"]);
    exit(-1);
}

$db= mysqli_connect('localhost', 'bimitech', 'KXH6P.rc3J+.;E8P', 'bimitech');
$db->query("INSERT INTO `subscriptions` (`email`) VALUES('$email')");
if ($db->affected_rows == 1 || empty($db->error)){
    echo json_encode(["status" => "success"]); exit(1);
}