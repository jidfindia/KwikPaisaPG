<?php 
$midorderid=$_POST['midorderid'];
$txn_amount=$_POST['txn_amount'];
$txn_id=$_POST['txn_id'];
$txn_currency=$_POST['txn_currency'];
$mode=$_POST['mode'];
$txn_status=$_POST['txn_status'];
$txn_time=$_POST['txn_time'];
$txn_mid=$_POST['txn_mid'];
?>
<html>
<b>Txn - <?php echo $txn_status ;?></b><br><br>
Order ID = <?php echo $midorderid;?> <br>
Txn Amount = <?php echo $txn_amount;?><br>
Txn ID = <?php echo $txn_id;?><br>
Txn Currency = <?php echo $txn_currency ;?><br>
Payment By = <?php echo $mode ;?><br>
Txn Status = <?php echo $txn_status ;?><br>
Txn Time = <?php echo $txn_time ;?>
</html>
