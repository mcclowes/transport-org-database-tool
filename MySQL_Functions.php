<?php 
#delete functions,

$mysqli = connect();

if (isset($_POST['form_type'])) {
	$type = $_POST['form_type'];
}
if (isset($_POST['form_data'])) {
	$data = $_POST['form_data'];
}


switch ($type) {
	case 'addAddress': 
		$rdata = addTCMember($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addVehicle': 
		$rdata = addVehicle($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addDriver': 
		$rdata = addDriver($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addDamageReport': 
		$rdata = addDamageReport($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addGroup': 
		$rdata = addGroup($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addJourney': 
		$Journey_ID = addJourney($mysqli,$data);
		$x = $data['Pickups']['No_Pickups']; 

		for ($xx = 1; $xx <= $x; $xx++){
			addPickup($mysqli,$Journey_ID, $data['Pickups'][$xx]);
		}
		echo json_encode('success!');
		break;

	case 'addTCMember': 
		$rdata = addTCMember($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addPickup': 
		$rdata = addTCMember($mysqli,$data); 
		echo json_encode($rdata);
		break;

	case 'addTCJourneyMember': 
		addTCJourneyMember($mysqli,$data); 
		break;

	case 'addVehicleCheckProblem': 
		addVehicleCheckProblem($mysqli,$data);
		 break;

	case 'getAddresses': 
		$rdata = getAddresses($mysqli);
		echo json_encode($rdata);
		break;

	case 'getPostCodeAddress':
		$rdata = getPostCodeAddress($mysqli,$data['Post_Code']);
		echo json_encode($rdata);
		break;

	case 'getAddress': 
		$rdata = getAddress($mysqli,$data['Address_ID']);
		echo json_encode($rdata);
		break;

	case 'getVehicles': 
		$rdata = getVehicles($mysqli);
		echo json_encode($rdata);
		break;

	case 'getVehicle': 
		$rdata = getVehicle($mysqli,$data['Vehicle_ID']);
		echo json_encode($rdata);
		break;

	case 'getDrivers': 
		$rdata = getDrivers($mysqli);
		echo json_encode($rdata);
		break;

	case 'getDriver': 
		$rdata = getDriver($mysqli,$data['Driver_ID']);
		echo json_encode($rdata);
		break;

	case 'getDamageReports': 
		$rdata = getDamageReports($mysqli);
		echo json_encode($rdata);
		break;

	case 'getVehicleDamageReports': 
		$rdata = getVehicleDamageReports($mysqli,$data['Vehicle_ID']);
		echo json_encode($rdata);
		break;

	case 'getGroups': 
		$rdata = getGroups($mysqli);
		echo json_encode($rdata);
		break;

	case 'getGroup': 
		$rdata = getGroup($mysqli,$data['Group_ID']);
		echo json_encode($rdata);
		break;

	case 'getJourneys': 
		$rdata = getJourneys($mysqli);
		echo json_encode($rdata);
		break;

	case 'getGroupJourneys': 
		$rdata = getGroupJourneys($mysqli);
		echo json_encode($rdata);
		break;

	case 'getTCJourneys': 
		$rdata = getTCJourneys($mysqli);
		echo json_encode($rdata);
		break;

	case 'getJourney': 
		$rdata = getJourney($mysqli, $data['Journey_ID']);
		echo json_encode($rdata);
		break;

	case 'getJourneyMembers':
		$rdata = getJourneyMembers($mysqli,$data['Journey_ID']);
		echo json_encode($rdata);
		break;

	case 'getTCMember':
		$rdata = getTCMember($mysqli,$data['TC_Member_ID']);
		echo json_encode($rdata);
		break;

	case 'getTCMembers':
		$rdata = getTCMembers($mysqli);
		echo json_encode($rdata);
		break;

	case 'getPickups':
		$rdata = getPickups($mysqli,$data['Journey_ID']);
		echo json_encode($rdata);
		break;

	case 'getVehicleCheckProblems':
		$rdata = getVehicleCheckProblems($mysqli);
		echo json_encode($rdata);
		break;

	case 'updateDamageReport': 
		$rdata = updateDamageReport($mysqli, $data['Date_Resolved'], $data['Damage_ID']);
		echo json_encode($rdata); 
		break;

	case 'editJourney':
		$rdata = editJourney($mysqli,$data);
		echo json_encode($rdata);
		break;

	case 'deleteJourney':
		$rdata = deleteJourney($mysqli,$data);
		echo json_encode($rdata);
		break;

	case 'deleteTCMember':
		$rdata = deleteTCMember($mysqli,$data);
		echo json_encode($rdata);
		break;


	case 'deleteVehicle':
		$rdata = deleteVehicle($mysqli,$data);
		echo json_encode($rdata);
		break;

	case 'deleteGroup':
		$rdata = deleteGroup($mysqli,$data);
		echo json_encode($rdata);
		break;

	case 'deleteDriver':
		$rdata = deleteDriver($mysqli,$data);
		echo json_encode($rdata);
		break;

	default:
	 	echo json_encode("error");
		break;

}


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


function outputDate($data){
	$s = str_split($data);
	$date = "$s[8]"."$s[9]"."/"."$s[5]"."$s[6]"."/"."$s[0]"."$s[1]"."$s[2]"."$s[3]";
	return $date;
}

function inputDate($data){
	$s = str_split($data);
	$date = "$s[6]"."$s[7]"."$s[8]"."$s[9]"."-"."$s[3]"."$s[4]"."-"."$s[0]"."$s[1]";
	return $date;
}

function getAddress($mysqli, $Address_ID){
	$Address = array();
	$i = 0;
	if($statement = $mysqli->prepare(" SELECT Line1, Line2, Line3, Line4, Line5, Post_Code FROM  Addresses WHERE Address_ID = ? ;")){
		$statement->bind_param("i", $Address_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Address['Line1'],$Address['Line2'],$Address['Line3'],$Address['Line4'],$Address['Line5'],$Address['Post_Code']);
		$statement->fetch();
	}
	return $Address;
}

function getPostCodeAddress($mysqli, $Search_Code){
	$Addresses = array();
	$Address = array();

	if($statement = $mysqli->prepare(" SELECT Address_ID, Line1, Line2, Line3, Line4, Line5, Post_Code FROM  Addresses WHERE Post_Code = ?;")){
		$statement->bind_param("i", $Search_Code);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Address_ID,$Line1,$Line2,$Line3,$Line4,$Line5,$Post_Code);
		while($statement->fetch()){

			$Address['Address_ID'] = $Address_ID;
			$Address['Line1'] = $Line1;
			$Address['Line2'] = $Line2;
			$Address['Line3'] = $Line3;
			$Address['Line4'] = $Line4;
			$Address['Line5'] = $Line5;
			$Address['Post_Code'] = $Post_Code;

			array_push($Addresses, $Address);
		}

	}
	return $Addresses;
}

function getAddresses($mysqli){
	$Addresses = array();
	$Address = array();

	if($statement = $mysqli->prepare(" SELECT Address_ID, Line1, Line2, Line3, Line4, Line5, Post_Code FROM  Addresses;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Address_ID,$Line1,$Line2,$Line3,$Line4,$Line5,$Post_Code);
		while($statement->fetch()){

			$Address['Address_ID'] = $Address_ID;
			$Address['Line1'] = $Line1;
			$Address['Line2'] = $Line2;
			$Address['Line3'] = $Line3;
			$Address['Line4'] = $Line4;
			$Address['Line5'] = $Line5;
			$Address['Post_Code'] = $Post_Code;

			array_push($Addresses, $Address);
		}

	}
	return $Addresses;
}

function getVehicles($mysqli){	
	$Vehicles = array();
	$Vehicle = array();

	if($statement = $mysqli->prepare(" SELECT Vehicle_ID, Nickname, Registration, Make, Model, Colour, Capacity_Passengers, Tax_Due, MOT_Due, Inspection_Due,
										 Service_Due, Tail_Service_Due, Section_19_No, Section_19_Due, Seating_Configurations FROM  Vehicles;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Vehicle_ID, $Nickname,$Registration,$Make,$Model,$Colour,$Capacity_Passengers,$Tax_Due,$MOT_Due,$Inspection_Due,
								$Service_Due, $Tail_Service_Due, $Section_19_No, $Section_19_Due, $Seating_Configurations);
		while($statement->fetch()){


			$Vehicle['Vehicle_ID'] = $Vehicle_ID;
			$Vehicle['Nickname'] = $Nickname;
			$Vehicle['Registration'] = $Registration;
			$Vehicle['Make'] = $Make;
			$Vehicle['Model'] = $Model;
			$Vehicle['Colour'] = $Colour;
			$Vehicle['Capacity_Passengers'] = $Capacity_Passengers;
			$Vehicle['Section_19_No'] = $Section_19_No;
			$Vehicle['Seating_Configurations'] = $Seating_Configurations;

			$Vehicle['Tax_Due'] = outputDate($Tax_Due);
			$Vehicle['MOT_Due'] = outputDate($MOT_Due);
			$Vehicle['Inspection_Due'] = outputDate($Inspection_Due);
			$Vehicle['Service_Due'] = outputDate($Service_Due);
			$Vehicle['Tail_Service_Due'] = outputDate($Tail_Service_Due);
			$Vehicle['Section_19_Due'] = outputDate($Section_19_Due);

			array_push($Vehicles, $Vehicle);
		}
	}	
	return $Vehicles;	
}

function getVehicle($mysqli, $Vehicle_ID){	

	if($statement = $mysqli->prepare(" SELECT Nickname, Registration, Make, Model, Colour, Capacity_Passengers, Tax_Due, MOT_Due, Inspection_Due,
										 Service_Due, Tail_Service_Due, Section_19_No, Section_19_Due, Seating_Configurations FROM  Vehicles WHERE Vehicle_ID = ?;")){
		$statement->bind_param('i',$Vehicle_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Nickname,$Registration,$Make,$Model,$Colour,$Capacity_Passengers,$Tax_Due,$MOT_Due,$Inspection_Due,
								$Service_Due, $Tail_Service_Due, $Section_19_No, $Section_19_Due, $Seating_Configurations);
		while($statement->fetch()){

			$Vehicle['Nickname'] = $Nickname;
			$Vehicle['Registration'] = $Registration;
			$Vehicle['Make'] = $Make;
			$Vehicle['Model'] = $Model;
			$Vehicle['Colour'] = $Colour;
			$Vehicle['Capacity_Passengers'] = $Capacity_Passengers;
			$Vehicle['Section_19_No'] = $Section_19_No;
			$Vehicle['Seating_Configurations'] = $Seating_Configurations;

			$Vehicle['Tax_Due'] = outputDate($Tax_Due);
			$Vehicle['MOT_Due'] = outputDate($MOT_Due);
			$Vehicle['Inspection_Due'] = outputDate($Inspection_Due);
			$Vehicle['Service_Due'] = outputDate($Service_Due);
			$Vehicle['Tail_Service_Due'] = outputDate($Tail_Service_Due);
			$Vehicle['Section_19_Due'] = outputDate($Section_19_Due);

		}
	}	
	return $Vehicle;
}

function getDrivers($mysqli){
	$Drivers = array();
	$Driver = array();
	if($statement = $mysqli->prepare(" SELECT Driver_ID, fName, sName, Address_ID, Tel_No, Mobile_No, DOB, Licence_No, Licence_Expires, Licence_Points, DBS_No, DBS_Issued, 
										Emergency_Name, Emergency_Tel, Emergency_Relationship, Is_Volunteer FROM  Drivers ;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Driver_ID, $fName, $sName, $Address_ID, $Tel_No, $Mobile_No, $DOB, $Licence_No, $Licence_Expires, $Licence_Points, $DBS_No, $DBS_Issued, 
										$Emergency_Name, $Emergency_Tel, $Emergency_Relationship, $Is_Volunteer);
		while($statement->fetch()){
			$Driver['Driver_ID'] = $Driver_ID;
			$Driver['fName'] = $fName;
			$Driver['sName'] = $sName;
			$Driver['Address'] = getAddress($mysqli, $Address_ID);
			$Driver['Tel_No'] = $Tel_No;
			$Driver['Mobile_No'] = $Mobile_No;
			$Driver['Licence_No'] = $Licence_No;
			$Driver['Licence_Points'] =  $Licence_Points;
			$Driver['DBS_No'] = $DBS_No;
			$Driver['Emergency_Name'] = $Emergency_Name;
			$Driver['Emergency_Tel'] = $Emergency_Tel;
			$Driver['Emergency_Relationship'] = $Emergency_Relationship;
			$Driver['Is_Volunteer'] = $Is_Volunteer;

			$Driver['DOB'] = outputDate($DOB);
			$Driver['Licence_Expires'] = outputDate($Licence_Expires);
			$Driver['DBS_Issued'] = outputDate($DBS_Issued);

			array_push($Drivers, $Driver);
		}

	}
	return $Drivers;
}

function getDriver($mysqli, $Driver_ID){
	if($statement = $mysqli->prepare(" SELECT fName, sName, Address_ID, Tel_No, Mobile_No, DOB, Licence_No, Licence_Expires, Licence_Points, DBS_No, DBS_Issued, 
										Emergency_Name, Emergency_Tel, Emergency_Relationship, Is_Volunteer FROM  Drivers WHERE Driver_ID = ?;")){
		$statement->bind_param('i',$Driver_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($fName, $sName, $Address_ID, $Tel_No, $Mobile_No, $DOB, $Licence_No, $Licence_Expires, $Licence_Points, $DBS_No, $DBS_Issued, 
										$Emergency_Name, $Emergency_Tel, $Emergency_Relationship, $Is_Volunteer);
		while($statement->fetch()){
			$Driver['fName'] = $fName;
			$Driver['sName'] = $sName;
			$Driver['Address'] = getAddress($mysqli, $Address_ID);
			$Driver['Tel_No'] = $Tel_No;
			$Driver['Mobile_No'] = $Mobile_No;
			$Driver['Licence_No'] = $Licence_No;
			$Driver['Licence_Points'] =  $Licence_Points;
			$Driver['DBS_No'] = $DBS_No;
			$Driver['Emergency_Name'] = $Emergency_Name;
			$Driver['Emergency_Tel'] = $Emergency_Tel;
			$Driver['Emergency_Relationship'] = $Emergency_Relationship;
			$Driver['Is_Volunteer'] = $Is_Volunteer;

			$Driver['DOB'] = outputDate($DOB);
			$Driver['Licence_Expires'] = outputDate($Licence_Expires);
			$Driver['DBS_Issued'] = outputDate($DBS_Issued);

		}

	}
	return $Driver;
}

function getDamageReports($mysqli){
	$Damage_Report = array();
	$Damage_Reports = array();

	if($statement = $mysqli->prepare(" SELECT Vehicle_ID, Damage_description, Date_Added, Date_Resolved FROM  Damage_Reports;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Vehicle_ID, $Damage_description,$Date_Added,$Date_Resolved);
		while($statement->fetch()){

			$Damage_Report['Vehicle_ID'] = $Vehicle_ID;
			$Damage_Report['Damage_description'] = $Damage_description;

			$Damage_Report['Date_Added'] = outputDate($Date_Added);
			$Damage_Report['Date_Resolved'] = outputDate($Date_Resolved);

			array_push($Damage_Reports, $Damage_Report);
		}

	}
	return $Damage_Reports;
}

function getVehicleDamageReports($mysqli,$Vehicle_ID){

	$Damage_Report = array();
	$Damage_Reports = array();

	if($statement = $mysqli->prepare(" SELECT Damage_description, Date_Added, Date_Resolved FROM  Damage_Reports WHERE Vehicle_ID = ?;")){
		$statement->bind_param('i', $Vehicle_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Damage_description,$Date_Added,$Date_Resolved);
		while($statement->fetch()){

			$Damage_Report['Damage_description'] = $Damage_description;

			$Damage_Report['Date_Added'] = outputDate($Date_Added);
			$Damage_Report['Date_Resolved'] = outputDate($Date_Resolved);

			array_push($Damage_Reports, $Damage_Report);
		}

	}
	return $Damage_Reports;
}

function getGroups($mysqli){
	$Group = array();
	$Groups = array();

	if($statement = $mysqli->prepare(" SELECT Group_ID, Name, Tel FROM  Groups;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Group_ID,$Name,$Tel);
		while($statement->fetch()){

			$Group['Group_ID'] = $Group_ID;
			$Group['Name'] = $Name;
			$Group['Tel'] = $Tel;

			array_push($Groups, $Group);
		}

	}
	return $Groups;
}

function getGroup($mysqli, $Group_ID){
	$Group = array();
	if($statement = $mysqli->prepare(" SELECT Name, Address, Tel, Invoice_Email, Invoice_Address, Invoice_Tel, Emergency_Name, Emergency_Tel, Profitable, Community, 
										Social, Statutory, Charity_No, Org_Aim, Activities_Education, Activities_Recreation, Activities_Health, Activities_Religion, Activities_Social, Activities_Inclusion, 
										Activities_Other, Concerned_Physical, Concerned_Learning, Concerned_Mental_Health, Concerned_Ethnic, Concerned_Alcohol, Concerned_Drug, Concerned_HIV_AIDS, 
										Concerned_Socially_Isolated, Concerned_Dementia, Concerned_Elderly, Concerned_Pre_School, Concerned_Young, Concerned_Women, Concerned_Health, 
										Concerned_Rurally_Isolated, Concerned_Other FROM  Groups WHERE Group_ID = ?;")){
		$statement->bind_param("i", $Group_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Group['Name'],$Address_ID1,$Group['Address_Tel'],$Group['Invoice_Email'], $Address_ID2,$Group['Invoice_Tel'],$Group['Emergency_Name'],$Group['Emergency_Tel'], $Group['Profitable'], $Group['Community'], 
								$Group['Social'], $Group['Statutory'], $Group['Charity_No'], $Group['Org_Aim'], $Group['Activities_Education'], $Group['Activities_Recreation'], $Group['Activities_Health'], $Group['Activities_Religion'], $Group['Activities_Social'], $Group['Activities_Inclusion'],
								$Group['Activities_Other'], $Group['Concerned_Physical'], $Group['Concerned_Learning'], $Group['Concerned_Mental_Health'], $Group['Concerned_Ethnic'], $Group['Concerned_Alcohol'], $Group['Concerned_Drug'], $Group['Concerned_HIV_AIDS'], 
								$Group['Concerned_Socially_Isolated'], $Group['Concerned_Dementia'], $Group['Concerned_Elderly'], $Group['Concerned_Pre_School'], $Group['Concerned_Young'], $Group['Concerned_Women'], $Group['Concerned_Health'], 
								$Group['Concerned_Rurally_Isolated'], $Group['Concerned_Other']);
		$statement->fetch();
		
		$Group['Address'] = getAddress($mysqli, $Address_ID1);
		$Group['Destination'] = getAddress($mysqli, $Address_ID2);

	}

	return $Group;
}

/*
function getJourneys($mysqli){
	$Journey = array();
	$Journeys = array();

	if($statement = $mysqli->prepare(" SELECT Journey_ID, Journey_Description, Journey_Date, Return_Time FROM  Journeys;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Journey_ID, $Journey_Description, $Journey_Date, $Return_Time);
		while($statement->fetch()){

			if($stm = $mysqli->prepare(" SELECT MIN(Time) FROM Pickups WHERE Journey_ID = ?;")){

				$stm->bind_param("i", $Journey_ID);
				$stm->execute();
				$stm->store_result();
				$stm->bind_result($Pickup_Time);
				$stm->fetch();
				}


			$Journey['Journey_ID'] = $Journey_ID;
			$Journey['Journey_Description'] = $Journey_Description;
			$Journey['Journey_Date'] = outputDate($Journey_Date);
			$Journey['Return_Time'] = $Return_Time;
			$Journey['Pickup_Time'] = $Pickup_Time;

			array_push($Journeys, $Journey);
			}
	}	
	return $Journeys;
}
*/

function getJourneys($mysqli){
	$Journeys = array();
	
	foreach (getGroupJourneys($mysqli) as $Journey) {
		array_push($Journeys, $Journey);
	}
	foreach (getTCJourneys($mysqli) as $Journey) {
		array_push($Journeys, $Journey);
	}
	
	return $Journeys;
}

function getGroupJourneys($mysqli){
	$Journey = array();
	$Journeys = array();

	if($statement = $mysqli->prepare(" SELECT Journey_ID, Journey_Description, Journey_Date, Return_Time FROM Journeys WHERE Group_ID IS NOT NULL;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Journey_ID, $Journey_Description, $Journey_Date, $Return_Time);
		while($statement->fetch()){

			if($stm = $mysqli->prepare(" SELECT MIN(Time) FROM Pickups WHERE Journey_ID = ?;")){

				$stm->bind_param("i", $Journey_ID);
				$stm->execute();
				$stm->store_result();
				$stm->bind_result($Pickup_Time);
				$stm->fetch();
				}


			$Journey['Journey_ID'] = $Journey_ID;
			$Journey['Journey_Description'] = $Journey_Description;
			$Journey['Journey_Date'] = outputDate($Journey_Date);
			$Journey['Return_Time'] = $Return_Time;
			$Journey['Pickup_Time'] = $Pickup_Time;
			$Journey['Type'] = 'Group';

			array_push($Journeys, $Journey);
			}
	}	
	return $Journeys;
}

function getTCJourneys($mysqli){
	$Journey = array();
	$Journeys = array();

	if($statement = $mysqli->prepare(" SELECT Journey_ID, Journey_Description, Journey_Date, Return_Time FROM  Journeys WHERE Group_ID IS NULL;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Journey_ID, $Journey_Description, $Journey_Date, $Return_Time);
		while($statement->fetch()){

			if($stm = $mysqli->prepare(" SELECT MIN(Time) FROM Pickups WHERE Journey_ID = ?;")){

				$stm->bind_param("i", $Journey_ID);
				$stm->execute();
				$stm->store_result();
				$stm->bind_result($Pickup_Time);
				$stm->fetch();
				}


			$Journey['Journey_ID'] = $Journey_ID;
			$Journey['Journey_Description'] = $Journey_Description;
			$Journey['Journey_Date'] = outputDate($Journey_Date);
			$Journey['Return_Time'] = $Return_Time;
			$Journey['Pickup_Time'] = $Pickup_Time;
			$Journey['Type'] = 'TC';

			array_push($Journeys, $Journey);
			}
	}	
	return $Journeys;
}

function getJourney($mysqli, $Journey_ID){
	$rdata = array();
	if($statement = $mysqli->prepare(" SELECT Journey_ID, Journey_Description, Journey_Note, Booking_Date, fName, sName, Address_ID, Tel_No, Group_ID, Journey_Date, Destination, Return_Note, Return_Time,
										No_Passengers, Passengers_Note, Wheelchairs, Transferees, Other_Access, Booked_By, Driver_ID, Vehicle, 
										Keys_To_Collect, Distance, Quote, Invoiced_Cost, Invoice_Sent, Invoice_Paid FROM  Journeys WHERE Journey_ID = ?;")){
		$statement->bind_param("i", $Journey_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($rdata['Journey_ID'], $rdata['Journey_Description'], $rdata['Journey_Note'], $rdata['Booking_Date'],$rdata['fName'],$rdata['sName'], $rdata['Address_ID'], $rdata['Tel_No'], $rdata['Group_ID'],$rdata['Journey_Date'], $rdata['Destination_ID'], $rdata['Return_Note'], $rdata['Return_Time'], 
								$rdata['No_Passengers'], $rdata['Passengers_Note'], $rdata['Wheelchairs'], $rdata['Transferees'], $rdata['Other_Access'], $rdata['Booked_By'], $rdata['Driver_ID'], $rdata['Vehicle'], 
								$rdata['Keys_To_Collect'], $rdata['Distance_Run'], $rdata['Quote'], $rdata['Invoiced_Cost'], $rdata['Invoice_Sent'], $rdata['Invoice_Paid']);
		$statement->fetch();
		$statement->close();
	}
	$rdata['Booking_Date'] = outputDate($rdata['Booking_Date']);
	$rdata['Journey_Date'] = outputDate($rdata['Journey_Date']);
	$rdata['Invoice_Sent'] = outputDate($rdata['Invoice_Sent']);
	$rdata['Invoice_Paid'] = outputDate($rdata['Invoice_Paid']);

	if(!is_null($rdata['Group_ID'])){
		$GroupDets =  getGroup($mysqli, $rdata['Group_ID']);
		$rdata['Group_Name'] = $GroupDets['Name'];
	}

	else{

		$rdata['Members'] = getJourneyMembers($mysqli,$Journey_ID);
		
	}
		
	$VehicleDets = getVehicle($mysqli,$rdata['Vehicle']);
	$rdata['Vehicle_Nickname'] = $VehicleDets['Nickname'];

	$DriverDets = getDriver($mysqli,$rdata['Driver_ID']);
	$rdata['Driver_Name'] = $DriverDets['fName'].' '.$DriverDets['sName'];


	$rdata['Address'] = getAddress($mysqli, $rdata['Address_ID']);
	$rdata['Destination'] = getAddress($mysqli, $rdata['Destination_ID']);

	$rdata['Pickups'] = getPickups($mysqli,$rdata['Journey_ID']);


	return $rdata;
}

function getJourneyMembers($mysqli,$Journey_ID){
	$JourneyMembers = array();
	$JourneyMember = array();
	$i = 0;
	if($statement = $mysqli->prepare(" SELECT TC_Member_ID FROM TC_Journey_Members WHERE Journey_ID = ?;")){
		$statement->bind_param('i', $Journey_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($TC_Member_ID);
		while($statement->fetch()){

			$JourneyMember = getTCMember($mysqli, $TC_Member_ID);

			array_push($JourneyMembers, $JourneyMember);
		}

	}
	return $JourneyMembers;
}

function getTCMember($mysqli, $TC_Member_ID){
	$TC_Member = array();
	if($statement = $mysqli->prepare(" SELECT TC_Member_ID, fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, DOB,
										Details_Wheelchair, Details_Wheelchair_Type, Details_Wheelchair_Seat, Details_Scooter, Details_Mobility_Aid, Details_Shopping_Trolley, 
										Details_Guide_Dog, Details_People_Carrier, Details_Assistant, Details_Travelcard, Reasons_Transport, Reasons_Bus_Stop, Reasons_Anxiety,
										Reasons_Door, Reasons_Handrails, Reasons_Lift, Reasons_Level_Floors, Reasons_Low_Steps, Reasons_Assistance, Reasons_Board_Time,
										Reasons_Wheelchair_Access, Reasons_Other FROM  TC_Members;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($TC_Member['TC_Member_ID'], $TC_Member['fName'],$TC_Member['sName'], $Address_ID,$TC_Member['Tel_No'],$TC_Member['Emergency_Name'],$TC_Member['Emergency_Tel'], $TC_Member['Emergency_Relationship'], $TC_Member['DOB'],
								$TC_Member['Details_Wheelchair'], $TC_Member['Details_Wheelchair_Type'], $TC_Member['Details_Wheelchair_Seat'], $TC_Member['Details_Scooter'], $TC_Member['Details_Mobility_Aid'], $TC_Member['Details_Shopping_Trolley'], 
								$TC_Member['Details_Guide_Dog'], $TC_Member['Details_People_Carrier'], $TC_Member['Details_Assistant'], $TC_Member['Details_Travelcard'],$TC_Member['Reasons_Transport'],$TC_Member['Reasons_Bus_Stop'],$TC_Member['Reasons_Anxiety'],
								$TC_Member['Reasons_Door'],$TC_Member['Reasons_Handrails'],$TC_Member['Reasons_Lift'],$TC_Member['Reasons_Level_Floors'],$TC_Member['Reasons_Low_Steps'], $TC_Member['Reasons_Assistance'], $TC_Member['Reasons_Board_Time'],
								$TC_Member['Reasons_Wheelchair_Access'], $TC_Member['Reasons_Other']);
		$statement->fetch();
		$TC_Member['Address'] = getAddress($mysqli, $Address_ID);
		$TC_Member['DOB'] = outputDate($TC_Member['DOB']);


	}
	return $TC_Member;
} 

function getTCMembers($mysqli){
	$TC_Member = array();
	$TC_Members = array();
	if($statement = $mysqli->prepare(" SELECT TC_Member_ID, fName, sName, Address_ID FROM  TC_Members;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($TC_Member_ID,$fName,$sName,$Address_ID);
		while($statement->fetch()){

			$Address = getAddress($mysqli, $Address_ID);
			
			$TC_Member['TC_Member_ID'] = $TC_Member_ID;
			$TC_Member['fName'] = $fName;
			$TC_Member['sName'] = $sName;
			$TC_Member['Post_Code'] = $Address['Post_Code'];
			

			array_push($TC_Members, $TC_Member);
		}

	}
	return $TC_Members;
}

function getPickups($mysqli,$Journey_ID){
	$Pickup = array();
	$Pickups = array();
	$No_Pickups = 0;

	if($statement = $mysqli->prepare(" SELECT Note, Address_ID, Time FROM  Pickups WHERE Journey_ID = ?;")){
		$statement->bind_param('i',$Journey_ID);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Note, $Address_ID, $Time);
		while($statement->fetch()){

			$Pickup['Note'] = $Note;
			$Pickup['Address'] = getAddress($mysqli, $Address_ID);
			$Pickup['Time'] = $Time;

			array_push($Pickups, $Pickup);
			$No_Pickups++;
		}

	}
	$Pickups['No_Pickups'] = $No_Pickups;
	return $Pickups;
}

function getVehicleCheckProblems($mysqli){	
	$Problem= array();
	$Problems = array();

	if($statement = $mysqli->prepare(" SELECT Vehicle_ID, Problem_Description FROM  Vehicle_Check_Problems ;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Vehicle_ID, $Problem_Description);
		while($statement->fetch()){

			$Problem['Vehicle_ID'] = $Vehicle_ID;
			$Problem['Problem_Description'] = $Problem_Description;

			array_push($Problems, $Problem);
		}

	}
	return $Problems;
}




 
function addAddress($mysqli,$Address){
	

	if( $statement = $mysqli->prepare("INSERT INTO Addresses (Line1, Line2, Line3, Line4, Line5, Post_Code) VALUES  (?, ?, ?, ?, ?, ?);")){
		
		$statement->bind_param("ssssss",$Address['Line1'],$Address['Line2'],$Address['Line3'],$Address['Line4'],$Address['Line5'],$Address['Post_Code']);

		$statement->execute();
	}
	if($statement = $mysqli->prepare(" SELECT MAX(Address_ID) FROM  Addresses;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Address_ID);
		$statement->fetch();

		
		
	}
	return $Address_ID;
}

function addVehicle($mysqli,$Vehicle){

	if( $statement = $mysqli->prepare("INSERT INTO Vehicles ( Nickname, Registration, Make, Model, Colour, Capacity_Passengers, Tax_Due, MOT_Due, Inspection_Due,
										 Service_Due, Tail_Service_Due, Section_19_No, Section_19_Due, Seating_Configurations) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);") ){

		$statement->bind_param("sssssissssssss",$Vehicle['Nickname'],$Vehicle['Registration'],$Vehicle['Make'],$Vehicle['Model'],$Vehicle['Colour'],$Vehicle['Capacity_Passengers'],$Vehicle['Tax_Due'],$Vehicle['MOT_Due'],$Vehicle['Inspection_Due'],
								$Vehicle['Service_Due'], $Vehicle['Tail_Service_Due'], $Vehicle['Section_19_No'], $Vehicle['Section_19_Due'], $Vehicle['Seating_Configurations']);
		$statement->execute();
		$statement->store_result();
		
		return 'success!';
	}
}

function addDriver($mysqli,$Driver){
	if(isset($Driver['Address_ID'])){
		$Address_ID = $Driver['Address_ID'];
	}
	else{
		$Address_ID = addAddress($mysqli,$Driver['Address']);
	}
	
	if( $statement = $mysqli->prepare("INSERT INTO Drivers (fName, sName, Address_ID, Tel_No, Mobile_No, DOB, Licence_No, Licence_Expires, Licence_Points, DBS_No, DBS_Issued, 
										Emergency_Name, Emergency_Tel, Emergency_Relationship, Is_Volunteer) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);") ){
		
		$statement->bind_param("ssisssssissssss",$Driver['fName'],$Driver['sName'],$Address_ID,$Driver['Tel_No'], $Driver['Mobile_No'], $Driver['DOB'], $Driver['Licence_No'], $Driver['Licence_Expires'], $Driver['Licence_Points'], $Driver['DBS_No'], $Driver['DBS_Issued'], 
										$Driver['Emergency_Name'],$Driver['Emergency_Tel'],$Driver['Emergency_Relationship'],$Driver['Is_Volunteer']);
		$statement->execute();
		$statement->store_result();
		
		return 'success!';
	}
}

function addDamageReport($mysqli,$Damage_Report){


	if( $statement = $mysqli->prepare("INSERT INTO Damage_Reports (Vehicle_ID, Damage_description, Date_Added, Date_Resolved) VALUES ( ?, ?, ?, ?);") ){

		$statement->bind_param("isss",$Damage_Report['Vehicle_ID'],$Damage_Report['Damage_description'],$Damage_Report['Date_Added'],$Damage_Report['Date_Resolved']);
		$statement->execute();
		$statement->store_result();
		
		return 'success!';
	}
}

function addGroup($mysqli,$Group){
	if(isset($Group['Address_ID'])){
		$Address_ID1 = $Group['Address_ID'];
	}
	else{
		$Address_ID1 = addAddress($mysqli,$Group['Address']);
	}

	if(isset($Group['Invoice_Address_ID'])){
		$Address_ID2 = $Group['Invoice_Address_ID'];
	}
	else{
		$Address_ID2 = addAddress($mysqli,$Group['Invoice_Address']);
	}

	if( $statement = $mysqli->prepare("INSERT INTO Groups ( Name, Address, Tel, Invoice_Email, Invoice_Address, Invoice_Tel, Emergency_Name, Emergency_Tel, Profitable, Community, 
										Social, Statutory, Charity_No, Org_Aim, Activities_Education, Activities_Recreation, Activities_Health, Activities_Religion, Activities_Social, Activities_Inclusion, 
										Activities_Other, Concerned_Physical, Concerned_Learning, Concerned_Mental_Health, Concerned_Ethnic, Concerned_Alcohol, Concerned_Drug, Concerned_HIV_AIDS, 
										Concerned_Socially_Isolated, Concerned_Dementia, Concerned_Elderly, Concerned_Pre_School, Concerned_Young, Concerned_Women, Concerned_Health, 
										Concerned_Rurally_Isolated, Concerned_Other) VALUES ( ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?);") ){


		$statement->bind_param("sississsiiiisssssssssssssssssssssssss",
								$Group['Name'],$Address_ID1,$Group['Address_Tel'],$Group['Invoice_Email'], $Address_ID2,$Group['Invoice_Tel'],$Group['Emergency_Name'],$Group['Emergency_Tel'], $Group['Profitable'], $Group['Community'], 
								$Group['Social'], $Group['Statutory'], $Group['Charity_No'], $Group['Org_Aim'], $Group['Activities_Education'], $Group['Activities_Recreation'], $Group['Activities_Health'], $Group['Activities_Religion'], $Group['Activities_Social'], $Group['Activities_Inclusion'],
								$Group['Activities_Other'], $Group['Concerned_Physical'], $Group['Concerned_Learning'], $Group['Concerned_Mental_Health'], $Group['Concerned_Ethnic'], $Group['Concerned_Alcohol'], $Group['Concerned_Drug'], $Group['Concerned_HIV_AIDS'], 
								$Group['Concerned_Socially_Isolated'], $Group['Concerned_Dementia'], $Group['Concerned_Elderly'], $Group['Concerned_Pre_School'], $Group['Concerned_Young'], $Group['Concerned_Women'], $Group['Concerned_Health'], 
								$Group['Concerned_Rurally_Isolated'], $Group['Concerned_Other']);
		$statement->execute();
		$statement->store_result();
		
	}
	return 'success!';
}

function addJourney($mysqli,$Journey){

	if(isset($Journey['Address_ID'])){
		$Address_ID1 = $Journey['Address_ID'];
	}
	else{
		$Address_ID1 = addAddress($mysqli,$Journey['Address']);
	}

	if(isset($Journey['Destination_ID'])){
		$Address_ID2 = $Journey['Destination_ID'];
	}
	else{
		$Address_ID2 = addAddress($mysqli,$Journey['Destination']);
	}
	$Booking_Date = date("Y-m-d"); 

	if( $statement = $mysqli->prepare("INSERT INTO Journeys (Journey_Description, Journey_Note, Booking_Date, fName, sName, Address_ID, Tel_No, Group_ID, Journey_Date, Destination, Return_Note, Return_Time,
										No_Passengers, Passengers_Note, Wheelchairs, Transferees, Other_Access, Booked_By, Driver_ID, Vehicle, 
										Keys_To_Collect, Distance, Quote, Invoiced_Cost, Invoice_Sent, Invoice_Paid) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);") ){

		$statement->bind_param("sssssisisissisiisssssdddss",
								$Journey['Journey_Description'],$Journey['Journey_Note'],$Booking_Date ,$Journey['fName'],$Journey['sName'], $Address_ID1, $Journey['Tel_No'],$Journey['Group_ID'],$Journey['Journey_Date'], $Address_ID2, $Journey['Return_Note'], $Journey['Return_Time'], 
								$Journey['No_Passengers'], $Journey['Passengers_Note'], $Journey['Wheelchairs'], $Journey['Transferees'], $Journey['Other_Access'], $Journey['Booked_By'], $Journey['Driver_ID'], $Journey['Vehicle'], 
								$Journey['Keys_To_Collect'], $Journey['Distance_Run'], $Journey['Quote'], $Journey['Invoiced_Cost'], $Journey['Invoice_Sent'], $Journey['Invoice_Paid']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}
	if($statement = $mysqli->prepare(" SELECT MAX(Journey_ID) FROM  Journeys;")){
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($Journey_ID);
		$statement->fetch();
	}
	return $Journey_ID;
}

function addTCMember($mysqli,$TC_Member){
	if(isset($TC_Member['Address_ID'])){
		$Address_ID = $TC_Member['Address_ID'];
	}
	else{
		$Address_ID = addAddress($mysqli,$TC_Member['Address']);
	}

	if( $statement = $mysqli->prepare("INSERT INTO TC_Members ( fName, sName, Address_ID, Tel_No, Emergency_Name, Emergency_Tel, Emergency_Relationship, DOB,
										Details_Wheelchair, Details_Wheelchair_Type, Details_Wheelchair_Seat, Details_Scooter, Details_Mobility_Aid, Details_Shopping_Trolley, 
										Details_Guide_Dog, Details_People_Carrier, Details_Assistant, Details_Travelcard, Reasons_Transport, Reasons_Bus_Stop, Reasons_Anxiety,
										Reasons_Door, Reasons_Handrails, Reasons_Lift, Reasons_Level_Floors, Reasons_Low_Steps, Reasons_Assistance, Reasons_Board_Time,
										Reasons_Wheelchair_Access, Reasons_Other) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") ){

		$statement->bind_param('ssisssssssssssssssssssssssssss',
								$TC_Member['fName'],$TC_Member['sName'], $Address_ID,$TC_Member['Tel_No'],$TC_Member['Emergency_Name'],$TC_Member['Emergency_Tel'], $TC_Member['Emergency_Relationship'], $TC_Member['DOB'],
								$TC_Member['Details_Wheelchair'], $TC_Member['Details_Wheelchair_Type'], $TC_Member['Details_Wheelchair_Seat'], $TC_Member['Details_Scooter'], $TC_Member['Details_Mobility_Aid'], $TC_Member['Details_Shopping_Trolley'], 
								$TC_Member['Details_Guide_Dog'], $TC_Member['Details_People_Carrier'], $TC_Member['Details_Assistant'], $TC_Member['Details_Travelcard'],$TC_Member['Reasons_Transport'],$TC_Member['Reasons_Bus_Stop'],$TC_Member['Reasons_Anxiety'],
								$TC_Member['Reasons_Door'],$TC_Member['Reasons_Handrails'],$TC_Member['Reasons_Lift'],$TC_Member['Reasons_Level_Floors'],$TC_Member['Reasons_Low_Steps'], $TC_Member['Reasons_Assistance'], $TC_Member['Reasons_Board_Time'],
								$TC_Member['Reasons_Wheelchair_Access'], $TC_Member['Reasons_Other'] );

		

		$statement->execute();
		$statement->store_result();
	
		return 'success!';	
	}
}

function addPickup($mysqli,$Journey_ID,$Pickup){
	if(isset($Pickup['Address_ID'])){
		$Address_ID = $Pickup['Address_ID'];
	}
	else{
		$Address_ID = addAddress($mysqli,$Pickup['Address']);
	}

	if( $statement = $mysqli->prepare("INSERT INTO Pickups ( Journey_ID, Note, Address_ID, Time) VALUES ( ?, ?, ?, ?);") ){

		$statement->bind_param("isis",$Journey_ID, $Pickup['Note'], $Address_ID, $Pickup['Time']);
		$statement->execute();
		$statement->store_result();
		return 'success';
	}
}

function addTCJourneyMember($mysqli,$TC_Journey_Member){

	if( $statement = $mysqli->prepare("INSERT INTO TC_Journey_Members (Journey_ID, TC_Member_ID) VALUES (?, ?);" ) ){
		$statement->bind_param("ii",$TC_Journey_Member['Journey_ID'],$TC_Journey_Member['TC_Member_ID']);
		$statement->execute();
		$statement->store_result();
		return 'success';
	}
}

function addVehicleCheckProblem($mysqli,$Vehicle_Check_Problem){

	if( $statement = $mysqli->prepare("INSERT INTO Vehicle_Check_Problems (Vehicle_ID, Problem_Description) VALUES (?, ?);") ){
		$statement->bind_param("is",$Vehicle_Check_Problem['Vehicle_ID'],$Vehicle_Check_Problem['Problem_Description']);
		$statement->execute();
		$statement->store_result();
		return 'success';
	}
}

function updateDamageReport($mysqli, $Date_Resolved, $Damage_ID){
	if($statement = $mysqli->prepare("UPDATE Damage_Reports SET Date_Resolved = ? WHERE Damage_ID = ?;") ){
		$statement->bind_param("si",$Date_Resolved, $Damage_ID);
		$statement->execute();
		$statement->store_result();
		return 'success';
	}
}

function editJourney($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM Pickups WHERE Journey_ID = ?;") ){
			$statement->bind_param("i",$data[0]['Journey_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}

	if($statement = $mysqli->prepare("DELETE FROM TC_Journey_Members WHERE Journey_ID = ?;") ){
		$statement->bind_param("i",$data[0]['Journey_ID']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}

	if($statement = $mysqli->prepare("DELETE FROM Journeys WHERE Journey_ID = ?;") ){
		$statement->bind_param("i",$data[0]['Journey_ID']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}
	$Journey = $data[1];

	if(isset($Journey['Address_ID'])){
		$Address_ID1 = $Journey['Address_ID'];
	}
	else{
		$Address_ID1 = addAddress($mysqli,$Journey['Address']);
	}
	if(isset($Journey['Destination_ID'])){
		$Address_ID2 = $Journey['Destination_ID'];
	}
	else{
		$Address_ID2 = addAddress($mysqli,$Journey['Destination']);
	}
	$Booking_Date = date("y-m-d"); 

	if( $statement = $mysqli->prepare("INSERT INTO Journeys (Journey_ID, Journey_Description, Journey_Note, Booking_Date, fName, sName, Address_ID, Tel_No, Group_ID, Journey_Date, Destination, Return_Note, Return_Time,
										No_Passengers, Passengers_Note, Wheelchairs, Transferees, Other_Access, Booked_By, Driver_ID, Vehicle, 
										Keys_To_Collect, Distance, Quote, Invoiced_Cost, Invoice_Sent, Invoice_Paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);") ){

		$statement->bind_param("isssssisisissisiisssssdddss",
								$data[0]['Journey_ID'],$Journey['Journey_Description'],$Journey['Journey_Note'],$Booking_Date ,$Journey['fName'],$Journey['sName'], $Address_ID1, $Journey['Tel_No'],$Journey['Group_ID'],$Journey['Journey_Date'], $Address_ID2, $Journey['Return_Note'], $Journey['Return_Time'], 
								$Journey['No_Passengers'], $Journey['Passengers_Note'], $Journey['Wheelchairs'], $Journey['Transferees'], $Journey['Other_Access'], $Journey['Booked_By'], $Journey['Driver_ID'], $Journey['Vehicle'], 
								$Journey['Keys_To_Collect'], $Journey['Distance_Run'], $Journey['Quote'], $Journey['Invoiced_Cost'], $Journey['Invoice_Sent'], $Journey['Invoice_Paid']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}

	$x = $data[1]['Pickups']['No_Pickups']; 
	for ($xx = 1; $xx <= $x; $xx++){
		$Pickup = $data[1]['Pickups'][$xx];
		$Address  = $Pickup['Address'];

		if(isset($Pickup['Address_ID'])){
			$Address_ID = $Pickup['Address_ID'];
		}
		else{
			$Address_ID = addAddress($mysqli,$Address);
		}

		if( $statement = $mysqli->prepare("INSERT INTO Pickups ( Journey_ID, Note, Address_ID, Time) VALUES ( ?, ?, ?, ?);") ){

			$statement->bind_param("isis",$data[0]['Journey_ID'], $Pickup['Note'], $Address_ID, $Pickup['Time']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
			
		}
	}
	return 'success';

}

function deleteJourney($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM Pickups WHERE Journey_ID = ?;") ){
			$statement->bind_param("i",$data['Journey_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}

	if($statement = $mysqli->prepare("DELETE FROM TC_Journey_Members WHERE Journey_ID = ?;") ){
		$statement->bind_param("i",$data['Journey_ID']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}

	if($statement = $mysqli->prepare("DELETE FROM Journeys WHERE Journey_ID = ?;") ){
		$statement->bind_param("i",$data['Journey_ID']);
		$statement->execute();
		$statement->store_result();
		$statement->close();
	}
	
	return 'success';
}

function deleteTCMember($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM TC_Members WHERE TC_Member_ID = ?;") ){
			$statement->bind_param("i",$data['TC_Member_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}
	
	return 'success';
}

function deleteVehicle($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM Vehicles WHERE Vehicle_ID = ?;") ){
			$statement->bind_param("i",$data['Vehicle_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}
	
	return 'success';
}

function deleteDriver($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM Drivers WHERE Driver_ID = ?;") ){
			$statement->bind_param("i",$data['Driver_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}
	
	return 'success';
}

function deleteGroup($mysqli,$data){
	if($statement = $mysqli->prepare("DELETE FROM Groups WHERE Group_ID = ?;") ){
			$statement->bind_param("i",$data['Group_ID']);
			$statement->execute();
			$statement->store_result();
			$statement->close();
		}
	
	return 'success';
}

?>