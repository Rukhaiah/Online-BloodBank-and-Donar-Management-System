<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$fullname=$_POST['fullname'];
$mobile=$_POST['mobileno'];
$email=$_POST['emailid'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$blodgroup=$_POST['bloodgroup'];
$message=$_POST['message'];
$status=1;
$state=$_POST['state'];
$district=$_POST['district'];
$sql="INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Message,status,State,District) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:message,:status,:state,:district)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':blodgroup',$blodgroup,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':district',$district,PDO::PARAM_STR);   
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Your info submitted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}


	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>BBDMS| Admin Add Donor</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
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
<script language="javascript">
function isNumberKey(evt)
      {
         
        var charCode = (evt.which) ? evt.which : event.keyCode
                
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
           return false;

         return true;
      }
      </script>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add Donor</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="fullname" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Mobile No<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="mobileno" onKeyPress="return isNumberKey(event)"  maxlength="10" class="form-control" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Email id<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="email" name="emailid" class="form-control">
</div>
<label class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="age" class="form-control" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Gender <span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="gender" class="form-control" required>
<option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
<label class="col-sm-2 control-label">Blood Group<span style="color:red">*</span></label>
<div class="col-sm-4">


<select name="bloodgroup" class="form-control" required>
<option value="">Select</option>
<?php $sql = "SELECT * from  tblbloodgroup ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
<option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
<?php }} ?>
</select>

</div>
</div>


											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Choose a State<span style="color:red">*</span></label>
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
 <label class="col-sm-2 control-label">Choose a District<span style="color:red">*</span></label>
 <select id="districts" style="height: 40px; width: 600px;">
    <option value="">Select a District</option>
  </select>

  <script>
    function populateDistricts() {
      var stateDropdown = document.getElementById("states");
      var districtDropdown = document.getElementById("districts");
      var selectedState = stateDropdown.value;
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
<br>
</div>


<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Message<span style="color:red"></span></label>
<div class="col-sm-10">
<textarea class="form-control" name="message" required> </textarea>
</div>
</div>


 <input type="hidden" id="state" name="state">
    <input type="hidden" id="district" name="district">
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-5">
												<div class="col-lg-8 mb-8">
													<button class="btn btn-danger" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Submit</button></div>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>