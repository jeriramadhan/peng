<?php 
	session_start(); 
  include "login/ceksession.php";
  echo $_SESSION['id'];?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Javascript Geolocation Tracking Demo
    </title>
      		<?php include "header.php"; ?>
  		<!-- Left side column. contains the logo and sidebar -->
  		<?php include "menu.php"; ?>
    <script>
      var track = {
        display : null, // Holder for the <p> element, for visual feedback
        rider : <?php echo $_SESSION['id'];?>, // Rider ID - Hardcode this somewhere in your own system session or in the web app
        delay : 20000, // Delay in between each position update, in milliseconds
        timer : null, // Holder for the interval object
        update : function () {
        // track.update() : update server of current location

          navigator.geolocation.getCurrentPosition(function (pos) {
            // AJAX DATA
            var data = new FormData();
            data.append('req', 'update');
            data.append('rider_id', track.rider);
            data.append('lat', pos.coords.latitude);
            data.append('lng', pos.coords.longitude);

            // AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "2c-ajax-track.php", true);
            xhr.onload = function () {
              var res = JSON.parse(this.response);
              // OK
              if (res.status==1) {
                track.display.innerHTML = "Lat: " + pos.coords.latitude + " Lng: " + pos.coords.longitude;
              }
              // ERROR
              else {
                track.display.innerHTML = res.message;
              }
            };
            xhr.send(data);
          });
        }
      };

      // INIT ON PAGE LOAD
      window.addEventListener("load", function(){
        track.display = document.getElementById("display");
        if (navigator.geolocation) {
          // Set on an interval so that you don't drain the smartphone battery
          // Nor kill the server for the matter
          track.update();
          setInterval(track.update, track.delay);
        } else {
          track.display.innerHTML = "Geolocation is not supported by your browser!";
        }
      });
    </script>
  </head>
  <body>
    <p id="display"></p>
    <p>
      This is a demo tracking page.
      You will normally create a rider login page, or convert this into a webapp.
      For those who do not know - Check out Phonegap and Ionic.
    </p>
  </body>
</html>