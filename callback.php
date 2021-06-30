<?php
use myPHPnotes\Microsoft\Auth; 
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;
session_start();

require_once('vendor/autoload.php');
if (!isset($_REQUEST['code'])) {
	$tenant 		= "common";
	$client_id 		= "4931ccb4-1d30-424c-9c3d-1ec4064220d4";
	$client_secret 	= "IZOn98_F0VtC3e-o28Vw8i~-oy6I~FtOfJ";
	$callback 		= "http://localhost/salesfloAssignment/sign_in_with_microsoft/callback.php";
	$scope  		= ['User.Read'];
	$microsoft_api 	= new Auth($tenant, $client_id, $client_secret, $callback, $scope);
	header("location: ".$microsoft_api->getAuthUrl());
}
if (isset($_REQUEST['code'])) {
$auth = new Auth(
		Session::get("tenant_id"),
		Session::get("client_id"),
		Session::get("client_secret"),
		Session::get("redirect_uri"),
		Session::get("scopes")
	);
$tokens =  $auth->getToken($_REQUEST['code']);
//var_dump($tokens);
$access_token = $tokens->access_token;
$auth->setAccessToken($access_token);
$user = new User;
//var_dump($user->data);
echo "Name : ".$user->data->getDisplayName()."</br>";

echo "Email : ".$user->data->getuserPrincipalName(); ?>
 ?>
<a href="logout.php">Logout</a>
<?php

}


?>