<!DOCTYPE html>
<html>
<head>
	<title>contact us</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="style_contact.css">
</head>
<body>
	<div class="contact_us">
		<div class="name"><a href="project.php">Home</a></div>
		<h1>Neem contact met ons op!!</h1>
	</div>
	<div class="contant">
		<form action="" method="post">
			<label>Voornamen</label>
			<input type="text" name="first_name">
			<label>Achternaam</label>
			<input type="text" name="last_name">
			<label>Geslacht</label>
			<p> <input class="radio" type="radio" name="gender" value="man" checked> Man </p>
			<p><input class="radio" type="radio" name="gender" value="vrouw"> Vrouw</p>
			<p><input class="radio" type="radio" name="gender" value="ander"> Ander</p>
			<label>Email</label>
			<input type="email" name="email">
			<label>Message</label>
			<textarea cols="40" rows="5" name="text"></textarea>
			<a href="#popup1" id="button"></a><input type="submit" name="send" onclick="document.getElementById('button').click()">
		</form>
	</div>
	<?php 
					if (isset($_POST['send'])) {
						if ($_POST['first_name'] && $_POST['last_name'] && $_POST['gender'] && $_POST['email'] && $_POST['text']) {
							?>
	<div id="popup1" class="overlay">
		<div class="popup">
			<h2>bevestiging!!</h2>
			<a class="close" href="#">&times;</a>
			<div class="content">
				
						<?php
							$first_name = $_POST['first_name'];
							$last_name = $_POST['last_name'];
							$gender = $_POST['gender'];
							$email = $_POST['email'];
							$text = $_POST['text'];

							if ($gender === "man") {
								$gender = "Meneer";
							}elseif ($gender === "vrouw") {
								$gender = "Mevrouw";
							}else{
								$gender = "Beste";
							}
							echo "<h3>".$gender." ".$first_name." ".$last_name." (".$email.")<br><br><p>".$text."</p>";
						
						?>
					<br>	
				<input type="submit" name="submit" value="send">
			</div>
		</div>
	</div>
<?php }
					} ?>
</body>
</html>