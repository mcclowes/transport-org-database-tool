<?php 


$mysqli = connect();

$type = $_POST['form_type'];
$data = $_POST['form_data'];
switch ($type) {
	case 'addTcMember':
		addTCMember($mysqli,$data);
		break;

	case 'addVehicle':
		addVehicle($mysqli,$data);
		break;

	case 'addDriver':
		addDriver($mysqli,$data);
		break;

	case 'addGroup';
		addGroup($mysqli,$data);
		break;

	case 'addDamageReport':
		addDamageReport($mysqli,$data);
		break;

	case 'addJourney':
		$Journey_ID = addJourney($mysqli,$data);
		$x = $data['Pickups']['No_Pickups']; 
		$Y = $data['Returns']['No_Returns']; 

		for ($xx = 0; $xx <= $x; $xx++){
			addPickup($mysqli,$Journey_ID, $data['Pickups'][$xx]);
		}

		for ($yy = 0; $yy <= $y; $yy++){
			addReturn($mysqli, $Journey_ID, $data[$Return][$yy]);
		}

		break;

	case 'addTCJourneyMember':
		addTCJourneyMember($mysqli,$data);
		break;

	case 'addVehicleCheckProblem':
		addVehicleCheckProblem($mysqli,$data);
		break;
	
	case 'getJourneys':
		getJourneys();
	default:
		echo json_encode("error");
		break;

}
echo json_encode("Success! ed");
//Connects to the database storing questions etc.

function connect(){
	$servername = "mysql.dur.ac.uk";
	$dbname = "Xgfjl56_WCT";
	$user = "gfjl56";
	$pass = "houston3";
	// Create connection
	$conn = new mysqli($servername, $user, $pass, $dbname);
	// Check connection
	if ($conn->connect_error) 
		{die("Connection failed: " . $conn->connect_error);}

	return $conn;
}


function getVehicles($mysqli){}
function getDrivers($mysqli){}
function getDamageReports($mysqli){}
function getGroups($mysqli){}
function getJourneys($mysqli){}
function getJourneyMembers($mysqli,$Journey_ID){}
function getTCMembers($mysqli){}
function getPickups($mysqli,$Journey_ID){}
function getReturns($mysqli,$Journey_ID){}
function getVehicleCheckProblems($mysqli){}


 
function addAddress($mysqli,$Address){
	
	print_r($Address);

	if( $statement = $mysqli->prepare("INSERT INTO Addresses (Line1, Line2, Line3, Line4, Line5, Post_Code) VALUES  (?, ?, ?, ?, ?, ?);")){
		
		$statement->bind_param("ssssss",$Address['Line1'],$Address['Line2'],$Address['Line3'],$Address['Line4'],$Address['Line5'],$Address['Post_Code']);

		$statement->execute();
	}
	if($statement = $mysqli->prepare(" SELECT MAX(Address_ID) FROM Addresses;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Address_ID);
		$statement->fetch();

		
		return $Address_ID;
	}

}

function addVehicle($mysqli,$Vehicle){

	if( $statement = $mysqli->prepare("INSERT INTO Vehicles ( Nickname, Licence, Brand, Colour, Capacity_Passengers, Capacity_With_Wheelchairs, Capacity_Wheelchairs) VALUES ( ?, ?, ?, ?, ?, ?, ?);") ){

		$statement->bind_param("ssssiii",$Vehicle['Nickname'],$Vehicle['Licence'],$Vehicle['Brand'],$Vehicle['Colour'],$Vehicle['Capacity_Passengers'],$Vehicle['Capacity_With_Wheelchairs'],$Vehicle['Capacity_Wheelchairs']);
		$statement->execute();
		$statement->store_result();
	}

}


function addDriver($mysqli,$Driver){
	$Address_ID = addAddress($mysqli,$Driver['Address']);
	
	if( $statement = $mysqli->prepare("INSERT INTO Drivers (fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, Is_Volunteer) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?);") ){
		
		$statement->bind_param("ssissssi",$Driver['fName'],$Driver['sName'],$Address_ID,$Driver['Tel_No'],$Driver['Emergency_Name'],$Driver['Emergency_Tel'],$Driver['Emergency_Relationship'],$Driver['Is_Volunteer']);
		$statement->execute();
		$statement->store_result();
		
		print_r($statement);
	}

}


function addDamageReport($mysqli,$Damage_Report){


	if( $statement = $mysqli->prepare("INSERT INTO Damage_Reports (Vehicle_ID, Damage_description, Date_Added, Date_Resolved) VALUES ( ?, ?, ?, ?);") ){

		$statement->bind_param("isss",$Damage_Report['Vehicle_ID'],$Damage_Report['Damage_description'],$Damage_Report['Date_Added'],$Damage_Report['Date_Resolved']);
		$statement->execute();
		$statement->store_result();
	}
}


function addGroup($mysqli,$Group){

	$Address_ID1 = addAddress($mysqli,$Group['Address']);
	$Address_ID2 = addAddress($mysqli,$Group['Invoice_Address']);

	if( $statement = $mysqli->prepare("INSERT INTO Groups ( Name, Address, Tel, Invoice_Email, Invoice_Address, Invoice_Tel, Emergency_Name, Emergency_Tel, Profitable, Community, 
										Social, Statutory, Charity_No, Org_Aim, Activities_Education, Activities_Recreation, Activities_Health, Activities_Religion, Activities_Social, Activities_Inclusion, 
										Activities_Other, Concerned_Physical, Concerned_Learning, Concerned_Mental_Health, Concerned_Ethnic, Concerned_Alcohol, Concerned_Drug, Concerned_HIV_AIDS, 
										Concerned_Socially_Isolated, Concerned_Dementia, Concerned_Elderly, Concerned_Pre_School, Concerned_Young, Concerned_Women, Concerned_Health, 
										Concerned_Rurally_Isolated, Concerned_Other) VALUES ( ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?);") ){


		$statement->bind_param("sississsiiiissiiiiiisiiiiiiiiiiiiiiis",
								$Group['Name'],$Address_ID1,$Group['Address_Tel'],$Group['Invoice_Email'], $Address_ID2,$Group['Invoice_Tel'],$Group['Emergency_Name'],$Group['Emergency_Tel'], $Group['Profitable'], $Group['Community'], 
								$Group['Social'], $Group['Statutory'], $Group['Charity_No'], $Group['Org_Aim'], $Group['Activities_Education'], $Group['Activities_Recreation'], $Group['Activities_Health'], $Group['Activities_Religion'], $Group['Activities_Social'], $Group['Activities_Inclusion'],
								$Group['Activities_Other'], $Group['Concerned_Physical'], $Group['Concerned_Learning'], $Group['Concerned_Mental_Health'], $Group['Concerned_Ethnic'], $Group['Concerned_Alcohol'], $Group['Concerned_Drug'], $Group['Concerned_HIV_AIDS'], 
								$Group['Concerned_Socially_Isolated'], $Group['Concerned_Dementia'], $Group['Concerned_Elderly'], $Group['Concerned_Pre_School'], $Group['Concerned_Young'], $Group['Concerned_Women'], $Group['Concerned_Health'], 
								$Group['Concerned_Rurally_Isolated'], $Group['Concerned_Other']);
		$statement->execute();
		$statement->store_result();
	}
}

function addJourney($mysqli,$Journey){

		$Address_ID1 = addAddress($mysqli,$Journey['Address']);
		$Address_ID2 = addAddress($mysqli,$Driver['Destination']);

	if( $statement = $mysqli->prepare("INSERT INTO Journeys ( Booking_Date, fName, sName, Address_ID, Tel_No, Group_ID, Jouney_Date, Destination, Return_Time,
										No_Passengers, Passengers_Note, Wheelchairs, Transferees, Other_Access, Booked_By, Driver_ID, Vehicle, 
										Keys_To_Collect, Quote, Invoice_Sent, Invoice_Paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);") ){

		$statement->bind_param("sssisisisisiisssssdss",
								$Journey['Booking_Date'],$Journey['fName'],$Journey['sName'], $Address_ID1,$Journey['Tel_No'],$Journey['Group_ID'],$Journey['Jouney_Date'], $Address_ID2, $Journey['Return_Time'], 
								$Journey['No_Passengers'], $Journey['Passengers_Note'], $Journey['Wheelchairs'], $Journey['Transferees'], $Journey['Other_Access'], $Journey['Booked_By'], $Journey['Driver_ID'], $Journey['Vehicle'], 
								$Journey['Keys_To_Collect'], $Journey['Quote'], $Journey['Invoice_Sent'], $Journey['Invoice_Paid']);
		$statement->execute();
		$statement->store_result();
		return Journey_ID;
	}
}





function addTCMember($mysqli,$TC_Member){

	$Address_ID = addAddress($mysqli,$TC_Member['Address']);

	if( $statement = $mysqli->prepare("INSERT INTO TC_Members ( fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, DOB,
										Details_Wheelchair, Details_Wheelchair_Type, Details_Wheelchair_Seat, Details_Scooter, Details_Mobility_Aid, Details_Shopping_Trolley, 
										Details_Guide_Dog, Details_People_Carrier, Details_Assistant, Details_Travelcard, Reasons_Transport, Reasons_Bus_Stop, Reasons_Anxiety,
										Reasons_Door, Reasons_Handrails, Reasons_Lift, Reasons_Level_Floors, Reasons_Low_Steps, Reasons_Assistance, Reasons_Board_Time,
										Reasons_Wheelchair_Access, Reasons_Other) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") ){

		$statement->bind_param('ssisssssssssssssssiiiiiiiiiiis',
								$TC_Member['fName'],$TC_Member['sName'], $Address_ID,$TC_Member['Tel_No'],$TC_Member['Emergency_Name'],$TC_Member['Emergency_Tel'], $TC_Member['Emergency_Relationship'], $TC_Member['DOB'],
								$TC_Member['Details_Wheelchair'], $TC_Member['Details_Wheelchair_Type'], $TC_Member['Details_Wheelchair_Seat'], $TC_Member['Details_Scooter'], $TC_Member['Details_Mobility_Aid'], $TC_Member['Details_Shopping_Trolley'], 
								$TC_Member['Details_Guide_Dog'], $TC_Member['Details_People_Carrier'], $TC_Member['Details_Assistant'], $TC_Member['Details_Travelcard'],$TC_Member['Reasons_Transport'],$TC_Member['Reasons_Bus_Stop'],$TC_Member['Reasons_Anxiety'],
								$TC_Member['Reasons_Door'],$TC_Member['Reasons_Handrails'],$TC_Member['Reasons_Lift'],$TC_Member['Reasons_Level_Floors'],$TC_Member['Reasons_Low_Steps'], $TC_Member['Reasons_Assistance'], $TC_Member['Reasons_Board_Time'],
								$TC_Member['Reasons_Wheelchair_Access'], $TC_Member['Reasons_Other'] );

		

		$statement->execute();
		$statement->store_result();
		
	}
}

function addPickup($mysqli,$Journey_ID,$Pickup){

	$Address_ID = addAddress($mysqli,$Pickup['Address']);

	if( $statement = $mysqli->prepare("INSERT INTO Pickups ( Journey_ID, Address_ID, Time) VALUES ( ?, ?, ?);") ){

		$statement->bind_param("iis",$Journey_ID,$Address_ID,$Pickup['Time']);
		$statement->execute();
		$statement->store_result();
	}
}


function addReturn($mysqli,$Journey_ID,$Return){

	$Address_ID = addAddress($mysqli,$Return['Address']);

	if( $statement = $mysqli->prepare("INSERT INTO Returns ( Journey_ID, Address_ID) VALUES ( ?, ?);") ){

		$statement->bind_param("ii", $Journey_ID, $Address_ID);
		$statement->execute();
		$statement->store_result();
	}
}



function addTCJourneyMember($mysqli,$TC_Journey_Members){

	if( $statement = $mysqli->prepare("INSERT INTO TCJourneyMember (Journey_ID, TC_Member_ID) VALUES (?, ?);") ){
		$statement->bind_param("ii",$TC_Journey_Members['Journey_ID'],$TCJourneyMember['TC_Member_ID']);
		$statement->execute();
		$statement->store_result();
	}
}


function addVehicleCheckProblem($mysqli,$Vehicle_Check_Problem){

	if( $statement = $mysqli->prepare("INSERT INTO Vehicle_Check_Problems (Vehicle_ID, Problem_Description) VALUES (?, ?);") ){
		$statement->bind_param("is",$TCJourneyMember['Vehicle_ID'],$TCJourneyMember['Problem_Description']);
		$statement->execute();
		$statement->store_result();
	}
}
?>