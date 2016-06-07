<?php
// This requires the libsodium PECL extension
require(__DIR__.'./functions.php');

if(isset($_POST['name']) && isset($_POST['wachtwoord'] )){

	$name = $_POST['name'];
	$wachtwoord =  $_POST['wachtwoord'];

	$conn = new mysqli("vps.lucmulder.nl", "<username>", "<wachtwoord>", "sec2");

	if($conn->connect_errno != 0){
        die("Fout bij comminucatie met database");
    }
	$query = "SELECT * FROM info WHERE naam='".$name."'";

	$result = $conn->query($query);
	$geheime_text = "";
	while($row = $result->fetch_assoc()){
    	$geheime_text = $row['geheime_text'];
    }

    echo "Geheime text: <br>";
    echo decrypt($geheime_text, $wachtwoord);

	$conn->close();
}else{ ?>

<h2>Decrypt-R-us</h2>
<form method="POST" action="decrypt.php">
	<input type="text" name="name" placeholder="Naam"/><br>
	<input type="text" name="wachtwoord" placeholder="Wachtwoord"/><br>
	<button type="submit">Verzenden</button>
</form>
<?php }
?>
