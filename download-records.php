<?php 
session_start();
//error_reporting(0);
session_regenerate_id(true);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {	
	header("Location: index.php");
	exit(); // After sending the location header, it's good to exit to prevent further execution
} else {
	$filename = "Donor list.xls";

	// Set headers for file download
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");

	// Output the table headers
	echo '<table border="1">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Mobile No</th>
					<th>Email</th>
					<th>Age</th>
					<th>Gender</th>
					<th>Blood Group</th>
					<th>State</th>
					<th>Message</th>
					<th>posting date</th>
				</tr>
			</thead>';

	$sql = "SELECT * FROM tblblooddonars";
	$query = $dbh->prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	$cnt = 1;
	if($query->rowCount() > 0) {
		foreach($results as $result) {				
			echo '<tr>
					<td>'.$cnt.'</td>
					<td>'.$result->FullName.'</td>
					<td>'.$result->MobileNumber.'</td>
					<td>'.$result->EmailId.'</td>
					<td>'.$result->Age.'</td>
					<td>'.$result->Gender.'</td>
					<td>'.$result->BloodGroup.'</td>
					<td>'.$result->State.'</td>
					<td>'.$result->Message.'</td>
					<td>'.$result->PostingDate.'</td>
				</tr>';
			$cnt++;
		}
	}

	echo '</table>';
	exit(); // After generating the file, exit to prevent further HTML output
}
?>
