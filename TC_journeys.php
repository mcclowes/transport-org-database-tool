
<html>
    <head>
        <title>WCT Tool</title>
        <link rel="icon" type="image/png" href="./img/wct_icon.png">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        
        <script type="text/javascript">
        
        	function submit(){
        		
        		add_journey.php
        	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getJourney',
                        'form_data': form_data
                    },
                    dataType: "json",
                    success: function(returned_data) {
                        $('#result').replaceWith('<div id="result">'+returned_data+'</div>');
                    }
                });
            }
            
            function populateJourneys(){
            	var dropdown = document.getElementById('dropdown-Journeys');
            	
                $.ajax({
                    type: "POST",
                    url:"MySQL_Functions.php",
                    data: {
                        'form_type': 'getTCJourneys'
                    },
                    dataType: "json",
                    success: function(returned_data) {
                    	for(var i = 0; i < returned_data.length; i++) {
                    		var item = document.createElement("option");
                    		item.textContent = returned_data[i]['Journey_Description'] + ' (' + returned_data[i]['Journey_Date'] + ')';
                    		item.value = returned_data[i]['Journey_ID'];
                    		dropdown.appendChild(item);
                    	}
                    }
                });
            }

        </script>
        
    </head>
    <body onload='populateJourneys()'>
        <?php include 'nav.php' ?>
        <div id="main">
        	<div>
        	<form method='POST' action='add_journey.php'>
				<tr><td><label>Journeys: </label></td><td>
				<select id="dropdown-Journeys" name='Journey_ID'> 
					<option>Choose a Journey</option>
				</select><td></tr>
				</div>
				<input type="submit" name="submit" value="Submit" />
			</form>
        </div>
    </body>
</html>