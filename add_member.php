
<html>
    <head>
        <title>WCT Tool | Add Member</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <?php
            if (isset($_GET['id'])) {
                $is_edit = true;
                
                $id = $_GET['id'];
            }
            else {
                $is_edit = false;
            }
        ?>

        <script type="text/javascript">
            is_edit = '<?php echo $is_edit; ?>';
            
            function submit() {
                form_data = {
                    'fName':                        document.getElementById('input-fName').value,
                    'sName':                        document.getElementById('input-sName').value,
                    'Address_ID':                   document.getElementById('dropdown-Addresses').value,
                    'Address':{
                        'Line1':                    document.getElementById('input-Line1').value,
                        'Line2':                    document.getElementById('input-Line2').value,
                        'Line3':                    document.getElementById('input-Line3').value,
                        'Line4':                    document.getElementById('input-Line4').value,
                        'Line5':                    document.getElementById('input-Line5').value,
                        'Post_Code':                document.getElementById('input-Post_Code').value
                    },
                    'Tel_No':                       document.getElementById('input-Tel_No').value,
                    'Emergency_Name':               document.getElementById('input-Emergency_Name').value,
                    'Emergency_Tel':                document.getElementById('input-Emergency_Tel').value,
                    'Emergency_Relationship':       document.getElementById('input-Emergency_Relationship').value,
                    'DOB':                          document.getElementById('date-DOB').value,
                    'Details_Wheelchair':           document.getElementById('dropdown-Details_Wheelchair').value,
                    'Details_Wheelchair_Type':      document.getElementById('dropdown-Details_Wheelchair_Type').value,
                    'Details_Wheelchair_Seat':      document.getElementById('dropdown-Details_Wheelchair_Seat').value,
                    'Details_Scooter':              document.getElementById('dropdown-Details_Scooter').value,
                    'Details_Mobility_Aid':         document.getElementById('input-Details_Mobility_Aid').value,
                    'Details_Shopping_Trolley':     document.getElementById('dropdown-Details_Shopping_Trolley').value,
                    'Details_Guide_Dog':            document.getElementById('dropdown-Details_Guide_Dog').value,
                    'Details_People_Carrier':       document.getElementById('dropdown-Details_People_Carrier').value,
                    'Details_Assistant':            document.getElementById('dropdown-Details_Assistant').value,
                    'Details_Travelcard':           document.getElementById('dropdown-Details_Travelcard').value,
                    'Reasons_Transport':            document.getElementById('boolean-Reasons_Transport').checked,
                    'Reasons_Bus_Stop':             document.getElementById('boolean-Reasons_Bus_Stop').checked,
                    'Reasons_Anxiety':              document.getElementById('boolean-Reasons_Anxiety').checked,
                    'Reasons_Door':                 document.getElementById('boolean-Reasons_Door').checked,
                    'Reasons_Handrails':            document.getElementById('boolean-Reasons_Handrails').checked,
                    'Reasons_Lift':                 document.getElementById('boolean-Reasons_Lift').checked,
                    'Reasons_Level_Floors':         document.getElementById('boolean-Reasons_Level_Floors').checked,
                    'Reasons_Low_Steps':            document.getElementById('boolean-Reasons_Low_Steps').checked,
                    'Reasons_Assistance':           document.getElementById('boolean-Reasons_Assistance').checked,
                    'Reasons_Board_Time':           document.getElementById('boolean-Reasons_Board_Time').checked,
                    'Reasons_Wheelchair_Access':    document.getElementById('boolean-Reasons_Wheelchair_Access').checked,
                    'Reasons_Other':                document.getElementById('input-Reasons_Other').value
                };

                if (is_edit == '1') {
                    form_data['TC_Member_ID'] = '<?php echo $id; ?>';
                    alert(JSON.stringify(form_data));

                    $.ajax({
                        type: "POST",
                        url:"MySQL_Functions.php",
                        data: {
                            'form_type': 'editTCMember',
                            'form_data': form_data
                        },
                        dataType: "json",
                        success: function(returned_data) {
                            window.location = 'index.php';
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url:"MySQL_Functions.php",
                        data: {
                            'form_type': 'addTCMember',
                            'form_data': form_data
                        },
                        dataType: "json",
                        success: function(returned_data) {
                            $('#result').replaceWith('<div id="result">'+returned_data+'</div>');
                        }
                    });
                }
            }

            function populateEditFields(TC_Member_ID) {
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getTCMember',
                        'form_data': {'TC_Member_ID': TC_Member_ID}
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        //alert(JSON.stringify(returned_data));
                        document.getElementById('input-fName').value = returned_data['fName'];
                        document.getElementById('input-sName').value = returned_data['sName'];
                        document.getElementById('date-DOB').value = returned_data['DOB'];
                        document.getElementById('dropdown-Addresses').value = returned_data['Address_ID'];
                        document.getElementById('input-Line1').value = returned_data['Address']['Line1'];
                        document.getElementById('input-Line2').value = returned_data['Address']['Line2'];
                        document.getElementById('input-Line3').value = returned_data['Address']['Line3'];
                        document.getElementById('input-Line4').value = returned_data['Address']['Line4'];
                        document.getElementById('input-Line5').value = returned_data['Address']['Line5'];
                        document.getElementById('input-Post_Code').value = returned_data['Address']['Post_Code'];
                        document.getElementById('input-Tel_No').value = returned_data['Tel_No'];
                        document.getElementById('input-Emergency_Name').value = returned_data['Emergency_Name'];
                        document.getElementById('input-Emergency_Tel').value = returned_data['Emergency_Tel'];
                        document.getElementById('input-Emergency_Relationship').value = returned_data['Emergency_Relationship'];
                        document.getElementById('dropdown-Details_Wheelchair').value = returned_data['Details_Wheelchair'];
                        document.getElementById('dropdown-Details_Wheelchair_Type').value = returned_data['Details_Wheelchair_Type'];
                        document.getElementById('dropdown-Details_Wheelchair_Seat').value = returned_data['Details_Wheelchair_Seat'];
                        document.getElementById('dropdown-Details_Scooter').value = returned_data['Details_Scooter'];
                        document.getElementById('input-Details_Mobility_Aid').value = returned_data['Details_Mobility_Aid'];
                        document.getElementById('dropdown-Details_Shopping_Trolley').value = returned_data['Details_Shopping_Trolley'];
                        document.getElementById('dropdown-Details_Guide_Dog').value = returned_data['Details_Guide_Dog'];
                        document.getElementById('dropdown-Details_People_Carrier').value = returned_data['Details_People_Carrier'];
                        document.getElementById('dropdown-Details_Assistant').value = returned_data['Details_Assistant'];
                        document.getElementById('dropdown-Details_Travelcard').value = returned_data['Details_Travelcard'];
                        document.getElementById('boolean-Reasons_Transport').value = returned_data['Reasons_Transport'];
                        document.getElementById('boolean-Reasons_Bus_Stop').value = returned_data['Reasons_Bus_Stop'];
                        document.getElementById('boolean-Reasons_Anxiety').value = returned_data['Reasons_Anxiety'];
                        document.getElementById('boolean-Reasons_Door').value = returned_data['Reasons_Door'];
                        document.getElementById('boolean-Reasons_Handrails').value = returned_data['Reasons_Handrails'];
                        document.getElementById('boolean-Reasons_Lift').value = returned_data['Reasons_Lift'];
                        document.getElementById('boolean-Reasons_Level_Floors').value = returned_data['Reasons_Level_Floors'];
                        document.getElementById('boolean-Reasons_Low_Steps').value = returned_data['Reasons_Low_Steps'];
                        document.getElementById('boolean-Reasons_Assistance').value = returned_data['Reasons_Assistance'];
                        document.getElementById('boolean-Reasons_Board_Time').value = returned_data['Reasons_Board_Time'];
                        document.getElementById('boolean-Reasons_Wheelchair_Access').value = returned_data['Reasons_Wheelchair_Access'];
                        document.getElementById('input-Reasons_Other').value = returned_data['Reasons_Other'];
                    }
                });
            }

            function populateAddresses(dropdownID){
                var dropdown = document.getElementById(dropdownID);
            
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getAddresses'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        for(var i = 0; i < returned_data.length; i++) {
                            var item = document.createElement("option");
                            item.textContent = returned_data[i]['Post_Code'] + ', ' + returned_data[i]['Line1'] + ', ' + returned_data[i]['Line2'] + ', ' + returned_data[i]['Line3'] + ', ' + returned_data[i]['Line4'] + ', ' + returned_data[i]['Line5'];
                            item.value = returned_data[i]['Address_ID'];
                            dropdown.appendChild(item);
                        }
                    }
                });
            }

            function addAddress(id, dropdown){
                var Address_ID = document.getElementById(dropdown).value;
                if(Address_ID > 0){
                    $.ajax({
                        type: "POST",
                        url:"MySQL_Functions.php",
                        data: {
                            'form_type': 'getAddress',
                            'form_data': {'Address_ID' : Address_ID}
                        },
                        dataType: "json",
                        success: function(returned_data) {
                            document.getElementById(id+'Line1').value = returned_data['Line1'];
                            document.getElementById(id+'Line1').readOnly = true;
                            document.getElementById(id+'Line2').value = returned_data['Line2'];
                            document.getElementById(id+'Line2').readOnly = true;
                            document.getElementById(id+'Line3').value = returned_data['Line3'];
                            document.getElementById(id+'Line3').readOnly = true;
                            document.getElementById(id+'Line4').value = returned_data['Line4'];
                            document.getElementById(id+'Line4').readOnly = true;
                            document.getElementById(id+'Line5').value = returned_data['Line5'];
                            document.getElementById(id+'Line5').readOnly = true;
                            document.getElementById(id+'Post_Code').value = returned_data['Post_Code'];  
                            document.getElementById(id+'Post_Code').readOnly = true;
                        }
                    });
                }
                else{
                    document.getElementById(id+'Line1').value = '';
                    document.getElementById(id+'Line1').readOnly = false;
                    document.getElementById(id+'Line2').value = '';
                    document.getElementById(id+'Line2').readOnly = false;
                    document.getElementById(id+'Line3').value = '';
                    document.getElementById(id+'Line3').readOnly = false;
                    document.getElementById(id+'Line4').value = '';
                    document.getElementById(id+'Line4').readOnly = false;
                    document.getElementById(id+'Line5').value = '';
                    document.getElementById(id+'Line5').readOnly = false;
                    document.getElementById(id+'Post_Code').value = '';  
                    document.getElementById(id+'Post_Code').readOnly = false;
                }
            }

            function clearAddress(id, dropdownID){
                var dropdown = document.getElementById(dropdownID);
            
                dropdown.value = null;
                document.getElementById(id+'Line1').value = '';
                document.getElementById(id+'Line1').readOnly = false;
                document.getElementById(id+'Line2').value = '';
                document.getElementById(id+'Line2').readOnly = false;
                document.getElementById(id+'Line3').value = '';
                document.getElementById(id+'Line3').readOnly = false;
                document.getElementById(id+'Line4').value = '';
                document.getElementById(id+'Line4').readOnly = false;
                document.getElementById(id+'Line5').value = '';
                document.getElementById(id+'Line5').readOnly = false;
                document.getElementById(id+'Post_Code').value = '';  
                document.getElementById(id+'Post_Code').readOnly = false;
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

                if (i == 1){
                    $('#backButton').animate({
                        height : "toggle"
                    }, 250, function(){
                        $('#backButton').show();
                    }); 
                }
            }

            function back(){
                var pages = ['#page1', '#page2', '#page3'];
                var currentPage = $(pages[i]);
                var prevPage = $(pages[i-1]);

                currentPage.animate({
                    height: "toggle"
                }, 500, function(){
                    currentPage.hide();
                    prevPage.animate({
                        height: "toggle"
                    });  
                });

                i = i - 1;

                if (i == pages.length - 2){
                    $('#submitButton').animate({
                        height : "toggle"
                    }, 250, function(){
                        $('#nextButton').show();
                    }); 
                }

                if (i == 0){
                    $('#backButton').animate({
                        height : "toggle"
                    }, 250, function(){
                        $('#backButton').hide();
                    }); 
                }
            }

            function cancel(){
                window.location.href = "";
            }

            function startScreen(){
            	populateAddresses('dropdown-Addresses');
                $('#page2').hide();
                $('#page3').hide();
                $('#backButton').hide();
                $('#submitButton').hide();
                var i = 0;

                if (is_edit == '1') {
                    TC_Member_ID = '<?php echo $id; ?>';
                    populateEditFields(TC_Member_ID);
                }
            }

        </script>
    </head>
    <body onload="startScreen()">
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
            <div id="main">
                <form method="POST" action="">
                <!-- bother with form attribute? -->
					<div id="page1">
						<fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>First Name: </label></td><td><input type="text" id="input-fName"/> <td></tr>
								<tr><td><label>Surname: </label></td><td><input type="text" id="input-sName"/> <td></tr>
								<tr><td><label>Date of Birth: </label></td><td><input type="date" id="date-DOB"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="personalAddress">
							<legend>Address</legend>
							<table>
							 	<tr><td><label>Stored Addresses: </label></td>
                                <td><select id="dropdown-Addresses" onchange="addAddress('input-', 'dropdown-Addresses')"> 
                                    <option>Choose an existing address</option>
                                </select></td>
                                <td>
                                <div id="addTCMember" onclick="clearAddress('input-', 'dropdown-Addresses')">Clear</div>
                                </td></tr>
								<tr><td><label>Address line 1: </label></td><td><input type="text" id="input-Line1"/> </td></tr>
								<tr><td><label>Address line 2: </label></td><td><input type="text" id="input-Line2"/> </td></tr>
								<tr><td><label>Address line 3: </label></td><td><input type="text" id="input-Line3"/> </td></tr>
								<tr><td><label>Address line 4: </label></td><td><input type="text" id="input-Line4"/> </td></tr>
								<tr><td><label>Address line 5: </label></td><td><input type="text" id="input-Line5"/> </td></tr>
								<tr><td><label>Postcode: </label></td><td><input type="text" id="input-Post_Code"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="emergencyContact">
							<legend>Emergency Contact</legend>
							<table>
								<tr><td><label>Emergency Contact Name: </label></td><td><input type="text" id="input-Emergency_Name"/></td></tr>
								<tr><td><label>Emergency Contact Number: </label></td><td><input type="text" id="input-Emergency_Tel"/></td></tr>
								<tr><td><label>Emergency Contact Relationship:</label></td><td><input type="text" id="input-Emergency_Relationship"/></td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="additionalDetails">
							<legend>Additional Details</legend>
							<table>
								<tr><td><label>Do you use a wheelchair? </label></td><td>
								<select id="dropdown-Details_Wheelchair"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option> 
									<option value="maybe">Maybe</option>
								</select></td></tr>
								<tr><td><label>What type of wheelchair do you use? </label></td><td>
								<select id="dropdown-Details_Wheelchair_Type"> 
									<option>...</option> 
                                    <option value="none">None</option> 
									<option value="folding">Folding</option> 
									<option value="fixed">Fixed</option> 
									<option value="power">Power</option>
								</select></td></tr>
								<tr><td><label>Do you want to transfer from your wheelchair to a seat on our vehicle? </label></td><td>
								<select id="dropdown-Details_Wheelchair_Seat"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Do you use a scooter? </label></td><td>
								<select id="dropdown-Details_Scooter"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Do you use a mobility aid?</label></td><td><input type="text" id="input-Details_Mobility_Aid"/></br></td></tr>
								<tr><td><label>If shopping, do you use a shopping trolley?</label></td><td>
								<select id="dropdown-Details_Shopping_Trolley"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Will you be travelling with a guide dog?</label></td><td>
								<select id="dropdown-Details_Guide_Dog"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Can you get into a 'people carrier' style car? </label></td><td>
								<select id="dropdown-Details_People_Carrier"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Do you need a passenger assistant?</label></td><td>
								<select id="dropdown-Details_Assistant"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
								<tr><td><label>Do you have a Concessionary Travelcard?</label></td><td>
								<select id="dropdown-Details_Travelcard"> 
									<option>...</option> 
									<option value="yes">Yes</option> 
									<option value="no">No</option>
								</select></td></tr>
							</table>
						</fieldset>
					</div>
					<div id="page3">
						<fieldset id="serviceReasons">
							<legend>Please tick all the boxes that apply to show the reasons why you need to use the service.</legend>
							<table>
								<tr><td><label>Public transport is not available to me </label></td><td><input type="checkbox" id="boolean-Reasons_Transport" value="1"><br></td></tr>
								<tr><td><label>I need to feel reassurance that the bus will stop when required </label></td><td><input type="checkbox" id="boolean-Reasons_Bus_Stop" value="2"><br></td></tr>
								<tr><td><label>I have anxiety about using public transport </label></td><td><input type="checkbox" id="boolean-Reasons_Anxiety" value="3"><br></td></tr>
								<tr><td><label>I need a door to door service </label></td><td><input type="checkbox" id="boolean-Reasons_Door" value="4"><br></td></tr>
								<tr><td><label>I need additional handrails and grips </label></td><td><input type="checkbox" id="boolean-Reasons_Handrails" value="5"><br></td></tr>
								<tr><td><label>I need to use a passenger lift to access the bus </label></td><td><input type="checkbox" id="boolean-Reasons_Lift" value="6"><br></td></tr>
								<tr><td><label>I need the floors to be level </label></td><td><input type="checkbox" id="boolean-Reasons_Level_Floors" value="7"><br></td></tr>
								<tr><td><label>I need low steps to board and exit from the bus </label></td><td><input type="checkbox" id="boolean-Reasons_Low_Steps" value="8"><br></td></tr>
								<tr><td><label>I need personal assistance </label></td><td><input type="checkbox" id="boolean-Reasons_Assistance" value="9"><br></td></tr>
								<tr><td><label>I need time to board and exit form the bus</label></td><td><input type="checkbox" id="boolean-Reasons_Board_Time" value="10"><br></td></tr>
								<tr><td><label>I need wheelchair access and restraining systems for my chair and myself</label></td><td><input type="checkbox" id="boolean-Reasons_Wheelchair_Access" value="11"></td></tr>
								<tr><td><label>Other: </label><input type="text" id="input-Reasons_Other"/> </br></td></tr>
							</table>
						</fieldset>
					</div>
                    <input type="text" name="mobility" id="mobility" style='display:none;'/>
                    </br>
                </form>
				<div id="nextButton" onclick="next()">Next</div>
				<div id="submitButton" onclick="submit();">Submit</div>
				<div id="backButton" onclick="back()">Back</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>