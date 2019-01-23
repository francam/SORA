<?php

$socket  = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

function connect(){

  $host    = "localhost";
  $port    = 8080;
  global $socket;

  $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
  $connected = 1;

  write($socket, "hello!\n");

  $out = read($socket);
}

function disconnect(){
  global $socket;
  write($socket, "disconnecting\n");
  socket_close($socket);
}

function write($sock, $msg){
  socket_write($sock, $msg, strlen($msg)) or die("Could not send data to server\n");
}

function read($sock){
  $output = socket_read($socket, 1024) or die ("Could not read server response\n");
  return $output;
}

// reads the value of the button pressed and acts on it. Disconnect should be here, but it also doesn't really work.
if (isset($_POST['action'])) {
  switch ($_POST['action']) {
    case 'connect':
      connect();
      break;
    case 'disconnect':
      disconnect();
      break;
  }
}
