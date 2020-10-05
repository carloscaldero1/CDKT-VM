#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();

# if(isset($_POST['login'])){
#	$request['type'] = "login";
#}

# $request = array();
$request['type'] = "login";
$request['username'] = $_GET["username"];
$request['password'] = $_GET["password"];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

if($response == true){
	header("Location: ./authenticated.html");
	echo("Success<br>");
}
else{
	header("Location: ./authenticationFailed.html");
	echo("Failed<br>");
}

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
