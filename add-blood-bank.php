
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your PHP code here

include('includes/config.php');

$blood_bank_name_err = $contact_no_err = $email_err = $address_err = $state_err = $pincode_err = $website_err = $error = $msg = "";

if(isset($_POST['submit'])) {
    $blood_bank_name=$_POST['blood_bank_name'];
    $contact_no=$_POST['contact_no'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $state=$_POST['state'];
     $availability = implode(",", $_POST['availability']); // Convert array to comma-separated string
    
$status=1;

    $sql="INSERT INTO  blood_banks(blood_bank_name,contact_no,Email,address,state,status,Availability) VALUES(:blood_bank_name,:contact_no,:email,:address,:state,:status,:availability)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':blood_bank_name',$blood_bank_name,PDO::PARAM_STR);
    $query->bindParam(':contact_no',$contact_no,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':state',$state,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':availability', $availability, PDO::PARAM_STR);


    if ($query->execute()) {
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Your info submitted successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    } else {
        $error = "Database error: " . $query->errorInfo()[2]; // Display specific error message
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

    <title>BloodBank & Donor Management System | Add Blood Bank</title>
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
    </style>
        <style>
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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs --><br><br>
        <h1 class="mt-4 mb-3">Add Blood Bank Details</small></h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Add Blood Bank</li>
        </ol>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <!-- Content Row -->
        <form name="donar" method="post">
<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">Blood Bank Name<span style="color:red">*</span></div>
<div><input type="text" name="blood_bank_name"  class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">Contact Number<span style="color:red">*</span></div>
<div><input type="text" name="contact_no"  maxlength="10" class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">Email Id<span style="color:red">*</span></div>
<div><input type="text" name="email"  class="form-control" required></div>
</div>

<div class="col-lg-4 mb-4">
<div class="font-italic">Address<span style="color:red">*</span></div>
<div><input type="text" name="address"  class="form-control" required></div>
</div>

<div class="col-lg-4 mb-4">
    <div class="font-italic">Availability (select multiple)<span style="color:red">*</span></div>
    <select name="availability[]" multiple class="form-control" required>
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


<div class="col-lg-4 mb-4">
<div class="font-italic">Pincode</div>
<div><input type="text" name="pincode" class="form-control" ></div>
</div>


<div class="col-lg-4 mb-4">
<div class="font-italic">Website</div>
<div><input type="text" name="website"  class="form-control" ></div>
</div>
</div>


<div class="row">
<div class="col-lg-4 mb-4">


 <div class="font-italic">Choose a State<span style="color:red">*</span></div>
  <select id="states" onchange="populateDistricts()" style="height: 40px; width: 600px;">
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
<br><br>
 <div class="font-italic">Choose a District<span style="color:red">*</span></div>
 <select id="districts" name="district" style="height: 40px; width: 600px;">
    <option value="">Select a District</option>
  </select>
  <script>
    function populateDistricts() {
      var stateDropdown = document.getElementById("states");
      var districtDropdown = document.getElementById("districts");
      var selectedState = stateDropdown.value;
	var selectedDistrict = districtDropdown.value;
  districtDropdown.innerHTML = ""; // Clear existing options
        
      if (selectedState === "") {
        districtDropdown.innerHTML = '<option value="">Select a District</option>';
        return;
      }

      // Define districts based on the selected state
      var districts = [];
      switch(selectedState) {
       case "Andaman and Nicobar Islands":
          districts = ["North and Middle Andaman", "Nicobar", "South Andaman"];
          break;
    	
        case "Andhra Pradesh":
          districts = ["Alluri Sitharama Raju","Anakapalli","Anantapuram","Annamayya","Bapatla","Chittoor","East Godavari","Eluru","Guntur", "Kakinada", "Konaseema", "Krishna","Kurnool","Nandyal","NTR","Palnadu","Parvathipuramu Manyam","Prakasam","Sri Potti Sriramulu Nellore","Sri Sathya Sai","Srikakulam","Tirupati","Visakhapatnam","Vizianagaram","West Godavari","YSR Kadapa"];
          break;

        case "Arunachal Pradesh":
          districts = ["Anjaw","Changlang","East Kameng	","East Siang","Kamle","Kra Daadi","Kurung Kumey","Lepa Rada","Lohit", "Longding", "Lower Dibang Valley", "Lower Siang","Lower Subansiri","Namsai","Pakke-Kessang","Papum Pare","Shi Yomi","Siang","Tawang","Tirap","Upper Dibang Valley","Upper Siang","Upper Subansiri","West Kameng","West Siang","Itanagar Capital District"];
		break;

case "Assam":
          districts = ["Baksa", "Barpeta", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Dima Hasao", "Goalpara", "Golaghat", "Hailakandi", "Jorhat", "Kamrup", "Kamrup Metropolitan", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Sivasagar", "Sonitpur","South Salmara-Mankachar","Tinsukia","Udalguri","West Karbi Anglong"]
break;

    case "Bihar":
          districts = ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"]
break;

    case "Chandigarh":
          districts = ["Chandigarh"];
          break;

    case "Chhattisgarh":
          districts = ["Raipur","Durg","Bilaspur","Korba","Raigarh","Baloda Bazar","Mahasamund","Janjgir-Champa","Rajnandgaon","Jashpur","Surguja","Bastar","Balod","Kabirdham","Dhamtari","Bemetara","Surajpur","Kanker","Balrampur","Mungeli","Sakti","Sarangarh-Bilaigarh","Gariaband","Kondagaon","Manendragarh-Chirmiri-Bharatpur","Khairagarh Chhuikhadan-Gandai","Gaurella-Pendra-Marwahi","Mohla-Manpur-Chowki","Dantewada","Bijapur","Sukma","Koriya","Narayanpur"];
          break;

    case "Dadra and Nagar Haveli and Daman and Diu":
          districts = ["Dadra and Nagar Haveli", "Daman", "Diu"];
          break;

    
    case "Delhi":
          districts = ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "North East Delhi", "North West Delhi", "Shahdara", "South Delhi", "South East Delhi", "South West Delhi", "West Delhi"];
          break;

    case "Goa":
          districts = ["North Goa", "South Goa"];
          break;

    case "Gujarat":
          districts = ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad", "Chhota Udepur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal", "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"];
          break;

    case "Haryana":
          districts = ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurgaon", "Hissar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Nuh", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamuna Nagar"];
          break;

    case "Himachal Pradesh":
          districts = ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul and Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"];
          break;

    case "Jammu and Kashmir":
          districts = ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Ganderbal", "Kulgam", "Kupwara", "Pulwama", "Shopian", "Srinagar", "Doda", "Jammu", "Kathua", "Kishtwar", "Poonch", "Rajouri", "Ramban", "Reasi", "Samba", "Udhampur"];
          break;

    case "Jharkhand":
          districts = ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Kodarma", "Latehar", "Lohardaga", "Pakur", "Palamu", "Ramgarh", "Ranchi", "Sahibganj", "Saraikela Kharsawan", "Simdega", "West Singhbhum"];
          break;

    case "Karnataka":
          districts = ["Bagalkot", "Ballari", "Bangalore Rural", "Bangalore Urban", "Belgaum / Belagavi", "Bidar", "Bijapur", "Chamarajanagara", "Chikkaballapura", "Chikmagalur", "Chitradurga", "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Gulbarga", "Hassan", "Haveri", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysore", "Raichur", "Ramanagara", "Shimoga", "Tumakuru", "Udupi", "Uttara Kannada", "Vijayanagara", "Yadgir"];
          break;

    case "Kerala":
          districts = ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thrissur", "Thiruvananthapuram", "Wayanad"];
          break;

    case "Ladakh":
          districts = ["Kargil","Leh (Ladakh)"];
          break;

    case "Lakshadweep":
          districts = ["Lakshadweep"];
          break;

    case "Madhya Pradesh":
          districts = ["Agar Malwa","Alirajpur","Anuppur","Ashok Nagar","Balaghat","Barwani","Betul","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Datia","Dewas","Dhar","Dindori","Guna","Gwalior","Harda","Hoshangabad","Indore","Jabalpur","Jhabua","Katni","Khandwa (East Nimar)","Khargone (West Nimar)","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Niwari","Panna","Raisen","Rajgarh","Ratlam","Rewa","Sagar","Satna","Sehore","Seoni","Shahdol","Shajapur","Sheopur","Shivpuri","Sidhi","Singrauli","Tikamgarh","Ujjain","Umaria","Vidisha"];
          break;

    case "Maharashtra":
          districts = ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana", "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur", "Mumbai City", "Mumbai suburban", "Nanded", "Nandurbar", "Nagpur", "Nashik", "Osmanabad", "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"];
          break;

    case "Manipur":
          districts = ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West", "Jiribam", "Kakching", "Kamjong", "Kangpokpi", "Noney", "Pherzawl", "Senapati", "Tamenglong", "Tengnoupal", "Thoubal", "Ukhrul"];
          break;

    case "Meghalaya":
          districts = ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "Eastern West Khasi Hills", "North Garo Hills", "Ri-Bhoi", "South Garo Hills", "South West Garo Hills", "South West Khasi Hills", "West Garo Hills", "West Jaintia Hills", "West Khasi Hills"];
          break;

    case "Mizoram":
          districts = ["Aizawl", "Champhai", "Hnahthial", "Khawzawl", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Saitual", "Serchhip"];
          break;

    case "Nagaland":
          districts = ["Chümoukedima", "Dimapur", "Kiphire", "Kohima", "Longleng", "Mon", "Mokokchung", "Niuland", "Noklak", "Phek", "Peren", "Shamator", "Tuensang", "Tseminyü", "Wokha", "Zünheboto"];
          break;

    case "Odisha":
          districts = ["Angul", "Balangir", "Balasore", "Bargarh (Baragarh)", "Bouda", "Bhadrak", "Cuttack", "Debagarh (Deogarh)", "Dhenkanal", "Gajapati", "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar (Keonjhar)", "Khordha", "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada", "Sambalpur", "Subarnapur (Sonepur)", "Sundargarh"];
          break;

    case "Puducherry":
          districts = ["Karaikal","Mahe","Puducherry", "Yanam"];
          break;

    case "Punjab":
          districts = ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Firozpur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Mansa", "Malerkotla", "Moga", "Pathankot", "Patiala", "Rupnagar", "Sahibzada Ajit Singh Nagar", "Sangrur", "Shahid Bhagat Singh Nagar", "Sri Muktsar Sahib", "Tarn Taran"];
          break;

    case "Rajasthan":
          districts = ["Anoopgarh", "Balotra", "Beawar", "Deeg", "Deedwana-Kuchaman", "Dudu", "Gangapur City", "Jaipur Rural", "Jodhpur Rural", "Kekri", "Khairthal-Tijara", "Kotputli-Behror", "Neem kaThana", "Phalodi", "Salumber", "Sanchore", "Shahpura"];
          break;

    case "Sikkim":
          districts = ["East Sikkim (Gangtok )", "North Sikkim (Mangan)	", "South Sikkim (Namchi)", "West Sikkim (Gyalshing)","Soreng","Pakyong"];
          break;

    case "Tamil Nadu":
          districts = ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kallakurichi", "Kanchipuram", "Kanniyakumari", "Karur", "Krishnagiri", "Madurai", "Mayiladuthurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Ranipet", "Salem", "Sivagangai", "Tenkasi", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tirupathur", "Tiruppur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"];
          break;

    case "Telangana":
          districts = ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagitial", "Jangaon", "Jayashankar Bhupalpally", "Jogulamba Gadwal", "Kamareddy", "Karimnagar", "Khammam", "Komaram Bheem", "Mahabubabad", "Mahabubnagar", "Mancherial", "Medak", "Medchal–Malkajgiri", "Mulugu", "Nagarkurnool", "Narayanpet", "Nalgonda", "Nirmal", "Nizamabad", "Peddapalli", "Rajanna Sircilla", "Ranga Reddy", "Sangareddy", "Siddipet", "Suryapet", "Vikarabad", "Wanaparthy", "Warangal Rural", "Warangal Urban", "Yadadri Bhuvanagiri"];
          break;

    case "Tripura":
          districts = ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unokoti", "West Tripura"];
          break;

    case "Uttar Pradesh":
          districts = ["Agra", "Aligarh", "Allahabad", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Bagpat", "Bahraich", "Ballia", "Balrampur", "Banda", "Barabanki", "Bareilly", "Basti", "Bhadohi", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria", "Etah", "Etawah", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddha Nagar", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur Dehat", "Kanpur Nagar", "Kanshiram Nagar", "Kaushambi", "Kushinagar", "Lakhimpur Kheri", "Lalitpur", "Lucknow", "Maharajganj", "Mahoba", "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit", "Pratapgarh", "Rae Bareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Sant Ravidas Nagar", "Shahjahanpur", "Shamli", "Shravasti", "Siddharthnagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"];

          break;

    case "Uttarakhand":
          districts = ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital", "Pauri Garhwal", "Pithoragarh", "Rudraprayag", "Tehri Garhwal", "Udham Singh Nagar", "Uttarkashi"];
          break;

    case "West Bengal":
          districts = ["Alipurduar", "Bankura", "Paschim Bardhaman", "Purba Bardhaman", "Birbhum", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly", "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Maldah", "Murshidabad", "Nadia", "North 24 Parganas", "Paschim Medinipur", "Purba Medinipur", "Purulia", "South 24 Parganas", "Uttar Dinajpur"];
          break;
    
        // Add cases for other states here
        default:
          break;
      }
	  

      // Populate district dropdown with options
      districts.forEach(function(district) {
        var option = document.createElement("option");
        option.text = district;
        option.value = district;
        districtDropdown.add(option);
      });
document.getElementById("state").value = selectedState;
        document.getElementById("district").value = selectedDistrict;
      
    }
	
  </script>
<br><br><br>
</div>
</div>
<input type="hidden" id="state" name="state">
    <input type="hidden" id="district" name="district">

<div class="row">
<div class="col-lg-4 mb-4">
<div><button class="btn btn-danger" type="reset">Cancel</button>&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-primary" value="submit" style="cursor:pointer">
</div>
</div>


</div>



        <!-- /.row -->
</form>   
        <!-- /.row -->
</div>
  <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
