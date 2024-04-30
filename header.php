<html>
<head>
<style>
    .dropdown-item {
        background-color: #f8f9fa; /* Background color */
        animation: slideInLeft 0.5s ease; /* Animation */
    }

    /* Animation keyframes */
    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-20px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }
.dropdown-item:hover {
        background-color: red; /* Red background color on hover */
    }
.navbar-nav .nav-link:hover {
        color: red !important;
    }
.navbar-brand:hover {
        color: red !important;
    }

 .dropdown-item:focus,
    .dropdown-item.active {
        background-color: #f8f9fa; /* Change this to your preferred highlight color */
    }


</style>
</head>
<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse" style="padding-top: 20px; padding-bottom: 20px;">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="index.php"  style="font-size: 22px;text-align: left;">Online BloodBank & Donor Management System</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item">
                    <a class="nav-link" href="page.php?type=aboutus">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page.php?type=donor">Why Become Donor</a>
                </li>
               <!-- Dropdown for Be a Donor -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="bloodBankDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Be a Donor
    </a>
    <div class="dropdown-menu" aria-labelledby="bloodBankDropdown">
        <a class="dropdown-item" href="add-blood-bank.php">Add Blood Bank</a>
        <a class="dropdown-item" href="eligibility.php">Become a Donor</a>
    </div>
</li>

<!-- Dropdown for Looking for Blood -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="searchbloodDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Looking for Blood 
    </a>
    <div class="dropdown-menu" aria-labelledby="searchbloodDropdown">
        <a class="dropdown-item" href="blood-bank.php">Search Blood Bank</a>
        <a class="dropdown-item" href="search-donor.php">Search Donor</a>
    </div>
</li> 

<li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chatbot.html">Support</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap and jQuery libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
</script>
</html>
