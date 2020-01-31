<?php
    

    $weather = "";
    $error = "";

  if (array_key_exists('city', $_GET)) {


      $city = str_replace(' ', '', $_GET['city']);

      $file = 'http://www.domain.com/somefile.jpg';
      $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
      
      if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        
         $error = "That city could not be found - please check the name again ";
        
    } else {

         $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
      
         $pageArray = explode('3 days):</div><p class="location-summary__text"><span class="phrase">',$forecastPage);

      if (sizeof($pageArray) > 1) {
      
          $secondPageArray = explode('</span></p></div>',$pageArray[1]); 
          if (sizeof($secondPageArray) > 1) {
     
             $weather = $secondPageArray[0];

          } else {

            $error = "That city could not be found";


          }

      } else {


        $error = "That city could not be found";



      }
  
    }
  
} 


?>  

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Weather Scraper!</title>

  
  </head>
  <body>
    <div class="container">

    <h1>What's the Weather?</h1>
    

    <form>
  <div class="form-group">
    <label for="city"><p>Enter the name of a city.</p></label>
    <input type="text" name="city" class="form-control" id="city" placeholder="Eg. NewYork, Tokyo" value="<?php 
    
    if (array_key_exists('city', $_GET)) {
    
     echo $_GET['city']; 
                                                                                                     
    }                                                                                       
                                                                                                                                                             
          ?>">
    <small class="form-text text-muted"></small>
  </div>
 <br> 
  
 <button id="buttonColor" type="submit" class="btn btn-primary">Submit</button>
    
       
</form>
<br>
                          <div id="weather"><?php
                          if ($weather) {
                              echo '<div class="alert alert-success" role="alert">' .$weather.'</div>' ;

                          } else if ($error) {
                            echo '<div class="alert alert-danger" role="alert">' .$error.'</div>' ;

                        }




                          
                          ?></div>
<br> <br> <br>
    </div>


      





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  
  </body>
</html>