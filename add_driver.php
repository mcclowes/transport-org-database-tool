
<html>
    <head>
        <title>WCT Tool | Add Driver</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script type="text/javascript">
            function submit() {
                form_data = {
                    'fName':                        document.getElementById('input-fName').value,
                    'sName':                        document.getElementById('input-sName').value,
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