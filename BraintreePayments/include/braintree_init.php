<?php
session_start();
require_once("vendor/autoload.php");
if(file_exists(__DIR__ . "/../.env")) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
    $dotenv->load();
}
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('mk4fx7txgf36wxv6');
Braintree_Configuration::publicKey('5gmb7fqwhjqj3qy2');
Braintree_Configuration::privateKey('8ba0712de4b98ef2a57b9c422740ab20');
?>
