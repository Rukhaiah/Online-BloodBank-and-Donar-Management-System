<?php
error_reporting(0);
include('includes/config.php');

// Function to fetch states from the database
function getStates() {
    global $dbh;
    $sql = "SELECT DISTINCT state FROM blood_banks";
    $query = $dbh->prepare($sql);
    $query->execute();
    $states = $query->fetchAll(PDO::FETCH_COLUMN);
    return $states;
}

// Function to fetch blood banks based on selected state and availability
function searchBloodBanks($state, $availability) {
    global $dbh;
    $sql = "SELECT * FROM blood_banks WHERE state = :state AND FIND_IN_SET(:availability, Availability)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':state', $state, PDO::PARAM_STR);
    $query->bindParam(':availability', $availability, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    return $results;
}

// Initialize variables
$error = '';
$msg = '';

if(isset($_POST['submit'])) {
    $state = $_POST['state'];
    $availability = $_POST['availability'];

    if(empty($state) || empty($availability)) {
        $error = "Please select both state and blood group.";
    } else {
        $results = searchBloodBanks($state, $availability);
        if(count($results) > 0) {
            $msg = "Blood banks found.";
        } else {
            $msg = "No blood banks found for the selected criteria.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BloodBank & Donor Management System | Search Blood Bank</title>
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
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    
    </style>
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="container"><br><br>
        <h1 class="mt-4 mb-3">Search <small>Blood Bank</small></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Looking for Blood</li>
        </ol><br><br>
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <form name="searchForm" method="post">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Blood Group<span style="color:red">*</span> </div>
                    <div>
                        <select name="availability" class="form-control" required>
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Choose a State<span style="color:red">*</span></div>
                    <select name="state" class="form-control" required>
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
              <center> <div class="col-lg-4 mb-4">
                    <br><br>
                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                </div>
           </center>
        </form><br><br>   

        <?php if(isset($results)) { ?>
            <?php if(count($results) > 0) { ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Blood Bank Name</th>
                                <th>Contact Number</th>
                                <th>Email id</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($results as $key => $result) { ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo htmlentities($result->blood_bank_name); ?></td>
                                    <td><?php echo htmlentities($result->contact_no); ?></td>
                                    <td><?php echo htmlentities($result->email); ?></td>
                                    <td><?php echo htmlentities($result->address); ?></td>
                                    <td><?php echo htmlentities($result->state); ?></td>
                                    <td><?php echo htmlentities($result->Availability); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">No blood banks found for the selected criteria.</div>
            <?php } ?>
        <?php } ?>
    </div><br><br>
    <?php include('includes/footer.php');?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
