<?php
$user_code = (isset($_GET['user_code'])) ? $_GET['user_code'] : '';
$amt = (isset($_GET['amount'])) ? $_GET['amount'] : 0;
$dbcon = mysqli_connect('localhost','test','test@123','test') or die('Dieeeeeeeeeeeeeeeee');
function getBalance($ucode)
{
	global $dbcon;
	
	$sql = "SELECT balance FROM bank_accounts where ucode = '{$ucode}'";
	$r = mysqli_query($dbcon, $sql);
	if($r !== NULL && $r->num_rows === 1)
	{
		$d = mysqli_fetch_assoc($r);
		return $d['balance'];
	}
	return NULL;
}
function setBalance($ucode, $v)
{
	global $dbcon;
	
	$sql = "UPDATE bank_accounts SET balance = {$v} where ucode = '{$ucode}'";
	$r = mysqli_query($dbcon, $sql);
	return $r;
}

function withdraw($amount, $ucode)
{
   $balance = getBalance($ucode);
   if($amount <= $balance)
   {
       $balance = $balance - $amount;
       setBalance($ucode, $balance);
   }
   else
   {
       echo "Insufficient funds.";
   }
}
echo "Your balance before withdraw \${$amt} is $" .  getBalance($user_code) . "<br/>\n";
withdraw($amt, $user_code);
echo "Your balance after withdraw \${$amt} is $" .  getBalance($user_code) . "<br/>\n";
mysqli_close($dbcon);
?>
