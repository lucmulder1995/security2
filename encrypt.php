<?php
// This requires the libsodium PECL extension
require(__DIR__.'./functions.php');

if(isset($_POST['name']) && isset($_POST['geheim']) && isset($_POST['wachtwoord'] )){

	$name = $_POST['name'];
	$geheim = encrypt($_POST['geheim'], $_POST['wachtwoord']);

	$conn = new mysqli("vps.lucmulder.nl", "<username>", "<wachtwoord>", "sec2");

	if($conn->connect_errno != 0){
        die("Fout bij comminucatie met database");
    }
	$query = "INSERT INTO `info` (`naam`, `geheime_text`) VALUES ('$name', '".mysqli_real_escape_string($conn, htmlspecialchars($geheim))."')";
	$result = $conn->query($query);

	if($conn->query($query) === TRUE){
		// echo 'We are survivers <br>';
	}else{
		echo 'error while inserting values '.$conn->error;
	}
	$conn->close();

	echo 'Opgeslagen!';

}else{ ?>
<h2>Encrypt-R-us</h2>
<form method="POST" action="encrypt.php">
	<input type="text" name="name" placeholder="Naam"/><br>
	<label>Geheime text: </label><br>
	<textarea name="geheim"></textarea><br>
	<input type="text" name="wachtwoord" placeholder="Wachtwoord"/><br>
	<button type="submit">Verzenden</button>
</form>
<?php }
?>
