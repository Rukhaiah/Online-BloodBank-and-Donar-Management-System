<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checking Eligibility</title>
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
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #ff99cc;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #ff99cc;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        #form-container {
            background-color: #ff8080; /* Light gray background color */
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
           /* text-align: center;  Center align the content */
            margin: 0 auto; /* Center the container horizontally */
            max-width: 5000px !important;

        }
.form-wrapper {
    max-width: 4000px; /* Adjust this value as needed */
    margin: 0 auto;  Center the form horizontally */
    padding: 0 10px; /* Add some padding for better readability */
}

		/* Change the size and color of checkboxes */
input[type="checkbox"] {
    width: 20px; /* Set the width of the checkbox */
    height: 20px; /* Set the height of the checkbox */
    margin-right: 5px; /* Add some space between the checkbox and its label */
}
/* Change the size and color of checkboxes */
input[type="radio"] {
    width: 20px; /* Set the width of the checkbox */
    height: 20px; /* Set the height of the checkbox */
    margin-right: 5px; /* Add some space between the checkbox and its label */
}

/* Change the color of the checkboxes */
input[type="checkbox"]::before {
    background-color: pink; /* Set the background color of the checkbox */
}

    </style>
<script>
function checkEligibility() {
    var gender = document.querySelector('input[name="gender"]:checked');
    var bloodDonatedBefore = document.querySelector('input[name="bloodDonatedBefore"]:checked');
    var eligibilityResult = document.getElementById("eligibilityResult");
    var additionalCriteria = document.querySelectorAll('input[name="additional_criteria[]"]:checked');

    if (!gender) {
        eligibilityResult.textContent = "Please select your gender.";
        return;
    }
var isPregnant = document.querySelector('input[name="pregnancy"]:checked');

if (isPregnant && isPregnant.value === "yes") {
    alert("Sorry, you are not eligible to donate blood because you are pregnant or breastfeeding.");
	return;
} 



    // If the user has not donated blood before, immediately display eligibility message
    if (bloodDonatedBefore && bloodDonatedBefore.value === "no") {
        eligibilityResult.textContent = "You are eligible to donate blood.";
        // Proceed to step 2
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
        return;
    }

    // If the user has donated blood before, proceed with regular eligibility check
    var lastDonationDate = document.getElementById("lastDonationDate").value;
    var today = new Date();
    var lastDonation = new Date(lastDonationDate);

    if (gender.value === "female") {
        var eligibleMonth = 4;
    } else if (gender.value === "male") {
        var eligibleMonth = 3;
    }

    var monthsSinceLastDonation = (today.getFullYear() - lastDonation.getFullYear()) * 12 + (today.getMonth() - lastDonation.getMonth());

    // Check if any additional criteria, except "None of the above," are selected
    var additionalCriteriaSelected = false;
    additionalCriteria.forEach(function(criteria) {
        if (criteria.value !== "none_of_the_above") {
            additionalCriteriaSelected = true;
        }
    });

    if (monthsSinceLastDonation >= eligibleMonth && !additionalCriteriaSelected) {
        eligibilityResult.textContent = "You are eligible to donate blood.";
        // Proceed to step 2
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    } else {
        var notEligibleMessage = "Sorry, you are not eligible to donate blood.";
        if (additionalCriteriaSelected) {
            notEligibleMessage += " Selected additional criteria: ";
            additionalCriteria.forEach(function(criteria) {
                if (criteria.value !== "none_of_the_above") {
                    notEligibleMessage += criteria.value + ", ";
                }
            });
            notEligibleMessage = notEligibleMessage.slice(0, -2); // Remove trailing comma and space
        }
        else {
            var monthsToWait = eligibleMonth - monthsSinceLastDonation;
            notEligibleMessage += " for " + monthsToWait + " months.";
		 alert(notEligibleMessage);
        }
       // eligibilityResult.textContent = notEligibleMessage;
        // Ensure step 2 is hidden
        document.getElementById("step2").style.display = "none";
    }
}
function checkEligibilityStep2() {
        var name = document.getElementById("name").value;
        var age = document.getElementById("age").value;
        var weight = document.getElementById("weight").value;
        var additionalCriteria = document.querySelectorAll('input[name="additional_criteria[]"]:checked');

        // Check if any additional criteria, except "None of the above," are selected
        var additionalCriteriaSelected = false;
        additionalCriteria.forEach(function(criteria) {
            if (criteria.value !== "none_of_the_above") {
                additionalCriteriaSelected = true;
            }
        });

         // Check if age is between 18 and 65 and weight is 45 or more
    if (name && age >= 18 && age <= 65 && weight >= 45 && !additionalCriteriaSelected) {
        window.location.href = "become-donar.php"; // Navigate to the next page
    } else {
        var notEligibleMessage = "Sorry, you are not eligible to donate blood. ";
        if (age < 18 || age > 65) {
            notEligibleMessage += "Age must be between 18 and 65. ";
        }
        if (weight < 44) {
            notEligibleMessage += "Weight must be 45 kilograms or more. ";
        }
        if (additionalCriteriaSelected) {
            notEligibleMessage += "Selected additional criteria: ";
            additionalCriteria.forEach(function(criteria) {
                if (criteria.value !== "none_of_the_above") {
                    notEligibleMessage += criteria.value + ", ";
                }
            });
            notEligibleMessage = notEligibleMessage.slice(0, -2); // Remove trailing comma and space
        }
        alert(notEligibleMessage);
    }
}

</script>

	
</head>
<body>
<?php include('includes/header.php');?>
<div class="container">
    <br><br>
    <h1 class="mt-4 mb-3">Eligibility <small>Check</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Become a Donor</li>
    </ol><br><br>
    <form name="donar" method="post">
        <div class="row">
            <div id="form-container">
                <div id="step1">
                    <h2 >Step 1: Have you donated your Blood Before..? </h2><br><br>
                    <form id="bloodDonationForm">
    <label for="gender" style="font-size: 25px;color:white;">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male" onclick="showdonated()">
    <label for="male" style="font-size: 25px;color:black;">Male</label><br>
    <input type="radio" id="female" name="gender" value="female" onclick="showpregnancy()">
    <label for="female" style="font-size: 25px;color:black;">Female</label><br><br>

<div id="pregnancyContainer" style="display: none;color:white;">
        <label for="pregnancy" style="font-size: 25px;">Are you currently pregnant or breastfeeding?</label><br>
        <input type="radio" id="yes" name="pregnancy" value="yes" onclick="hidedonated()">
	<label for="yes" style="font-size: 25px;color:black;">Yes</label><br>
	<input type="radio" id="no" name="pregnancy" value="no" onclick="showdonated()">
	<label for="no" style="font-size: 25px;color:black;">No</label><br><br>

    </div>
    <br><br>

<div id="donatedContainer" style="display: none;color:white;">

    
    <label for="bloodDonatedBefore" style="font-size: 25px;color:white;">Have you donated your blood before?</label><br>
    <input type="radio" id="yes" name="bloodDonatedBefore" value="yes" onclick="showLastDonationDate()">
    <label for="yes" style="font-size: 25px;color:black;">Yes</label><br>
    <input type="radio" id="no" name="bloodDonatedBefore" value="no" onclick="hideLastDonationDate()">
    <label for="no" style="font-size: 25px;color:black;">No</label><br><br>
</div>

    <div id="lastDonationDateContainer" style="display: none;color:white;">
        <label for="lastDonationDate" style="font-size: 25px;">Last Donation Date:</label><br>
        <input type="date" id="lastDonationDate" name="lastDonationDate"><br><br><br><br>
    </div>
    <br><br>
   <center> <button type="button" style="background-color: #4CAF50; /* Green */ color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="checkEligibility()">Check Eligibility</button></center>
</form>

<script>
    function showpregnancy() {
        document.getElementById("pregnancyContainer").style.display = "block";
    }

   function hidepregnancy() {
        document.getElementById("pregnancyContainer").style.display = "none";
    }
 function showdonated() {
        document.getElementById("donatedContainer").style.display = "block";
    }

   function hidedonated() {
        document.getElementById("donatedContainer").style.display = "none";
    }

    function showLastDonationDate() {
        document.getElementById("lastDonationDateContainer").style.display = "block";
    }

    function hideLastDonationDate() {
        document.getElementById("lastDonationDateContainer").style.display = "none";
    }
</script>
<br><br>
                    <p id="eligibilityResult"></p>
                </div>
                <div id="step2" style="display: none;">
                  <center>  <h2>Step 2: Please Fill the Eligibility Form</h2></center><br>
                    <form>
<div class="form-wrapper">
    <!-- Your form content here -->

    <br>
    <label for="name" style="font-size: 25px;color:white;">Name:</label><br><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="age" style="font-size: 25px;color:white;">Age:</label><br><br>
    <input type="number" id="age" name="age" min="18" max="65" required><br><br>
    
    <label for="weight" style="font-size: 25px;color:white;">Weight (kg):</label><br><br>
    <input type="number" id="weight" name="weight" min="45" required><br><br><br>
    
    <center>  <h2>Additional Criteria:</h2></center><br><br>
                        <input type="checkbox" id="illness" name="additional_criteria[]" value="illness">
                        <label for="illness" style="font-size: 25px;color:white;">Have you experienced any illness, fever, or symptoms in the past week?</label><br>
						
			<input type="checkbox" id="travel" name="additional_criteria[]" value="travelled_to_endemic_diseases">
                        <label for="travel" style="font-size: 25px;color:white;">Have you traveled to regions with diseases like malaria, Zika, or other bloodborne illnesses?</label><br>
						
                        


						
  

                        <input type="checkbox" id="blood_transfusion" name="additional_criteria[]" value="blood_transfusion">
                        <label for="blood_transfusion" style="font-size: 25px;color:white;">Have you undergone surgery or received a blood transfusion in the past year?</label><br>
						
						
                        <input type="checkbox" id="cancer" name="additional_criteria[]" value="cancer">
                        <label for="cancer" style="font-size: 25px;color:white;">Have you ever been diagnosed with a blood disorder or cancer? </label><br>
						
						
                        <input type="checkbox" id="hepatitis" name="additional_criteria[]" value="hepatitis">
                        <label for="hepatitis" style="font-size: 25px;color:white;">Have you ever been diagnosed with HIV/AIDS, hepatitis B, or hepatitis C?</label><br>
						
						
                        <input type="checkbox" id="drug_abuse" name="additional_criteria[]" value="Vaccinated">
                        <label for="drug_abuse" style="font-size: 25px;color:white;">Have you received any vaccinations, immunizations, or medical treatments recently?</label><br>
						
                        <input type="checkbox" id="doctor_prescribed_drug" name="additional_criteria[]" value="doctor_prescribed_drug">
                        <label for="doctor_prescribed_drug" style="font-size: 25px;color:white;">Have you ever injected drugs not prescribed by a healthcare provider?</label><br>
			
			<input type="checkbox" id="hemoglobin" name="additional_criteria[]" value="Hemoglobin">
                        <label for="hemoglobin" style="font-size: 25px;color:white;">Have you ever been told by a healthcare provider that you have low hemoglobin or anemia?</label><br>
						
						
			   <input type="checkbox" id="none_of_the_above" name="additional_criteria[]" value="none_of_the_above">
                        <label for="none_of_the_above" style="font-size: 25px;color:white;">None of the above</label><br><br><br><br>
                
    <center><button type="button" style="background-color: #4CAF50; /* Green */ color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="checkEligibilityStep2()">Check Eligibility</button></center>
</form>
<script>
    function showLasttravelled() {
        document.getElementById("lasttravelledContainer").style.display = "block";
    }

    function hideLasttravelled() {
        document.getElementById("lasttravelledContainer").style.display = "none";
    }
</script>
<br><br>


                </div>
            </div>
        </div>
    </form>
</div>

</div><br><br><br><br>
<?php include('includes/footer.php');?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
