<?php
session_start();

if (isset($_POST['Submit'])){
// xxxxxxxx form-handling code xxxxxxxx

// variables
$maxCapacityGTOE = $_POST['maxCapacityGTOE'];
$annualVisitorsGTOE = $_POST['annualVisitorsGTOE'];

$servername = "localhost";
$username = "root";
$password = "";
$db = "webgcs";


// try-catch block
try {
    
    	// xxxxxxxx database initialization code xxxxxxxx
	$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// prepare sql and bind parameters
	$stmt = $conn->prepare("select ship_name,cruise_company, max_cap, annual_visitors from cruise_visits where max_cap >= :maxCapacityGTOE AND annual_visitors > :annualVisitorsGTOE");
	//echo $email; echo $md5password;
	$stmt->bindParam(':maxCapacityGTOE', $maxCapacityGTOE);
	$stmt->bindParam(':annualVisitorsGTOE', $annualVisitorsGTOE); 
	
	$results = $stmt->execute();
	
	// xxxxxxxx database query code using PHP PDO xxxxxxxx
	$results = $stmt->execute();

if ($results){
    // xxxxxxxx results display code xxxxxxxx
    	
    	// xxxx My name xxxxxx
    	echo '245066357P NG CHIN LING ' . '<br><br>';
    	
	$rows =$stmt->fetchAll();
	//print_r($rows);
	foreach ($rows as $row){
	
	 echo 'Ship Name = ' . $row["ship_name"] . '<br>';
	 echo 'Cruise Company = '.$row["cruise_company"] .'<br>';
	 echo 'Max Capacity = '.$row["max_cap"] .'<br>';
	 echo 'Annual Visitors = '.$row["annual_visitors"] .'<br>';
	 echo '<br>';


	}

}
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
finally {
	$db = null;
}


echo('<a href="index.php">Go back to search page</a>');

}

// GET data
else
{
?>

<form method="POST" action="#" >
  	<br>245066357P NG CHIN LING</br>
	<br>Search cruise visits:</br>
	
	<br>Max capacity greater than or equals: <input type='number' length=20 name='maxCapacityGTOE'></input></br>
	<br>Annual visitors greater than or equals: <input type='number' length=20 name='annualVisitorsGTOE'></input></br>
	
	<br><input type='Submit' name='Submit' value='Submit'></input>
	</form>

<?php
}
?>
