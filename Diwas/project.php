<!DOCTYPE html>
<html>
<head>
	<title>Diwas Paudel</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<header>
	<div class="name"><a href="#">Diwas Paudel</a></div>
	<div class="title"><a href="#">Project Afspraken</a></div>
	<div class="navmenu"><a href="contact.php"target="_blank">Contact Us</a></div>
	<div class="search">
		<form action="" method="post">
			<input type="text" name="zoekentext"><a href="#popupsearch1" id= "searchbutton"></a>
			<button type="submit" name="zoeken" value="zoeken" onclick="document.getElementById('searchbutton') .click()"><i class= "fa fa-search"></i> </button>
		</form>
	</div>
</header>
<section>
	<div>	
		<table class="table table-sm table-dark">
			<thead>
				<tr>
					<th scope="col">Datum</th>
					<th scope="col">Tijd</th>
					<th scope="col">Afspraak</th>
					<th scope="col">Adres</th>
				</tr>
			</thead>
  			<tbody>
  				<?php  
$con = new mysqli("localhost","root","root","afspraken");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
  	$sql = "SELECT * FROM info ORDER BY datum ASC ";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	?>
	    	<tr>
					<th scope="row"><?= $row["datum"]?></th>
					<td><?= $row["tijd"]?></td>
					<td><?= $row["afspraak"]?></td>
					<td><?= $row["adres"]?></td>
					<td>
						<form action="backend.php" method="post">
						<input type="submit" name="delete" value="delete">
						<input type="hidden" name="id" value="<?= $row["id"]?>">
						</form>
					</td>
					<td>
						<form action="" method="post">
						<a href="#popup1" id="button"></a><input type="submit" name="edit" value="wijzigen" onclick="document.getElementById('button').click()">
						<input type="hidden" name="datum" value="<?= $row["datum"]?>">
						<input type="hidden" name="tijd" value="<?= $row["tijd"]?>">
						<input type="hidden" name="afspraak" value="<?= $row["afspraak"]?>">
						<input type="hidden" name="adres" value="<?= $row["adres"]?>">
						<input type="hidden" name="id" value="<?= $row["id"]?>">
						</form>
					</td>
				</tr>
			<?php
	    }
	} else {
	    echo "0 results";
	}
	$con->close();
  }
?>
  			</tbody>
  		</table>
	</div>
	<div class="send">
		<form action="backend.php" method="post">	
			<table class="table table-sm table-dark">
				<thead>
					<tr>
						<th scope="col">Datum</th>
						<th scope="col">Tijd</th>
						<th scope="col">Afspraak</th>
						<th scope="col">Adres</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row"><input type="date" name="datum"></th>
						<td><input type="time" name="tijd"></td>
						<td><input type="text" name="afspraak"></td>
						<td><input type="text" name="adres"></td>
						<td><input type="submit" name="submit"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</section>
<div id="popup1" class="overlay">
		<div class="popup" style="width: 72%;">
			<h2>Wijzigen</h2>
			<a id="cancel" class="close" href="#">&times;</a>
			<div class="content">
				<?php
				if (isset($_POST["edit"])){
					$datum = $_POST["datum"];
					$tijd = $_POST["tijd"];
					$afspraak = $_POST["afspraak"];
					$adres = $_POST["adres"];
					$id = $_POST["id"];
					
					}
				?>
				<table class="table table-sm table-dark">
				<thead>
					<tr>
						<th scope="col">Datum</th>
						<th scope="col">Tijd</th>
						<th scope="col">Afspraak</th>
						<th scope="col">Adres</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">
						<form action="" method="post">
							<input type="date" name="datum" value="<?= $datum ?>"></th>
							<td><input type="time" name="tijd" value="<?= $tijd ?>"></td>
							<td><input type="text" name="afspraak"value="<?= $afspraak ?>"></td>
							<td><input type="text" name="adres"value="<?= $adres ?>"></td>
							<input type="hidden" name="id" value="<?= $id?>">
							<div style="position: absolute;top: 155px;">
								<input type="submit" name="saveit" value="opslaan" onclick="document.getElementById('cancel').click()">
								<input type="submit" name="cancel" value="annuleren" onclick="document.getElementById('cancel').click()">
							</div>
						</form>
						<?php
							if (isset($_POST['saveit'])) {
							$con = new mysqli("localhost","root","root","afspraken");
							$datum = $_POST["datum"];
							$tijd = $_POST["tijd"];
							$afspraak =  $_POST["afspraak"];
							$adres = $_POST["adres"];
							$id = $_POST['id'];
							$sql = "UPDATE info SET datum='$datum',tijd='$tijd',afspraak='$afspraak',adres='$adres' WHERE id='$id'";
							if ($con->query($sql) === TRUE) {
							header('Location: project.php');
							} else {
							echo "Error updating record: " . $con->error; 
							}
							}
						?>
							
					</th>
					</tr>
				</tbody>
			</table>
				<br>	
			</div>
		</div>
	</div>
<div id="popupsearch1" class="overlaysearch">
		<div class="popupsearch">
			<h2>Result</h2>
			<a class="closesearch" href="#">&times;</a>
			<div class="contentsearch">
							<?php
								if (isset($_POST['zoeken'])) {
									$text = $_POST['zoekentext'];
									$con = new mysqli("localhost","root","root","afspraken");
									$sql = "SELECT * from info where datum like '%$text%' or tijd like '%$text%' or afspraak like '%$text%' or adres like '%$text%' ";
									$query = mysqli_query($con,$sql);
									$search = mysqli_fetch_assoc($query);
									if (mysqli_num_rows($query) != 0) {
										?>
								<table class="table table-sm table-dark">
									<thead>
										<tr>
											<th scope="col">Datum</th>
											<th scope="col">Tijd</th>
											<th scope="col">Afspraak</th>
											<th scope="col">Adres</th>
										</tr>
									</thead>
									<tbody>
									<?php
										do{
											?>
												<tr>
													<th scope="row"><?= $search['datum'] ?></th>
													<td><?= $search['tijd'] ?></td>
													<td><?= $search['afspraak'] ?></td>
													<td><?= $search['adres'] ?></td>
												</tr>
											<?php
										}while ($search = mysqli_fetch_assoc($query));
									}else{
										echo "<h5>no result found</h5>";
									}
								}
							?>
					</tbody>
				</table>
			</div>
		</div>
	</div>				
</body>
</html>














