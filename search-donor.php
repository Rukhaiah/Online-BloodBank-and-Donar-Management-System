<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BloodBank & Donor Management System | Become A Donor</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
		 table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="container"><br><br>
        <h1 class="mt-4 mb-3">Search <small>Donor</small></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Search Donor</li>
        </ol>
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <form name="donor" method="post">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Blood Group<span style="color:red">*</span> </div>
                    <div>
                        <select name="bloodgroup" class="form-control" required>
                            <?php 
                            $sql = "SELECT * from  tblbloodgroup ";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0) {
                                foreach($results as $result) { ?>  
                                    <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
				</div>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Choose a State<span style="color:red">*</span></div>
                        <select id="states" name="state" onchange="populateDistricts()" style="height: 40px; width: 600px;">
                            <option value="">Select a State</option>
                            
								 <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
								 <option value="Andhra Pradesh">Andhra Pradesh</option>
								 <option value="Arunachal Pradesh">Arunachal Pradesh</option>
								 <option value="Assam">Assam</option>
								 <option value="Bihar">Bihar</option>
								 <option value="Chandigarh">Chandigarh</option>
								 <option value="Chhattisgarh">Chhattisgarh</option>
								 <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
								 <option value="Daman and Diu">Daman and Diu</option>
								 <option value="Delhi">Delhi</option>
								 <option value="Goa">Goa</option>
								 <option value="Gujarat">Gujarat</option>
								 <option value="Haryana">Haryana</option>
								 <option value="Himachal Pradesh">Himachal Pradesh</option>
								 <option value="Jammu and Kashmir">Jammu and Kashmir</option>
								 <option value="Jharkhand">Jharkhand</option>
								 <option value="Karnataka">Karnataka</option>
								 <option value="Kerala">Kerala</option>
								 <option value="Ladakh">Ladakh</option>
								 <option value="Lakshadweep">Lakshadweep</option>
								 <option value="Madhya Pradesh">Madhya Pradesh</option>
								 <option value="Maharashtra">Maharashtra</option>
								 <option value="Manipur">Manipur</option>
								 <option value="Meghalaya">Meghalaya</option>
								 <option value="Mizoram">Mizoram</option>
								 <option value="Nagaland">Nagaland</option>
								 <option value="Odisha">Odisha</option>
								 <option value="Puducherry">Puducherry</option>
								 <option value="Punjab">Punjab</option>
								 <option value="Rajasthan">Rajasthan</option>
								 <option value="Sikkim">Sikkim</option>
								 <option value="Tamil Nadu">Tamil Nadu</option>
								 <option value="Telangana">Telangana</option>
								 <option value="Tripura">Tripura</option>
								 <option value="Uttar Pradesh">Uttar Pradesh</option>
								 <option value="Uttarakhand">Uttarakhand</option>
								 <option value="West Bengal">West Bengal</option>
							  </select>
													
                    </div>
                </div>
                <br>
            <center>
                <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
            </center>
			<br>
        </form>   

        <div class="row">
            <?php 
            if(isset($_POST['submit'])) {
                $status = 1;
                $bloodgroup = $_POST['bloodgroup'];
                $state = $_POST['state'];
                $sql = "SELECT * FROM tblblooddonars WHERE status = :status AND BloodGroup = :bloodgroup AND State = :state";
                $query = $dbh->prepare($sql);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
                $query->bindParam(':state', $state, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0) { ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Blood Group</th>
                                    <th>Gender</th>
                                    <th>State</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($results as $key => $result) { ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo htmlentities($result->FullName); ?></td>
                                        <td><?php echo htmlentities($result->Age); ?></td>
                                        <td><?php echo htmlentities($result->BloodGroup); ?></td>
                                        <td><?php echo htmlentities($result->Gender); ?></td>
                                        <td><?php echo htmlentities($result->State); ?></td>
                                        <td><?php echo htmlentities($result->Message); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert">No Donors Found!</div>
                <?php }
            } ?>
        </div>
    </div>
    <?php include('includes/footer.php');?>
	 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
