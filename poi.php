<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boeing 360</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Style Sheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,900;1,400&family=Ubuntu:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- NAVIGATION -->
    <section id="NAV">
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand nav-brand-text" href="index.html">BOEING 360°</a>
            
            <button class="navbar-toggler custom-nav-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-text currentLink" href="index.html"> <img class="nav-bar-icon" src="imgs/home-img.png" alt="live-camera-img">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-text" href="live-cam.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="nav-bar-icon" src="imgs/live-camera-img.png" alt="live-camera-img">Camera</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="front-cam-cv.html">Front Camera View</a>
                            <a class="dropdown-item" href="rear-cam-cv.html">Rear Camera View</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text" href="live-map.html"><img class="nav-bar-icon" src="imgs/live-map-img.png" alt="live-map-img"> Map</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text" href="poi.php">POI Test</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>


    <!-- MAIN -->
    <section id="MAIN">
        <form method = "POST" action = "" name = "action">
            <label for = "lat">Latitude: </label>
                <select name="lat" id="lat">
                    <option value="47.662">47.662</option>
                    <option value="47.663">47.663</option>
                    <option value="47.664">47.664</option>
                    <option value="47.665">47.665</option>
                    <option value="47.666">47.666</option>
                    <option value="47.667">47.667</option>
                </select>
            <br><br>

            <label for = "long">Longitude: </label>
                <select name = "long" id = "long">
                    <option value="-117.39">-117.39</option>
                    <option value="-117.40">-117.40</option>
                    <option value="-117.41">-117.41</option>
                    <option value="-117.42">-117.42</option>
                    <option value="-117.43">-117.43</option>
                </select>
            <br><br>

            <label for = "radius">Radius: </label>
            <input name = "radius" type = "number">

            <input type = "Submit" Value = "Get POIs">
        </form>
        <?php
            function getDistance($lat1, $lon1, $lat2, $lon2) {
                if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                    return 0;
                }
                else {
                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles = $dist * 60 * 1.1515;
                    return $miles;
                }
            }

            function runPOIFunction($latitude, $longitude, $radius) {
                $Radius = $radius;
                // Get standard key-value array
                // $config = parse_ini_file("config.ini");
                $server = "cps-database.gonzaga.edu";
                $username = "lmason2";
                $password = "Gozagsxc17";
                $database = "lmason2_DB";
        
                // connect
                $conn = mysqli_connect($server, $username, $password, $database);

                // check connection
                if (!$conn) {
                    die('Error: ' . mysqli_connect_error());
                    console.log("error"); 
                }
        
                // the query
                $query = "SELECT p.POI_Name, p.POI_Description, p.POI_Lat, p.POI_Long
                        FROM PointOfInterest p;";

                $result = mysqli_query($conn, $query);
            
                // get the results (each row bound to the variables
                if (mysqli_num_rows($result) > 0) {
                    echo "<p>Radius: " . $Radius . "</p>";
                    echo "<p>Test Lat: " . $latitude . "</p>";
                    echo "<p>Test Long: " . $longitude . "</p>";

                    echo "<table>\n";
                    echo "<tr>\n";
                    echo "<th>POI Name</th>\n";
                    echo "<th>POI Description</th>\n";
                    echo "<th>POI Latitude</th>\n";
                    echo "<th>POI Longitude</th>\n";
                    echo "<th>Distance</th>\n";
                    echo "</tr>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        $PLat = $row["POI_Lat"];
                        $PLong = $row["POI_Long"];
                        $distance = getDistance($PLat, $PLong, $latitude, $longitude);
                        if ($distance < $Radius) {
                            echo "<tr>\n";
                            echo "<td>" . $row["POI_Name"] . "</td>" . "\n";
                            echo "<td>" . $row["POI_Description"] . "</td>" . "\n";
                            echo "<td>" . $row["POI_Lat"] . "</td>" . "\n";
                            echo "<td>" . $row["POI_Long"] . "</td>" . "\n";
                            echo "<td>" . $distance . "</td>" . "\n";
                            echo "</tr>\n";
                        }
                    }
                    echo "</table>";
                }
                else {
                    echo "<p class = \"center-class\">No Results<p>\n";
                }
                
                mysqli_close($conn);
            }

            if(isset($_POST['lat'])) {
                $latitude = $_POST['lat'];
                $longitude = $_POST['lon'];
                $radius = $_POST['radius'];
                runPOIFunction($latitude, $longitude, $radius);
            }
            else {
                echo "<p>Not set in form</p>";
            }
        ?>

    </section>

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>

    // Attempt at doing timer for internal javascript  
    <!-- <script>
        $lat = 47;
        $long = -117;
        function fetchdata(){
            $.ajax({ 
                method: "POST",
                dataType: "html", 
                url: "poi.php",
                data: {'action': "runPOIFunction",
                       'lat': $lat, 
                       'lon': $long},
                success: function(data) {
                    console.log(data);
                }, 
                error: function(xhr){
                    alert('Error');
                }
            });
        }

        $(document).ready(function(){
            setInterval(fetchdata,1000);
        });
    </script> -->

</body>


</html>