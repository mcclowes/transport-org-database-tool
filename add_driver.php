
<html>
    <head>
        <title>WCT Tool | Add Driver</title>
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
                    'Tel_No':					    document.getElementById('input-Home_Tel_No').value,
                    'Mobile_No':				    document.getElementById('input-Mobile_Tel_No').value,
                    'DOB':                          document.getElementById('date-DOB').value,
                    'Emergency_Name':               document.getElementById('input-Emergency_Name').value,
                    'Emergency_Tel':                document.getElementById('input-Emergency_Tel').value,
                    'Emergency_Relationship':       document.getElementById('input-Emergency_Relationship').value,
                    'Licence_No':       		    document.getElementById('input-Licence_Number').value,
                    'Licence_Expires':       		document.getElementById('date-Licence_Expiry').value,
                    'Licence_Points':       		document.getElementById('input-Licence_Points').value,
                    'DBS_No':       			    document.getElementById('input-DBS_Number').value,
                    'DBS_Issued':       		    document.getElementById('date-DBS_Issue_Date').value,
                    'Is_Volunteer':       			document.getElementById('boolean-Volunteer').value
                };
                
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'addDriver',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        window.location = 'index.php';
                    }
                });
            }

            function populateEditFields(Driver_ID) {
                
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getDriver',
                        'form_data': {'Driver_ID': Driver_ID}
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        document.getElementById('input-fName').value = returned_data['fName'];
                        document.getElementById('input-sName').value = returned_data['sName'];
                        document.getElementById('date-DOB').value = returned_data['DOB'];
                        document.getElementById('input-Home_Tel_No').value = returned_data['Tel_No'];
                        document.getElementById('dropdown-Addresses').value = returned_data['Address_ID'];
                        document.getElementById('input-Line1').value = returned_data['Address']['Line1'];
                        document.getElementById('input-Line2').value = returned_data['Address']['Line2'];
                        document.getElementById('input-Line3').value = returned_data['Address']['Line3'];
                        document.getElementById('input-Line4').value = returned_data['Address']['Line4'];
                        document.getElementById('input-Line5').value = returned_data['Address']['Line5'];
                        document.getElementById('input-Post_Code').value = returned_data['Address']['Post_Code'];
                        document.getElementById('input-Mobile_Tel_No').value = returned_data['Mobile_No'];
                        document.getElementById('input-Licence_Number').value = returned_data['Licence_No'];
                        document.getElementById('input-Licence_Points').value = returned_data['Licence_Points'];
                        document.getElementById('date-Licence_Expiry').value = returned_data['Licence_Expires'];
                        document.getElementById('input-DBS_Number').value = returned_data['DBS_No'];
                        document.getElementById('date-DBS_Issue_Date').value = returned_data['DBS_Issued'];
                        document.getElementById('input-Emergency_Name').value = returned_data['Emergency_Name'];
                        document.getElementById('input-Emergency_Tel').value = returned_data['Emergency_Tel'];
                        document.getElementById('input-Emergency_Relationship').value = returned_data['Emergency_Relationship'];
                        document.getElementById('boolean-Volunteer').value = returned_data['Is_Volunteer'];
                        
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
                            item.textContent = returned_data[i]['Line1'] + ' ' + returned_data[i]['Line2'] + ' ' + returned_data[i]['Line3'] + ' ' + returned_data[i]['Line4'] + ' ' + returned_data[i]['Line5'] + ' ' + returned_data[i]['Post_Code'];
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
                            'form_data': {'Address_ID' : document.getElementById(dropdown).value,}
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
            }

            function cancel(){
                window.location.href = "";
            }

            function startScreen(){

                populateAddresses('dropdown-Addresses');
                $('#page2').hide();
                $('#page3').hide();
                $('#submitButton').hide();
                var i = 0;
                var is_edit = '<?php echo $is_edit; ?>';
                if (is_edit == '1') {
                    Driver_ID = '<?php echo $id; ?>';
                    populateEditFields(Driver_ID);
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
                <!-- bother with for attribute? -->
					<div id="page1">
						<fieldset id="personalDetails">
							<legend>Personal Details</legend>
							<table>
								<tr><td><label>First Name: </label></td><td><input type="text" id="input-fName"/> <td></tr>
								<tr><td><label>Surname: </label></td><td><input type="text" id="input-sName"/> <td></tr>
								<tr><td><label>Date of Birth: </label></td><td><input type="date" id="date-DOB"/> <td></tr>
								<tr><td><label>Home Number: </label></td><td><input type="text" id="input-Home_Tel_No"/> </td></tr>
								<tr><td><label>Mobile Number: </label></td><td><input type="text" id="input-Mobile_Tel_No"/> </td></tr>
                                <tr><td><label>Is Driver a volunteer?</label></td><td>
                                <select id="boolean-Volunteer">
                                    <option value="true">Yes</option> 
                                    <option value="false">No</option>
                                </select></td></tr>
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
						<fieldset id="personalDetails">
                            <legend>Driving License Details</legend>
                            <table>
                                <tr><td><label>License Number: </label></td><td><input type="text" id="input-Licence_Number"/> <td></tr>
                                <tr><td><label>Expiry Date: </label></td><td><input type="date" id="date-Licence_Expiry"/> <td></tr>
                                <tr><td><label>Points on license: </label></td><td><input type="text" id="input-Licence_Points"/> <td></tr>
                                <tr><td><label>DBS Number: </label></td><td><input type="text" id="input-DBS_Number"/> </td></tr>
                                <tr><td><label>DBS Issue Date: </label></td><td><input type="date" id="date-DBS_Issue_Date"/> </td></tr>
                            </table>
                        </fieldset>
					</div>
					<div id="page3">
						<fieldset id="serviceReasons">
							<legend>Photo Upload</legend>
							<tr><td><label>Select File: </label></td><td><input type="file" id="input-fName"/> <td></tr>
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