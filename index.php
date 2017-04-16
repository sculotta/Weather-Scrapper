<?php

	$weather ="";
	$error = "";

	if($_GET['city']) {

		$city = str_replace(' ', '', $_GET['city']);

		$file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    	$error = "That city could not be found.";

	    } else {



		$forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");

		$pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);

				if (sizeof ($pageArray) > 1) {

				$secondPageArray = explode('</span></span>', $pageArray[1]);

				if (sizeof($secondPageArray) > 1) {

				$weather = $secondPageArray[0];

			} else {

				$error = "That city could not be found.";


			}

			} else { 

				$error = "That city could not be found.";


			}

		}

	}





?>


<html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title> Weather Scraper PHP </title> 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>

    <div class="container"> 
    		<h1> Check the Weather out! </h1>
<form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city</label>
    <input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp" placeholder="e.g London,Toronto" value= "<?php echo $_GET['city']; ?>">
  </fieldset>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

	<div id="weather"><?php 

	if ($weather) {

		echo '<div class="alert alert-success" role="alert">'.$weather.'
</div>';
	} else if ($error) {
		echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
	}



	?></div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>