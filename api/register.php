<?php require_once '../inc/header.php';
$email = mysql_real_escape_string(trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)));
$submit = trim($_POST['generate']);
$item_price = '2';
$item_transaction = '1';

if(isset($submit) == 'generate' && !empty($email)) {
	$generate_key = rand(5000, 50000)."\$getmePr0xy.com".rand(100000, 150000)."k3y";
	$key = md5($generate_key);
	$check_duplicates = mysql_query("SELECT email FROM getmeproxy_payments WHERE email = '$email'");
	$dupliate_email = mysql_fetch_row($check_duplicates);
	if($dupliate_email[0] != $email) {
	$add_access = mysql_query("INSERT INTO getmeproxy_payments (`email`, `key`, `cash`, `transaction_id`) VALUES ('$email', '$key', '$item_price', '$item_transaction')");
	} else {
		$key = "<span class='label label-warning'>You have already registered!</span><p><h5>Please, <a href='mailto:admin@getmeproxy.com&subject=I have lost my API key&body=My email is: $email' target=_blank>email to administrator</a> for key retrieval.</h5></p>";
	}
}
?>
<div class="container">
	<div class="col-lg-12">
	<h1>Registration form for API access</h1>
		<form action="https://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"]; ?>" method="post">
		E-mail: <input type="text" name="email" value="" />
		<input type="submit" value="Get Key" name="generate" class="btn btn-default" />
		</form>
		<?php if(isset($submit) == 'generate' && !empty($email)) { echo "<h3>Your API key is: <b>".$key."</b></h3>"; } ?>
	</div>
</div>
<?php require_once '../inc/footer.php'; ?>