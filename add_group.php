
<html>
    <head>
        <title>WCT Tool | Add Group</title>
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
            function submit() {
                form_data = {
                    'Name':                         document.getElementById('input-Name').value,
                    'Address_Tel':                  document.getElementById('input-Tel_No').value,
                    'Address_ID':                   document.getElementById('dropdown-Addresses').value,
                    'Address':{
                        'Line1':                    document.getElementById('input-Address_Line1').value,
                        'Line2':                    document.getElementById('input-Address_Line2').value,
                        'Line3':                    document.getElementById('input-Address_Line3').value,
                        'Line4':                    document.getElementById('input-Address_Line4').value,
                        'Line5':                    document.getElementById('input-Address_Line5').value,
                        'Post_Code':                document.getElementById('input-Address_Post_Code').value
                    },
                    'Invoice_Address_ID':           document.getElementById('dropdown-Invoice_Addresses').value,
                    'Invoice_Address':{
                        'Line1':                    document.getElementById('input-Invoice_Line1').value,
                        'Line2':                    document.getElementById('input-Invoice_Line2').value,
                        'Line3':                    document.getElementById('input-Invoice_Line3').value,
                        'Line4':                    document.getElementById('input-Invoice_Line4').value,
                        'Line5':                    document.getElementById('input-Invoice_Line5').value,
                        'Post_Code':                document.getElementById('input-Invoice_Post_Code').value
                    },
                    'Invoice_Email':				document.getElementById('input-Email').value,
                    'Invoice_Tel':					document.getElementById('input-Invoice_Tel').value,
                    'Emergency_Name':               document.getElementById('input-Emergency_Name').value,
                    'Emergency_Tel':                document.getElementById('input-Emergency_Tel').value,
                    'Profitable':           		document.getElementById('boolean-Profitable').value,
                    'Community':					document.getElementById('boolean-Community').value,
                    'Social':						document.getElementById('boolean-Social').value,
                    'Statutory':					document.getElementById('boolean-Statutory').value,
                    'Charity_No':					document.getElementById('input-Charity_No').value,
                    'Org_Aim':						document.getElementById('input-Org_Aim').value,
                    'Activities_Education':			document.getElementById('boolean-Activities_Education').checked,
                    'Activities_Recreation':		document.getElementById('boolean-Activities_Recreation').checked,
                    'Activities_Health':			document.getElementById('boolean-Activities_Health').checked,
                    'Activities_Religion':			document.getElementById('boolean-Activities_Religion').checked,
                    'Activities_Social':			document.getElementById('boolean-Activities_Social').checked,
                    'Activities_Inclusion':			document.getElementById('boolean-Activities_Inclusion').checked,
                    'Activities_Other':		        document.getElementById('input-input_Activities_Other').value,
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
                        window.location = 'index.php';
                    }
                });
            }


            function populateEditFields(Group_ID) {
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getGroup',
                        'form_data': {'Group_ID': Group_ID}
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        //alert(JSON.stringify(returned_data));
                        document.getElementById('input-Name').value = returned_data['Name'];
                        document.getElementById('input-Tel_No').value = returned_data['Address_Tel'];
                        document.getElementById('input-Email').value = returned_data['Invoice_Email'];
                        document.getElementById('dropdown-Addresses').value = returned_data['Address_ID'];
                        document.getElementById('input-Address_Line1').value = returned_data['Address']['Line1'];
                        document.getElementById('input-Address_Line2').value = returned_data['Address']['Line2'];
                        document.getElementById('input-Address_Line3').value = returned_data['Address']['Line3'];
                        document.getElementById('input-Address_Line4').value = returned_data['Address']['Line4'];
                        document.getElementById('input-Address_Line5').value = returned_data['Address']['Line5'];
                        document.getElementById('input-Address_Post_Code').value = returned_data['Address']['Post_Code'];
                        document.getElementById('input-Invoice_Tel').value = returned_data['Invoice_Tel'];
                        document.getElementById('dropdown-Invoice_Addresses').value = returned_data['Invoice_Address_ID'];
                        document.getElementById('input-Invoice_Line1').value = returned_data['Invoice']['Line1'];
                        document.getElementById('input-Invoice_Line2').value = returned_data['Invoice']['Line2'];
                        document.getElementById('input-Invoice_Line3').value = returned_data['Invoice']['Line3'];
                        document.getElementById('input-Invoice_Line4').value = returned_data['Invoice']['Line4'];
                        document.getElementById('input-Invoice_Line5').value = returned_data['Invoice']['Line5'];
                        document.getElementById('input-Invoice_Post_Code').value = returned_data['Invoice']['Post_Code'];
                        document.getElementById('input-Emergency_Name').value = returned_data['Emergency_Name'];
                        document.getElementById('input-Emergency_Tel').value = returned_data['Emergency_Tel'];   
                        document.getElementById('input-Profitable').value = returned_data['Profitable'];
                        document.getElementById('boolean-Community').value = returned_data['Community'];
                        document.getElementById('boolean-Social').value = returned_data['Social'];
                        document.getElementById('boolean-Statutory').value = returned_data['Statutory'];
                        document.getElementById('input-Charity_No').value = returned_data['Charity_No'];
                        document.getElementById('input-Org_Aim').value = returned_data['Org_Aim'];
                        document.getElementById('boolean-Activities_Education').value = returned_data['Activities_Education'];
                        document.getElementById('boolean-Activities_Recreation').value = returned_data['Activities_Recreation'];
                        document.getElementById('boolean-Activities_Health').value = returned_data['Activities_Health'];
                        document.getElementById('boolean-Activities_Religion').value = returned_data['Activities_Religion'];
                        document.getElementById('boolean-Activities_Social').value = returned_data['Activities_Social'];
                        document.getElementById('boolean-Activities_Inclusion').value = returned_data['Activities_Inclusion'];
                        document.getElementById('input-Activities_Other').value = returned_data['Activities_Other'];
                        document.getElementById('boolean-Concerned_Physical').value = returned_data['Concerned_Physical'];
                        document.getElementById('boolean-Concerned_Learning').value = returned_data['Concerned_Learning'];
                        document.getElementById('boolean-Concerned_Mental_Health').value = returned_data['Concerned_Mental_Health'];
                        document.getElementById('boolean-Concerned_Ethnic').value = returned_data['Concerned_Ethnic'];
                        document.getElementById('boolean-Concerned_Alcohol').value = returned_data['Concerned_Alcohol'];
                        document.getElementById('boolean-Concerned_Drug').value = returned_data['Concerned_Drug'];
                        document.getElementById('boolean-Concerned_HIV_AIDS').value = returned_data['Concerned_HIV_AIDS'];
                        document.getElementById('boolean-Concerned_Socially_Isolated').value = returned_data['Concerned_Socially_Isolated'];
                        document.getElementById('boolean-Concerned_Dementia').value = returned_data['Concerned_Dementia'];
                        document.getElementById('boolean-Concerned_Elderly').value = returned_data['Concerned_Elderly'];
                        document.getElementById('boolean-Concerned_Pre_School').value = returned_data['Concerned_Pre_School'];
                        document.getElementById('boolean-Concerned_Young').value = returned_data['Concerned_Young'];
                        document.getElementById('boolean-Concerned_Women').value = returned_data['Concerned_Women'];
                        document.getElementById('boolean-Concerned_Health').value = returned_data['Concerned_Health'];
                        document.getElementById('boolean-Concerned_Rurally_Isolated').value = returned_data['Concerned_Rurally_Isolated'];
                        document.getElementById('input-Concerned_Other').value = returned_data['Concerned_Other'];
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
                populateAddresses('dropdown-Invoice_Addresses');
                $('#page2').hide();
                $('#page3').hide();
                $('#backButton').hide();
                $('#submitButton').hide();
                var i = 0;
                var is_edit = '<?php echo $is_edit; ?>';
                if (is_edit == '1') {
                    Group_ID = '<?php echo $id; ?>';
                    populateEditFields(Group_ID);
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
								<tr><td><label>Organisation Name: </label></td><td><input type="text" id="input-Name"/> <td></tr>
								<tr><td><label>Contact Email: </label></td><td><input type="email" id="input-Email"/> <td></tr>
								<tr><td><label>Contact Number: </label></td><td><input type="text" id="input-Tel_No"/> </td></tr>
							</table>
						</fieldset>
						<fieldset id="organisationAddress">
							<legend>Organisation Address</legend>
							<table>
                                <tr><td><label>Stored Addresses: </label></td>
                                <td><select id="dropdown-Addresses" onchange="addAddress('input-Address_', 'dropdown-Addresses')"> 
                                    <option>Choose an existing address</option>
                                </select></td>
                                <td>
                                <div id="addTCMember" onclick="clearAddress('input-Address_', 'dropdown-Addresses')">Clear</div>
                                </td></tr>
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
                                <tr><td><label>Stored Addresses: </label></td>
                                <td><select id="dropdown-Invoice_Addresses" onchange="addAddress('input-Invoice_', 'dropdown-Invoice_Addresses')"> 
                                    <option>Choose an existing address</option>
                                </select></td>
                                <td>
                                <div id="addTCMember" onclick="clearAddress('input-Invoice_', 'dropdown-Invoice_Addresses')">Clear</div>
                                </td></tr>
								<tr><td><label>Phone number: </label></td><td><input type="text" id="input-Invoice_Tel"/> </td></tr>
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
							</table>
						</fieldset>
					</div>
					<div id="page2">
						<fieldset id="orgStatus">
							<legend>Organisational Status</legend>
                            <h2>Is your group...</h2>
							<table>
								<tr><td><label>Profit making?</label></td><td><input type="checkbox" id="boolean-Profitable" value="1"><br></td></tr>
								<tr><td><label>A community/voluntary group?</label></td><td><input type="checkbox" id="boolean-Community" value="1"><br></td></tr>
                                <tr><td><label>A social/family group?</label></td><td><input type="checkbox" id="boolean-Social" value="1"><br></td></tr>
                                <tr><td><label>A statutory body?</label></td><td><input type="checkbox" id="boolean-Statutory" value="1"><br></td></tr>
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
				<div id="backButton" onclick="back()">Back</div>
				<div id="cancelButton" onclick="cancel()">Cancel</div>
				<div id='result'></div> 
            </div>
        </div>
    </body>
</html>