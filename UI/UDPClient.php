<?php
error_reporting(~E_WARNING);

$server = '192.168.1.101';
$port = 8080;

if (!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))){
  $errorcode = socket_last_error();
  $errormsg = socket_strerror($errorcode);

  die("Couldn't create socket : [ $errorcode ] $errormsg \n");
}

if (empty($_POST['name'])) {
		$errors['name'] = 'Name cannot be blank';
}

if (!empty($errors)) {
	$form_data['errors']  = $errors;
} else {
	$form_data['cmd'] = $_POST['name'];
}

$input = $form_data['cmd'];

if (!socket_sendto($sock, $input, strlen($input), 0, $server, $port)){
  $errorcode = socket_last_error();
  $errormsg = socket_strerror($errorcode);

  die ("Could not send data: $errorcode] $errormsg \n");
} else {
  echo ">> Sent\n";
}

close($sock);
