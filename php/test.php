<?php
include('database.php');
$obj=new query();
// $conditionArr=array('name'=>'Smith','email'=>'sumit@mail.com','mobile'=>'123');
// $valuesArr=array('name'=>'Smith','email'=>'sumit@mail.com','mobile'=>'123');
// $result=$obj->getdata('user','*',$conditionArr,'id','desc','');
$valuesArr=array('username'=>'$username','password'=>'$password');

$result=$obj->insertdata('login',$valuesArr);
// $result=$obj->getdata('login','*',$conditionArr,'id','desc','');
//  $result=$obj->deletedata('login',$conditionArr);
// $result=$obj->updatedata('login',$conditionArr,'id',2);
// echo '<pre>';
// print_r($result);
?>