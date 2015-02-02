<?php 
//NEEDS DOING: build 'x' pickups into Journey (Zack send No_Of_Picups, call addPickup in loop, Generating ID's, Sending queries back

$mysqli = connect();

$type = $_POST['form_type'];
$data = $_POST['form_data'];
switch ($type) {
	case 'addTcMember':
		addTCMembers($data);
		break;

	case 'addVehicle':
		addVehicle($data);
		break;

	case 'addDriver':
		addDriver()$data;
		break;

	case 'addGroup';
		addGroup($data);
		break;

	case 'addDamageReport':
		addDamageReport($data);
		break;

	case 'addJourney':
		addJourney($data);
		break;

	case 'addPickup':
		addPickup($data);
		break;

	case 'addReturn'
		addReturn($data);
		break;

	case 'addTCJourneyMember':
		addTCJourneyMember($data);
		break;

	case 'addVehicleCheckProblem':
		addVehicleCheckProblem($data);
		break;
		
	default:
		echo json_encode("error");
		break;
}

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

function addAddress($Address){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Addresses (Address_ID, Line1, Line2, Line3, Line4, Line5, Post_Code) VALUES ?, ?, ?, ?, ?, ?, ? ;")){
		$Address_ID = mysql_result(mysql_db_query("Xgfjl56_WCT", "SELECT MAX(Address_ID) AS Last_ID FROM Addresses;"), 0, 'Last_ID') + 1;
		$statement->bind_param("issssss",$Address_ID,$Address['Line1'],$Address['Line2'],$Address['Line3'],$Address['Line4'],$Address['Line5'],$Address['Post_Code']);
		$statement->execute();
		$statement->store_result();
		return $Address_ID;
	}

}

function addVehicle($Vehicle){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Vehicles (Vehicle_ID, Nickname, Licence, Brand, Colour, Capacity_Passengers, Capacity_With_Wheelchairs, Capacity_Wheelchairs) VALUES ?, ?, ?, ?, ?, ?, ?, ? ;") ){
		$Vehicle_ID = mysql_result(mysql_db_query("Xgfjl56_WCT", "SELECT MAX(Vehicle_ID) AS Last_ID FROM Vehicles;"), 0, 'Last_ID') + 1;
		$statement->bind_param("issssiii",$Vehicle_ID,$Vehicle['Nickname'],$Vehicle['Licence'],$Vehicle['Brand'],$Vehicle['Colour'],$Vehicle['Capacity_Passengers'],$Vehicle['Capacity_With_Wheelchairs'],$Vehicle['Capacity_Wheelchairs']);
		$statement->execute();
		$statement->store_result();
	}

}


function addDriver($Driver){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Drivers (Driver_ID, fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, Is_Volunteer) VALUES ?, ?, ?, ?, ?, ?, ?, ?, ?;") ){
		$Driver_ID = mysql_result(mysql_db_query("Xgfjl56_WCT", "SELECT MAX(Driver_ID) AS Last_ID FROM Drivers;"), 0, 'Last_ID') + 1;
		$Address_ID = addAddress($Driver['Address']);
		$statement->bind_param("ississssi",$Driver_ID,$Driver['fName'],$Driver['sName'],$Address_ID,$Driver['Tel_No'],$Driver['Emergency_Name'],$Driver['Emergency_Tel'],$Driver['Emergency_Relationship'],$Driver['Is_Volunteer']);
		$statement->execute();
		$statement->store_result();
	}

}


function addDamageReport($Damage_Report){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Damage_Report (Damage_ID, Vehicle_ID, Damage_description, Date_Added, Date_Resolved) VALUES ?, ?, ?, ?, ?;") ){
		
		$query = "SELECT MAX(Vehicle_ID) AS Last_ID FROM Vehicles;";
		$result = $mysqli->query($query);
		$Damage_ID = $result + 1; 
		
		$statement->bind_param("iisss",$Damage_ID,$Damage_Report['Vehicle_ID'],$Damage_Report['Damage_description'],$Damage_Report['Date_Added'],$Damage_Report['Date_Resolved']);
		$statement->execute();
		$statement->store_result();
	}
}


function addGroup($Group){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Groups (Group_ID, Name, Address, Tel, Invoice_Email, Invoice_Address, Invoice_Tel, Emergency_Name, Emergency_Tel, Profitable, Community, 
										Social, Statutory, Charity_No, Org_Aim, Activities_Education, Activities_Recreation, Activities_Health, Activities_Religion, Activities_Social, Activities_Inclusion, 
										Activities_Other, Concerned_Physical, Concerned_Learning, Concerned_Mental_Health, Concerned_Ethnic, Concerned_Alcohol, Concerned_Drug, Concerned_HIV_AIDS, 
										Concerned_Socially_Isolated, Concerned_Dementia, Concerned_Elderly, Concerned_Pre_School, Concerned_Young, Concerned_Women, Concerned_Health, 
										Concerned_Rurally_Isolated, Concerned_Other) VALUES ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?;") ){
		
		$query = "SELECT MAX(Group_ID) AS Last_ID FROM Groups;";
		$result = $mysqli->query($query);
		$Group_ID = $result +1;

		$Address_ID1 = addAddress($Driver['Address']);
		$Address_ID2 = addAddress($Driver['Invoice_Address']);
		$statement->bind_param("isississsiiiissiiiiiisiiiiiiiiiiiiiiis",
								$Group_ID,$Group['Name'],$Address_ID1,$Group['Tel'],$Group['Invoice_Email'], $Address_ID2,$Group['Invoice_Tel'],$Group['Emergency_Name'],$Group['Emergency_Tel'], $Group['Profitable'], $Group['Community'], 
								$Group['Social'], $Group['Statutory'], $Group['Charity_No'], $Group['Org_Aim'], $Group['Activities_Education'], $Group['Activities_Recreation'], $Group['Activities_Health'], $Group['Activities_Religion'], $Group['Activities_Social'], $Group['Activities_Inclusion'],
								$Group['Activities_Other'], $Group['Concerned_Physical'], $Group['Concerned_Learning'], $Group['Concerned_Mental_Health'], $Group['Concerned_Ethnic'], $Group['Concerned_Alcohol'], $Group['Concerned_Drug'], $Group['Concerned_HIV_AIDS'], 
								$Group['Concerned_Socially_Isolated'], $Group['Concerned_Dementia'], $Group['Concerned_Elderly'], $Group['Concerned_Pre_School'], $Group['Concerned_Young'], $Group['Concerned_Women'], $Group['Concerned_Health'], 
								$Group['Concerned_Rurally_Isolated'], $Group['Concerned_Other']);
		$statement->execute();
		$statement->store_result();
	}
}

function addJourney($Journey){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Journeys (Journey_ID, Booking_Date, fName, sName, Address_ID, Tel_No, Group_ID, Jouney_Date, Destination, Return_Time,
										No_Passengers, Passengers_Note, Wheelchairs, Transferees, Other_Access, Booked_By, Driver_ID, Vehicle, 
										Keys_To_Collect, Quote, Invoice_Sent, Invoice_Paid) VALUES ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?;") ){
		
		$query = "SELECT MAX(Journey_ID) AS Last_ID FROM Journeys;";
		$result = $mysqli->query($query);
		$Journey_ID = $result + 1;

		$Address_ID1 = addAddress($Journey['Address']);
		$Address_ID2 = addAddress($Driver['Destination']);
		$statement->bind_param("isssisisisisiisssssdss",
								$Journey_ID,$Journey['Booking_Date'],$Journey['fName'],$Journey['sName'], $Address_ID1,$Journey['Tel_No'],$Journey['Group_ID'],$Journey['Jouney_Date'], $Address_ID2, $Journey['Return_Time'], 
								$Journey['No_Passengers'], $Journey['Passengers_Note'], $Journey['Wheelchairs'], $Journey['Transferees'], $Journey['Other_Access'], $Journey['Booked_By'], $Journey['Driver_ID'], $Journey['Vehicle'], 
								$Journey['Keys_To_Collect'], $Journey['Quote'], $Journey['Invoice_Sent'], $Journey['Invoice_Paid']);
		$statement->execute();
		$statement->store_result();
	}
}


function addPickup($Pickup){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Pickups (Pickup_ID, Journey_ID, Address_ID) VALUES ?, ?, ?;") ){
		
		$query = "SELECT MAX(Pickup_ID) AS Last_ID FROM Pickups;";
		$result = $mysqli->query($query);
		$Pickup_ID = $result + 1;


function addTCMember($TC_Member){

	if( $statement = $mysqli->prepare("INSERT INTO TC_Members (TC_Member_ID, fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, DOB,
										Details_Wheelchair, Details_Wheelchair_Type, Details_Wheelchair_Seat, Details_Scooter, Details_Mobility_Aid, Details_Shopping_Trolley, 
										Details_Guide_Dog, Details_People_Carrier, Details_Assistant, Details_Travelcard, Reasons_Transport, Reasons_Bus_Stop, Reasons_Anxiety,
										Reasons_Door, Reasons_Handrails, Reasons_Lift, Reasons_Level_Floors, Reasons_Low_Steps, Reasons_Assistance, Reasons_Board_Time,
										Reasons_Wheelchair_Access, Reasons_Other) VALUES ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?;") ){
		$TC_Member_ID = mysql_result(mysql_db_query("Xgfjl56_WCT", "SELECT MAX(TC_Member_ID) AS Last_ID FROM TC_Members;"), 0, 'Last_ID') + 1;
		$Address_ID = addAddress($TC_Member['Address']);
		$statement->bind_param("ississsssssssssssssiiiiiiiiiiis",
								$TC_Member_ID,$TC_Member['fName'],$TC_Member['sName'], $Address_ID,$TC_Member['Tel_No'],$TC_Member['Emergency_Name'],$TC_Member['Emergency_Tel'], $TC_Member['Emergency_Relationship'], $TC_Member['DOB'],
								$TC_Member['Details_Wheelchair'], $TC_Member['Details_Wheelchair_Type'], $TC_Member['Details_Wheelchair_Seat'], $TC_Member['Details_Scooter'], $TC_Member['Details_Mobility_Aid'], $TC_Member['Details_Shopping_Trolley'], 
								$TC_Member['Details_Guide_Dog'], $TC_Member['Details_People_Carrier'], $TC_Member['Invoice_Sent'], $TC_Member['Details_Travelcard'],$TC_Member['Reasons_Transport'],$TC_Member['Reasons_Bus_Stop'],$TC_Member['Reasons_Anxiety'],
								$TC_Member['Reasons_Door'],$TC_Member['Reasons_Handrails'],$TC_Member['Reasons_Lift'],$TC_Member['Reasons_Level_Floors'],$TC_Member['Reasons_Low_Steps'], $TC_Member['Reasons_Assistance'], $TC_Member['Reasons_Board_Time'],
								$TC_Member['Reasons_Wheelchair_Access'], $TC_Member['Reasons_Other'] );
		$statement->execute();
		$statement->store_result();
	}
	echo json_encode('success12345');
	

	$Address_ID = addAddress($Pickup['Address']);
	$statement->bind_param("iii",$Pickup_ID,$Pickup['Journey_ID'],$Address_ID);
	$statement->execute();
	$statement->store_result();
	}



function addReturn($Return){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Returns (Return_ID, Journey_ID, Address_ID) VALUES ?, ?, ?;") ){

		$query = "SELECT MAX(Return_ID) AS Last_ID FROM Returns;";
		$result = $mysqli->query($query);
		$Return_ID = $result+1;

		$Address_ID = addAddress($Return['Address']);
		$statement->bind_param("iii",$Return_ID,$Return['Journey_ID'],$Address_ID);
		$statement->execute();
		$statement->store_result();
	}
}

function addTCMember($TC_Member){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO TC_Members (TC_Member_ID, fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, DOB,
										Details_Wheelchair, Details_Wheelchair_Type, Details_Wheelchair_Seat, Details_Scooter, Details_Mobility_Aid, Details_Shopping_Trolley, 
										Details_Guide_Dog, Details_People_Carrier, Details_Assistant, Details_Travelcard, Reasons_Transport, Reasons_Bus_Stop, Reasons_Anxiety,
										Reasons_Door, Reasons_Handrails, Reasons_Lift, Reasons_Level_Floors, Reasons_Low_Steps, Reasons_Assistance, Reasons_Board_Time,
										Reasons_Wheelchair_Access, Reasons_Other) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") ){
		
		$query = "SELECT MAX(TC_Member_ID) AS Last_ID FROM TC_Members;";
		$result = $mysqli->query($query);
		$TC_Member_ID = $result +1;
		
		$Address_ID = addAddress($TC_Member['Address']);
		$statement->bind_param('ississsssssssssssssiiiiiiiiiiis',
								$TC_Member_ID,$TC_Member['fName'],$TC_Member['sName'], $Address_ID,$TC_Member['Tel_No'],$TC_Member['Emergency_Name'],$TC_Member['Emergency_Tel'], $TC_Member['Emergency_Relationship'], $TC_Member['DOB'],
								$TC_Member['Details_Wheelchair'], $TC_Member['Details_Wheelchair_Type'], $TC_Member['Details_Wheelchair_Seat'], $TC_Member['Details_Scooter'], $TC_Member['Details_Mobility_Aid'], $TC_Member['Details_Shopping_Trolley'], 
								$TC_Member['Details_Guide_Dog'], $TC_Member['Details_People_Carrier'], $TC_Member['Invoice_Sent'], $TC_Member['Details_Travelcard'],$TC_Member['Reasons_Transport'],$TC_Member['Reasons_Bus_Stop'],$TC_Member['Reasons_Anxiety'],
								$TC_Member['Reasons_Door'],$TC_Member['Reasons_Handrails'],$TC_Member['Reasons_Lift'],$TC_Member['Reasons_Level_Floors'],$TC_Member['Reasons_Low_Steps'], $TC_Member['Reasons_Assistance'], $TC_Member['Reasons_Board_Time'],
								$TC_Member['Reasons_Wheelchair_Access'], $TC_Member['Reasons_Other'] );
		$statement->execute();
		$statement->store_result();
	}
	else {
		/* Error */
		printf("Prepared Statement Error: %s\n", $mysqli->error);
		}
}

function addTCJourneyMember($TC_Journey_Members){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO TCJourneyMember (Journey_ID, TC_Member_ID) VALUES ?, ?;") ){
		$statement->bind_param("ii",$TC_Journey_Members['Journey_ID'],$TCJourneyMember['TC_Member_ID']);
		$statement->execute();
		$statement->store_result();
	}
}


function addVehicleCheckProblem($Vehicle_Check_Problem){
	$mysqli = connect();

	if( $statement = $mysqli->prepare("INSERT INTO Vehicle_Check_Problems (Vehicle_ID, Problem_Description) VALUES ?, ?;") ){
		$statement->bind_param("is",$TCJourneyMember['Vehicle_ID'],$TCJourneyMember['Problem_Description']);
		$statement->execute();
		$statement->store_result();
	}
}
?>