<?php 
$con = mysqli_connect("localhost","root","root","afspraken");

if (isset($_POST["submit"])) {
$datum = $_POST["datum"];
$tijd = $_POST["tijd"];
$afspraak = $_POST["afspraak"];
$adres = $_POST["adres"];
//echo $datum ." ". $afspraak ." ". $adres;



// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
  	$sql = "INSERT INTO info (datum , tijd, afspraak, adres) VALUES ('$datum', '$tijd', '$afspraak', '$adres')";
  	if ($con->query($sql) === TRUE) {
    header('Location: project.php');
	} else {
	    echo "Error: " . $sql . "<br>" . $con->error;
	}
  }
}

if (isset($_POST["delete"])) {
  $id = $_POST["id"];

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
    $sql = "DELETE FROM `info` WHERE id =".$id;
    if ($con->query($sql) === TRUE) {
    header('Location: project.php');
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
  }
}
?>