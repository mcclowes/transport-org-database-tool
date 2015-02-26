
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="table_sorter_api/themes/blue/style.css" type="text/css" media="screen" />
        
		<script type="text/javascript" src="jQuery/jquery-2.1.3.min.js"></script> 
		<script type="text/javascript" src="table_sorter_api/jquery.tablesorter.js"></script> 
		<script type="text/javascript" src="table_sorter_api/jquery.tablesorter.widgets.js"></script>
        
        <script type="text/javascript">
        
            function submit(id){
                window.location = 'show_driver_info.php?id=' + id;
            }
            
            function populateDrivers(){
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getDrivers'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	var table_body = document.getElementById('table_body');
                        for(var i = 0; i < returned_data.length; i++) {
							var id = returned_data[i]['Driver_ID'];
							
							var row = table_body.insertRow();
							row.id = ('Driver_ID' + id);
							
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['fName'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['sName'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['DOB'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Address']['Post_Code'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Tel_No'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Mobile_No'];
							var cell = row.insertCell();
							cell.innerHTML = returned_data[i]['Is_Volunteer'];

 							var button = row.insertCell();
 							button.innerHTML = '<div class="button" id="view-' + id + '" onclick="submit(' + id + ')">View</div>';
                        }
                        $("table").tablesorter(); 
                        $("table").trigger("update"); 
                    }
                });
            }
        </script>
    </head>
    <body onload='populateDrivers()'>
        <div id="wctLogo"></div>
        <?php include 'nav.php' ?>
        <div id="page_wrapper">
			<div id="main">
				<div>
					<table cellspacing="1" class="tablesorter">
						<thead>
							<tr>
								<th>Forename</th>
								<th>Surname</th>
								<th>Date of Birth</th>
								<th>Post Code</th>
								<th>Telephone number</th>
								<th>Mobile number</th>
								<th>Volunteer</th>
							</tr>
						</thead>
						<tbody id='table_body'>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </body>
</html>