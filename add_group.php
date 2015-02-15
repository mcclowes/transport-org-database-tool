
<html>
    <head>
        <title>WCT Tool | Add Group</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script type="text/javascript">
            function submit() {
                form_data = {
                    'Name':                       document.getElementById('input-Name').value,
                    'Email':                       document.getElementById('input-Email').value,
                    'Tel_No':                       document.getElementById('input-Tel_No').value,
                    'Address':{
                        'Line1':                    document.getElementById('input-Address_Line1').value,
                        'Line2':                    document.getElementById('input-Address_Line2').value,
                        'Line3':                    document.getElementById('input-Address_Line3').value,
                        'Line4':                    document.getElementById('input-Address_Line4').value,
                        'Line5':                    document.getElementById('input-Address_Line5').value,
                        'Post_Code':                document.getElementById('input-Address_Post_Code').value
                    },
                    'Invoice':{
                        'Line1':                    document.getElementById('input-Invoice_Line1').value,
                        'Line2':                    document.getElementById('input-Invoice_Line2').value,
                        'Line3':                    document.getElementById('input-Invoice_Line3').value,
                        'Line4':                    document.getElementById('input-Invoice_Line4').value,
                        'Line5':                    document.getElementById('input-Invoice_Line5').value,
                        'Post_Code':                document.getElementById('input-Invoice_Post_Code').value
                    },
                    'Invoice_Email':				document.getElementById('input-Invoice_Email').value,
                    'Invoice_Tel':					document.getElementById('input-Invoice_Tel').value,
                    'Emergency_Name':               document.getElementById('input-Emergency_Name').value,
                    'Emergency_Tel':                document.getElementById('input-Emergency_Tel').value,
                    'Emergency_Relationship':       document.getElementById('input-Emergency_Relationship').value,
                    'Profitable':           		document.getElementById('boolean-Profitable').value,
                    'Community':					document.getElementById('boolean-Community').value,
                    'Social':						document.getElementById('boolean-Social').value,
                    'Statutory':					document.getElementById('boolean-Statutory').value,
                    'Charity':						document.getElementById('boolean-Charity').value,
                    'Charity_No':					document.getElementById('input-Charity_No').value,
                    'Org_Aim':						document.getElementById('input-Org_Aim').value,
                    'Activities_Education':			document.getElementById('boolean-Activities_Education').checked,
                    'Activities_Recreation':		document.getElementById('boolean-Activities_Recreation').checked,
                    'Activities_Health':			document.getElementById('boolean-Activities_Health').checked,
                    'Activities_Religion':			document.getElementById('boolean-Activities_Religion').checked,
                    'Activities_Social':			document.getElementById('boolean-Activities_Social').checked,
                    'Activities_Inclusion':			document.getElementById('boolean-Activities_Inclusion').checked,
                    'input_Activities_Other':		document.getElementById('input-input_Activities_Other').value,
                    'Concerned_Physical':			document.getElementById('boolean-Concerned_Physical').checked,
                    'Concerned_Learning':			document.getElementById('boolean-Concerned_Learning').checked,
                    'Concerned_Mental_Health':		document.getElementById('boolean-Concerned_Mental_Health').checked,
                    'Concerned_Ethnic':				document.getElementById('boolean-Concerned_Ethnic').checked,
                    'Concerned_Alcohol':			document.getElementById('boolean-Concerned_Alcohol').checked,
                    'Concerned_Drug':				document.getElementById('boolean-Concerned_Drug').checked,
                    'Concerned_HIV_AIDS':			document.getElementById('boolean-Concerned_HIV_AIDS').checked,
                    'Concerned_Socially_Isolated':	document.getElementById('boolean-Concerned_Socially_Isolated').checked,
                    'Concerned_Dementia':			document.getElementById('boolean-Concerned_Dementia').checked,
                    'Concerned_Elderly':			document.getElementById('boolean-Concerned_Elderly').checked,
                    'Concerned_Pre_School':			document.getElementById('boolean-Concerned_Pre_School').checked,
                    'Concerned_Young':				document.getElementById('boolean-Concerned_Young').checked,
                    'Concerned_Women':				document.getElementById('boolean-Concerned_Women').checked,
                    'Concerned_Health':				document.getElementById('boolean-Concerned_Health').checked,
                    'Concerned_Rurally_Isolated':	document.getElementById('boolean-Concerned_Rurally_Isolated').checked,
                    'Concerned_Other':				document.getElementById('input-Concerned_Other').value
                };
                
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'addGroup',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        $('#result').replaceWith('<div id="result">'+returned_data+'</div>');
                    }
                });
            }

            var i = 0;

            function next(){
                var pages = ['#page1', '#page2', '#page3'];
                var currentPage = $(pages[i]);
                var nextPage = $(pages[i+1]);

                currentPage.animate({
                    height: "toggle"
                }, 500, function(){
                    currentPage.hide();
                    nextPage.animate({
                        height: "toggle"
                    });  
                });

                i = i + 1;

                if (i == pages.length - 1){
                    $('#nextButton').animate({
                        height : "toggle"
                    }, 250, function(){
                        $('#submitButton').show();
                    }); 
                }
            }

            function cancel(){
                window.location.href = "";
            }

            function startScreen(){
                $('#page2').hide();
                $('#page3').hide();
                $('#submitButton').hide();
                var i = 0;
            }

        </script>
    </head>
    <body onload="startScreen()">
        <div id="wctLogo"></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="journeys.html">Journeys</a>
                    <ul>
                        <li><a href="journeys.php">Manage Journeys</a></li>
                        <li><a href="add_journey.php">Add Journey</a></li>
                    </ul>
                </li>
                <li><a href="groups.php">Groups</a>
                    <ul>
                        <li><a href="manage_groups.php">Manage Groups</a></li>
                        <li><a href="add_group.php">Add group</a></li>
                    </ul>
                </li>
                <li><a href="members.php">Members</a>
                    <ul>
                        <li><a href="manage_members.php">Manage Members</a></li>
                        <li><a href="add_member.php">Add Member</a></li>
                    </ul>
                </li>
                <li><a href="vehicles.php">Vehicles</a>
                    <ul>
                        <li><a href="manage_vehicles.php">Manage Vehicles</a></li>
                        <li><a href="add_vehicle.php">Add vehicle</a></li>
                    </ul>
                </li>
                <li><a href="drivers.php">Drivers</a>
                    <ul>
                        <li><a href="manage_drivers.php">Manage Drivers</a></li>
                        <li><a href="add_driver.php">Add Driver</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="page_wrapper">
            <div id="main">
                <form method="POST" action="">
                <!-- bother with form attribute? -->
					<div id="page1">
						<fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>Organisation Name: </label></td><td><input type="text" id="input-Name"/> <td></tr>
								<tr><td><label>Contact Email: </label></td><td><input type="email" id="input-Email"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="organisationAddress">
							<legend>Organisation Address</legend>
							<table>
								<tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Address_Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Address_Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Address_Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Address_Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Address_Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td><input type="text" id="input-Address_Post_Code"/> </td></tr>
							</table>
						</fieldset>
                        <fieldset id="invoiceAddress">
                            <legend>Invoice Address</legend>
                            <table>
								<tr><td><label>Email: </label></td><td><input type="email" id="input-Invoice_Email"/> <td></tr>
								<tr><td><label>Number: </label></td><td><input type="text" id="input-Invoice_Tel"/> </td></tr>
                                <tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Invoice_Line1"/> </td></tr>
                                <tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Invoice_Line2"/> </td></tr>
                                <tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Invoice_Line3"/> </td></tr>
                                <tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Invoice_Line4"/> </td></tr>
                                <tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Invoice_Line5"/> </td></tr>
                                <tr><td><label>Postcode: </label></td><td><input type="text" id="input-Invoice_Post_Code"/> </td></tr>
                            </table>
                        </fieldset>
						<fieldset id="emergencyContact">
							<legend>Emergency Contact</legend>
							<table>
								<tr><td><label>Emergency Contact Name: </label></td><td><input type="text" id="input-Emergency_Name"/></td></tr>
								<tr><td><label>Emergency Contact Number: </label></td><td><input type="text" id="input-Emergency_Tel"/></td></tr>
								<tr><td><label>Emergency Contact Role:</label></td><td><input type="text" id="input-Emergency_Relationship"/></td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="orgStatus">
							<legend>Organisational Status</legend>
                            <h2>Is your group...</h2>
							<table>
								<tr><td><label>Profit making?</label></td><td>
								<select id="boolean-Profitable"> 
									<option>...</option> 
									<option value="true">Yes</option> 
									<option value="false">No</option>
								</select></td></tr>
                                <tr><td><label>A community/voluntary group?</label></td><td>
                                <select id="boolean-Community"> 
                                    <option>...</option> 
                                    <option value="true">Yes</option> 
                                    <option value="false">No</option>
                                </select></td></tr>
                                <tr><td><label>A social/family group?</label></td><td>
                                <select id="boolean-Social"> 
                                    <option>...</option> 
                                    <option value="true">Yes</option> 
                                    <option value="false">No</option>
                                </select></td></tr>
                                <tr><td><label>A statutory body?</label></td><td>
                                <select id="boolean-Statutory"> 
                                    <option>...</option> 
                                    <option value="true">Yes</option> 
                                    <option value="false">No</option>
                                </select></td></tr>
                                <tr><td><label>A registered charity?</label></td><td>
                                <select id="boolean-Charity"> 
                                    <option>...</option> 
                                    <option value="true">Yes</option> 
                                    <option value="false">No</option>
                                </select></td></tr>
								<tr><td><label>Charity Number:</label></td><td><input type="text" id="input-Charity_No"/></td></tr>
							</table>
						</fieldset>
                        <fieldset id="orgAims">
                            <legend>Aims of your organisation</legend>
                            <table>
                                <tr><td><label>Organisation Aims:</label></td><td><input type="textarea" id="input-Org_Aim"/></td></tr>
                            </table>
                        </fieldset>
					</div>
					<div id="page3">
						<fieldset id="orgActivities">
							<legend>Please tick all the boxes that apply to show the reasons why you need to use the service.</legend>
							<table>
								<tr><td><label>Education </label></td><td><input type="checkbox" id="boolean-Activities_Education" value="1"><br></td></tr>
								<tr><td><label>Recreation </label></td><td><input type="checkbox" id="boolean-Activities_Recreation" value="2"><br></td></tr>
								<tr><td><label>Health </label></td><td><input type="checkbox" id="boolean-Activities_Health" value="3"><br></td></tr>
								<tr><td><label>Religion </label></td><td><input type="checkbox" id="boolean-Activities_Religion" value="4"><br></td></tr>
								<tr><td><label>Social welfare </label></td><td><input type="checkbox" id="boolean-Activities_Social" value="5"><br></td></tr>
								<tr><td><label>Inclusion </label></td><td><input type="checkbox" id="boolean-Activities_Inclusion" value="6"><br></td></tr>
								<tr><td><label>Other activity: </label></td><td><input type="text" id="input-input_Activities_Other"/> </br></td></tr>
							</table>
						</fieldset>
                        <fieldset id="orgMembers">
                            <legend>Please tick all the boxes that apply to show the reasons why you need to use the service.</legend>
                            <table>
                                <tr><td><label>People with a physical disability </label></td><td><input type="checkbox" id="boolean-Concerned_Physical" value="1"><br></td></tr>
                                <tr><td><label>People with a learning disability </label></td><td><input type="checkbox" id="boolean-Concerned_Learning" value="6"><br></td></tr>
                                <tr><td><label>People with a mental health problem </label></td><td><input type="checkbox" id="boolean-Concerned_Mental_Health" value="6"><br></td></tr>
                                <tr><td><label>People from ethnic minorities </label></td><td><input type="checkbox" id="boolean-Concerned_Ethnic" value="6"><br></td></tr>
                                <tr><td><label>People with an alcohol related problem </label></td><td><input type="checkbox" id="boolean-Concerned_Alcohol" value="6"><br></td></tr>
                                <tr><td><label>People affected by drug problems </label></td><td><input type="checkbox" id="boolean-Concerned_Drug" value="6"><br></td></tr>
                                <tr><td><label>People affected by HIV or AIDS</label></td><td><input type="checkbox" id="boolean-Concerned_HIV_AIDS" value="6"><br></td></tr>
                                <tr><td><label>People who are socially isolated </label></td><td><input type="checkbox" id="boolean-Concerned_Socially_Isolated" value="6"><br></td></tr>
                                <tr><td><label>People with dementia </label></td><td><input type="checkbox" id="boolean-Concerned_Dementia" value="6"><br></td></tr>
                                <tr><td><label>Elderly people </label></td><td><input type="checkbox" id="boolean-Concerned_Elderly" value="6"><br></td></tr>
                                <tr><td><label>Pre-school age children </label></td><td><input type="checkbox" id="boolean-Concerned_Pre_School" value="6"><br></td></tr>
                                <tr><td><label>Young people </label></td><td><input type="checkbox" id="boolean-Concerned_Young" value="6"><br></td></tr>
                                <tr><td><label>Women </label></td><td><input type="checkbox" id="boolean-Concerned_Women" value="6"><br></td></tr>
                                <tr><td><label>Health groups </label></td><td><input type="checkbox" id="boolean-Concerned_Health" value="6"><br></td></tr>
                                <tr><td><label>People who are rurally isolated </label></td><td><input type="checkbox" id="boolean-Concerned_Rurally_Isolated" value="6"><br></td></tr>
                                <tr><td><label>Other: </label></td><td><input type="text" id="input-Concerned_Other"/> </br></td></tr>
                            </table>
                        </fieldset>
					</div>
                    <input type="text" name="mobility" id="mobility" style='display:none;'/>
                    </br>
                </form>
				<div id="nextButton" onclick="next()">Next</div>
				<div id="submitButton" onclick="submit();">Submit</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>