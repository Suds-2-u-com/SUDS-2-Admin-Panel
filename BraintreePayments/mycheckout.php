<?php
require_once ("include/braintree_init.php");
require_once 'vendor/braintree/braintree_php/lib/Braintree.php';

$nonce = $_POST['nonce'];
$amount = $_POST['amount'];
$result = Braintree_Transaction::sale([
  'amount' => $amount,
  'paymentMethodNonce' => $nonce,
  'options' => [
    'submitForSettlement' => True
  ]
]);
if($result->success== true){
echo json_encode(array('success'=>$result->success,'transaction_id'=>$result->transaction->id,'message'=>'Payment done successfully'));
  //print_r($result->transaction->id);
 
}else{
    echo json_encode(array('success'=>$result->success,'message'=>'Something went wrong','msg'=>$result->errors));
    //print_r($result->errors);die();
}

?>