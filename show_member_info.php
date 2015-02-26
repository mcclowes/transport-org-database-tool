<html>
    <head>
	
		<?php
			$id = $_GET['id'];
		?>
	
        <title>WCT Tool | Home</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script>
		
			function submit() {
				window.location = 'add_member.php?id=' + <?php echo $id ?>;
			}
			
			function getTCMember() {
			
				var id_data = {
					'TC_Member_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getTCMember',
						'form_data': id_data
                    },
                    dataType: "json",
                    success: function(returned_data) {

                        $('#fName').text(returned_data['fName']);
                        $('#sName').text(returned_data['sName']);
                        $('#Line1').text(returned_data['Address']['Line1']);
                        $('#Line2').text(returned_data['Address']['Line2']);
                        $('#Line3').text(returned_data['Address']['Line3']);
                        $('#Line4').text(returned_data['Address']['Line4']);
                        $('#Line5').text(returned_data['Address']['Line5']);
                        $('#Post_Code').text(returned_data['Address']['Post_Code']);
                        $('#Tel_No').text(returned_data['Tel_No']);
                        $('#Emergency_Name').text(returned_data['Emergency_Name']);
                        $('#Emergency_Tel').text(returned_data['Emergency_Tel']);
                        $('#Emergency_Relationship').text(returned_data['Emergency_Relationship']);
                        $('#Capacity_Note').text(returned_data['Seating_Configurations']);
                        $('#DOB').text(returned_data['DOB']);
                        $('#Details_Wheelchair').text(returned_data['Details_Wheelchair']);
                        $('#Details_Wheelchair_Type').text(returned_data['Details_Wheelchair_Type']);
                        $('#Details_Wheelchair_Seat').text(returned_data['Details_Wheelchair_Seat']);
                        $('#Details_Scooter').text(returned_data['Details_Scooter']);
                        $('#Details_Mobility_Aid').text(returned_data['Details_Mobility_Aid']);
                        $('#Details_Shopping_Trolley').text(returned_data['Details_Shopping_Trolley']);
                        $('#Details_Guide_Dog').text(returned_data['Details_Guide_Dog']);
                        $('#Details_People_Carrier').text(returned_data['Details_People_Carrier']);
                        $('#Details_Assistant').text(returned_data['Details_Assistant']);
                        $('#Details_Travelcard').text(returned_data['Details_Travelcard']);
                        $('#Reasons_Transport').text(returned_data['Reasons_Transport']);
                        $('#Reasons_Bus_Stop').text(returned_data['Reasons_Bus_Stop']);
                        $('#Reasons_Anxiety').text(returned_data['Reasons_Anxiety']);
                        $('#Reasons_Door').text(returned_data['Reasons_Door']);
                        $('#Reasons_Handrails').text(returned_data['Reasons_Handrails']);
                        $('#Reasons_Lift').text(returned_data['Reasons_Lift']);
                        $('#Reasons_Level_Floors').text(returned_data['Reasons_Level_Floors']);
                        $('#Reasons_Low_Steps').text(returned_data['Reasons_Low_Steps']);
                        $('#Reasons_Assistance').text(returned_data['Reasons_Assistance']);
                        $('#Reasons_Board_Time').text(returned_data['Reasons_Board_Time']);
                        $('#Reasons_Wheelchair_Access').text(returned_data['Reasons_Wheelchair_Access']);
                        $('#Reasons_Other').text(returned_data['Reasons_Other']);
                    }
                });
			
			}

			function deleteMember() {
				var id_data = {
					'TC_Member_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'deleteTCMember',
						'form_data': id_data
                    },
                    dataType: "json",
					success: function(returned_data) {
	                    	window.location = 'index.php';
	                    }
	            });
			}
		
		</script>
		
    </head>
    <body onload="getTCMember()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
	        <div id="main">
				<fieldset id="personalDetails">
					<legend>Personal Details</legend>
					<table>
						<tr><td><label>First Name: </label></td><td id="fName"/> <td></tr>
						<tr><td><label>Surname: </label></td><td id="sName"/> <td></tr>
						<tr><td><label>Date of Birth: </label></td><td id="DOB"/> <td></tr>
						<tr><td><label>Contact Number: </label></td><td id="Tel_No"/> </td></tr>
					</table>
				</fieldset>
				<fieldset id="personalAddress">
					<legend>Address</legend>
					<table>
						<tr><td><label>Address line 1: </label></td><td id="Line1"/> </td></tr>
						<tr><td><label>Address line 2: </label></td><td id="Line2"/> </td></tr>
						<tr><td><label>Address line 3: </label></td><td id="Line3"/> </td></tr>
						<tr><td><label>Address line 4: </label></td><td id="Line4"/> </td></tr>
						<tr><td><label>Address line 5: </label></td><td id="Line5"/> </td></tr>
						<tr><td><label>Postcode: </label></td><td id="Post_Code"/> </td></tr>
					</table>
				</fieldset>
				<fieldset id="emergencyContact">
					<legend>Emergency Contact</legend>
					<table>
						<tr><td><label>Emergency Contact Name: </label></td><td id="Emergency_Name"/></td></tr>
						<tr><td><label>Emergency Contact Number: </label></td><td id="Emergency_Tel"/></td></tr>
						<tr><td><label>Emergency Contact Relationship:</label></td><td id="Emergency_Relationship"/></td></tr>
					</table>
				</fieldset>
				<fieldset id="additionalDetails">
					<legend>Additional Details</legend>
					<table>
						<tr><td><label>Do you use a wheelchair? </label></td><td id="Details_Wheelchair"></td></tr>
						<tr><td><label>What type of wheelchair do you use? </label></td><td id="Details_Wheelchair_Type"></td></tr>
						<tr><td><label>Do you want to transfer from your wheelchair to our vehicle? </label></td><td id="Details_Wheelchair_Seat"></td></tr>
						<tr><td><label>Do you use a scooter? </label></td><td id="Details_Scooter"></td></tr>
						<tr><td><label>Do you use a mobility aid?</label></td><td id="Details_Mobility_Aid"></td></tr>	
						<tr><td><label>If shopping, do you use a shopping trolley?</label></td><td id="Details_Shopping_Trolley"></td></tr>
						<tr><td><label>Will you be travelling with a guide dog?</label></td><td id="Details_Guide_Dog"></td></tr>
						<tr><td><label>Can you get into a 'people carrier' style car? </label></td><td id="Details_People_Carrier"></td></tr>
						<tr><td><label>Do you need a passenger assistant?</label></td><td id="Details_Assistant"></td></tr>
						<tr><td><label>Do you have a Concessionary Travelcard?</label></td><td id="Details_Travelcard"></td></tr>
					</table>
				</fieldset>
				<fieldset id="serviceReasons">
					<legend>Need of service.</legend>
					<table>
						<tr><td><label>Public transport is not available to me </label></td><td id="Reasons_Transport"></td></tr>
						<tr><td><label>I need to feel reassurance that the bus will stop when required </label></td><td id="Reasons_Bus_Stop"></td></tr>
						<tr><td><label>I have anxiety about using public transport </label></td><td id="Reasons_Anxiety"></tr>
						<tr><td><label>I need a door to door service </label></td><td id="Reasons_Door"></td></tr>
						<tr><td><label>I need additional handrails and grips </label></td><td id="Reasons_Handrails"></td></tr>
						<tr><td><label>I need to use a passenger lift to access the bus </label></td><td id="Reasons_Lift"></td></tr>
						<tr><td><label>I need the floors to be level </label></td><td id="Reasons_Level_Floors" value="7"><br></td></tr>
						<tr><td><label>I need low steps to board and exit from the bus </label></td><td id="Reasons_Low_Steps"></td></tr>
						<tr><td><label>I need personal assistance </label></td><td id="Reasons_Assistance"></td></tr>
						<tr><td><label>I need time to board and exit form the bus</label></td><td id="Reasons_Board_Time"></td></tr>
						<tr><td><label>I need wheelchair access and restraining systems for my chair and myself</label></td><td id="Reasons_Wheelchair_Access"></td></tr>
						<tr><td><label>Other: </label></td><td id="Reasons_Other"/> </td></tr>
					</table>
				</fieldset>
				</br>
			<input type="submit" id='submitButton' name="submit" value="Edit" onclick='submit()' />
			<input type="submit" id='submitButton' name="delete" value="Delete" onclick='deleteMember()' />
	        </div>
	    </div>
    </body>
</html>