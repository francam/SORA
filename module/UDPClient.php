<?php
//$errors = array();
//$form_data = array();
error_reporting(~E_WARNING);

//$server = getHostByName(getHostName());
$server = '192.168.100.121';
//$server = '140.193.179.192';
$port = 8080;

if (!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))){
  $errorcode = socket_last_error();
  $errormsg = socket_strerror($errorcode);

  die("Couldn't create socket : [ $errorcode ] $errormsg \n");
}

echo "Host IP: $server Socket Created \n";

if (empty($_POST['name'])) {
		$errors['name'] = 'Name cannot be blank';
}

if (!empty($errors)) {
	$form_data['errors']  = $errors;
} else {
	$form_data['cmd'] = $_POST['name'];
}

$input = $form_data['cmd'];
//while (1){

  $input = fgets(STDIN);

  if (!socket_sendto($sock, $input, strlen($input), 0, $server, $port)){
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die ("Could not send data: $errorcode] $errormsg \n");
  } else {
    echo ">> Sent\n";
  }

  //unset($input);

  /*if (socket_recv($sock, $reply, 2045, MSG_WAITALL) === FALSE){
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die ("Could not receive data: $errorcode] $errormsg \n");
  }

  echo ">>: $reply";*/

//}
