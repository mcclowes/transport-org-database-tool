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
				window.location = 'add_group.php?id=' + <?php echo $id ?>;
			}
			
			function getGroup() {
			
				var id_data = {
					'Group_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getGroup',
						'form_data': id_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        alert(JSON.stringify(returned_data));
                        $('#Name').text(returned_data['Name']);
                        $('#Tel_No').text(returned_data['Address_Tel']);
                        $('#Email').text(returned_data['Invoice_Email']);
                        $('#Address_Line1').text(returned_data['Address']['Line1']);
                        $('#Address_Line2').text(returned_data['Address']['Line2']);
                        $('#Address_Line3').text(returned_data['Address']['Line3']);
                        $('#Address_Line4').text(returned_data['Address']['Line4']);
                        $('#Address_Line5').text(returned_data['Address']['Line5']);
                        $('#Address_Post_Code').text(returned_data['Address']['Post_Code']);
                        $('#Invoice_Tel').text(returned_data['Invoice_Tel']);
                        $('#Invoice_Line1').text(returned_data['Invoice']['Line1']);
                        $('#Invoice_Line2').text(returned_data['Invoice']['Line2']);
                        $('#Invoice_Line3').text(returned_data['Invoice']['Line3']);
                        $('#Invoice_Line4').text(returned_data['Invoice']['Line4']);
                        $('#Invoice_Line5').text(returned_data['Invoice']['Line5']);
                        $('#Invoice_Post_Code').text(returned_data['Invoice']['Post_Code']);
                        $('#Emergency_Name').text(returned_data['Emergency_Name']);
                        $('#Emergency_Tel').text(returned_data['Emergency_Tel']);	
                        $('#Profitable').text(returned_data['Profitable']);
                        $('#Community').text(returned_data['Community']);
                        $('#Social').text(returned_data['Social']);
                        $('#Statutory').text(returned_data['Statutory']);
                        $('#Charity_No').text(returned_data['Charity_No']);
                        $('#Org_Aim').text(returned_data['Org_Aim']);
                        $('#Activities_Education').text(returned_data['Activities_Education']);
                        $('#Activities_Recreation').text(returned_data['Activities_Recreation']);
                        $('#Activities_Health').text(returned_data['Activities_Health']);
                        $('#Activities_Religion').text(returned_data['Activities_Religion']);
                        $('#Activities_Social').text(returned_data['Activities_Social']);
                        $('#Activities_Inclusion').text(returned_data['Activities_Inclusion']);
                        $('#Activities_Other').text(returned_data['Activities_Other']);
                        $('#Concerned_Physical').text(returned_data['Concerned_Physical']);
                        $('#Concerned_Learning').text(returned_data['Concerned_Learning']);
                        $('#Concerned_Mental_Health').text(returned_data['Concerned_Mental_Health']);
                        $('#Concerned_Ethnic').text(returned_data['Concerned_Ethnic']);
                        $('#Concerned_Alcohol').text(returned_data['Concerned_Alcohol']);
                        $('#Concerned_Drug').text(returned_data['Concerned_Drug']);
                        $('#Concerned_HIV_AIDS').text(returned_data['Concerned_HIV_AIDS']);
                        $('#Concerned_Socially_Isolated').text(returned_data['Concerned_Socially_Isolated']);
                        $('#Concerned_Dementia').text(returned_data['Concerned_Dementia']);
                        $('#Concerned_Elderly').text(returned_data['Concerned_Elderly']);
                        $('#Concerned_Pre_School').text(returned_data['Concerned_Pre_School']);
                        $('#Concerned_Young').text(returned_data['Concerned_Young']);
                        $('#Concerned_Women').text(returned_data['Concerned_Women']);
                        $('#Concerned_Health').text(returned_data['Concerned_Health']);
                        $('#Concerned_Rurally_Isolated').text(returned_data['Concerned_Rurally_Isolated']);
                        $('#Concerned_Other').text(returned_data['Concerned_Other']);
                        
                    }
                });
			
			}

			function deleteGroup() {
				var id_data = {
					'Group_ID': <?php echo $id; ?>
				};
				
				$.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'deleteGroup',
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
    <body onload="getGroup()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
	        <div id="main">
	            <div id="group">
						<fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>Organisation Name: </label></td><td id="Name"/> <td></tr>
								<tr><td><label>Contact Email: </label></td><td id="Email"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td id="Tel_No"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="organisationAddress">
							<legend>Organisation Address</legend>
							<table>
								<tr><td><label>Address line 1: </label></td><td id="Address_Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td id="Address_Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td id="Address_Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td id="Address_Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td id="Address_Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td id="Address_Post_Code"/> </td></tr>
							</table>
						</fieldset>
                        <fieldset id="invoiceAddress">
                            <legend>Invoice Address</legend>
                            <table>
								<tr><td><label>Number: </label></td><td id="Invoice_Tel"/> </td></tr>
                                <tr><td><label>Address line 1: </label></td><td id="Invoice_Line1"/> </td></tr>
                                <tr><td><label>Address line 2: </label></td><td id="Invoice_Line2"/> </td></tr>
                                <tr><td><label>Address line 3: </label></td><td id="Invoice_Line3"/> </td></tr>
                                <tr><td><label>Address line 4: </label></td><td id="Invoice_Line4"/> </td></tr>
                                <tr><td><label>Address line 5: </label></td><td id="Invoice_Line5"/> </td></tr>
                                <tr><td><label>Postcode: </label></td><td id="Invoice_Post_Code"/> </td></tr>
                            </table>
                        </fieldset>
						<fieldset id="emergencyContact">
							<legend>Emergency Contact</legend>
							<table>
								<tr><td><label>Emergency Contact Name: </label></td><td id="Emergency_Name"/></td></tr>
								<tr><td><label>Emergency Contact Number: </label></td><td id="Emergency_Tel"/></td></tr>
							</table>
						</fieldset>
						<fieldset id="orgStatus">
							<legend>Organisational Status</legend>
                            <h2>The group is...</h2>
							<table>
								<tr><td><label>Profit making:</label></td><td id="Profitable"/></td></tr>
								<tr><td><label>A community/voluntary group:</label></td><td id="Community"/></td></tr>
                                <tr><td><label>A social/family group:</label></td><td id="Social"/></td></tr>
                                <tr><td><label>A statutory body:</label></td><td id="Statutory"/></td></tr>
                                <tr><td><label>Charity Number:</label></td><td id="Charity_No"/></td></tr>
							</table>
						</fieldset>
                        <fieldset id="orgAims">
                            <legend>Aims of your organisation</legend>
                            <table>
                                <tr><td><label>Organisation Aims:</label></td><td id="Org_Aim"/></td></tr>
                            </table>
                        </fieldset>
					</div>
					<div id="page3">
						<fieldset id="orgActivities">
							<legend>Please tick all the boxes that apply to show the reasons why you need to use the service.</legend>
							<table>
								<tr><td><label>Education </label></td><td id="Activities_Education" value="1"><br></td></tr>
								<tr><td><label>Recreation </label></td><td id="Activities_Recreation" value="2"><br></td></tr>
								<tr><td><label>Health </label></td><td id="Activities_Health" value="3"><br></td></tr>
								<tr><td><label>Religion </label></td><td id="Activities_Religion" value="4"><br></td></tr>
								<tr><td><label>Social welfare </label></td><td id="Activities_Social" value="5"><br></td></tr>
								<tr><td><label>Inclusion </label></td><td id="Activities_Inclusion" value="6"><br></td></tr>
								<tr><td><label>Other activity: </label></td><td id="Activities_Other"/> </br></td></tr>
							</table>
						</fieldset>
                        <fieldset id="orgMembers">
                            <legend>Please tick all the boxes that apply to show the reasons why you need to use the service.</legend>
                            <table>
                                <tr><td><label>People with a physical disability </label></td><td id="Concerned_Physical" value="1"><br></td></tr>
                                <tr><td><label>People with a learning disability </label></td><td id="Concerned_Learning" value="6"><br></td></tr>
                                <tr><td><label>People with a mental health problem </label></td><td id="Concerned_Mental_Health" value="6"><br></td></tr>
                                <tr><td><label>People from ethnic minorities </label></td><td id="Concerned_Ethnic" value="6"><br></td></tr>
                                <tr><td><label>People with an alcohol related problem </label></td><td id="Concerned_Alcohol" value="6"><br></td></tr>
                                <tr><td><label>People affected by drug problems </label></td><td id="Concerned_Drug" value="6"><br></td></tr>
                                <tr><td><label>People affected by HIV or AIDS</label></td><td id="Concerned_HIV_AIDS" value="6"><br></td></tr>
                                <tr><td><label>People who are socially isolated </label></td><td id="Concerned_Socially_Isolated" value="6"><br></td></tr>
                                <tr><td><label>People with dementia </label></td><td id="Concerned_Dementia" value="6"><br></td></tr>
                                <tr><td><label>Elderly people </label></td><td id="Concerned_Elderly" value="6"><br></td></tr>
                                <tr><td><label>Pre-school age children </label></td><td id="Concerned_Pre_School" value="6"><br></td></tr>
                                <tr><td><label>Young people </label></td><td id="Concerned_Young" value="6"><br></td></tr>
                                <tr><td><label>Women </label></td><td id="Concerned_Women" value="6"><br></td></tr>
                                <tr><td><label>Health groups </label></td><td id="Concerned_Health" value="6"><br></td></tr>
                                <tr><td><label>People who are rurally isolated </label></td><td id="Concerned_Rurally_Isolated" value="6"><br></td></tr>
                                <tr><td><label>Other: </label></td><td id="Concerned_Other"/> </br></td></tr>
                            </table>
                        </fieldset>
	                </br>
	            </div>
	            <input type="submit" id='submitButton' name="submit" value="Edit" onclick='submit()' />
	            <input type="submit" id='submitButton' name="delete" value="Delete" onclick='deleteGroup()' />
	        </div>
	    </div>
    </body>
</html>