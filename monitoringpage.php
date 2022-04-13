<?php
$servername = "localhost";

// REPLACE with your Database name
$dbname = "MBKM";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM sensordata ORDER BY id DESC limit 1";

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $row_reading_time = $row["reading_time"];
    }
}

$power_bar = $row_value1;
$voltage_bar = ($row_value2*100)/12;
$current_bar = ($row_value3*100)/2;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Smart PV Monitoring</title>
    <link rel="stylesheet" href="style.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="link.css" />
    <link rel="stylesheet" href="stylemonitoringpage.css"/>
    <link rel="stylesheet" href="sliderbutton.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <script src="buttonchecking.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Container Outer covering whole page -->
    <div class="container-xl">
        <!-- Start of Navbar -->
        <nav style="margin-top:3vh; width: 100%;" class="center navbarmonitor">
            <div style="justify-content: space-between;" class="d-flex flex-row bd-highlight ">
                <div class="p-2 bd-highlight">
                    <div >
                        <img style="max-width:50%;max-height:auto" src="assets/img/logoSmartPV2.png">
                    </div>
                </div>
                <div class="p-2 bd-highlight"></div>
                <div class="p-2 bd-highlight"></div>
                <div class="p-2 bd-highlight"></div>
                <div class="p-2 bd-highlight"></div>
                <div class="p-2 bd-highlight">
                    <div>
                        <img style="width:35px;max-height:auto;align-items: flex-end;" src="assets/img/ProfileLogo.png">
                    </div>
                </div>
            </div>  
        </nav>
        <!-- End of Navbar -->

        <!-- Start of 2 main Flex -->
        <div style="justify-content: space-between;" class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <!-- Start of Left Flex Section -->
                <div class="d-flex flex-column bd-highlight mb-3">
                    <!-- Start of Control Button -->
                    <div class="p-2 bd-highlight controlswitchpanel">
                        <div class="d-flex flex-row bd-highlight ">
                            <div class="p-2 bd-highlight">
                                <div class="subjudul">Control</div>
                            </div>
                            <div class="p-1 bd-highlight"></div>
                            <div class="p-1 bd-highlight"></div>
                            <div class="p-1 bd-highlight"></div>
                            <div class="p-1 bd-highlight"></div>
                            <div class="p-1 bd-highlight">
                                <label class="switch">
                                    <input type="checkbox" id="togBtn">
                                    <div class="slider round">
                                     <!--ADDED HTML -->
                                     <span class="on">ON</span>
                                     <span class="off">OFF</span>
                                     <!--END-->
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- End of Control Button -->
                    
                    <!-- Start of Main Load Summary Bar Graph -->
                    <div style="margin-top:1vh;" class="p-2 bd-highlight controlswitchpanel">
                        <div class="d-flex flex-row bd-highlight ">
                            <!-- Start of Main Load Title -->
                            <div class="p-1 bd-highlight">
                                <div class="p-2 bd-highlight">
                                    <img style="max-width: 20px; max-height: auto;" src="assets/img/homelogo.png">
                                </div>
                            </div>
                            <div class="p-2 bd-highlight">
                                <div style="margin-left:5px" class="subjudul">Main Load</div>
                            </div>
                            <!-- End of Main Load Title -->    
                        </div> 
                        <!-- Start of Summary Graph: Power Section -->
                        <div class="d-flex flex-row bd-highlight ">
                            <!-- Start of Upper title of Power Section -->
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 47px;" class="subsubjudul">Power</div>
                            </div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 25px;" class="subsubjudul"><?=$power_bar?></div>
                            </div>
                            <div class="p-2 bd-highlight">
                                <div class="subsubjudul">Watt</div>
                            </div>
                            <!-- End of Upper title of Power Section -->
                        </div>
                        

                        <!-- Start of the Power Graph -->
                        <div class="d-flex flex-row bd-highlight ">
                            <div class="bd-highlight graphbar">
                                <div class="p-1 bd-highlight graphbar">
                                    <div class="progress progress-bar" role="progressbar" style="width:<?= $power_bar?>%; height: 3vh; background: #006CFF;border-radius: 61px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div> 
                        </div>
                        <!-- End of the Power Graph -->
                        <!-- End of Summary Graph: Power Section -->
                        
                        <!-- Start of Summary Graph: Voltage Section -->
                        <!-- Start of Upper title of Voltage Section -->
                        <div class="d-flex flex-row bd-highlight ">
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 47px;" class="subsubjudul">Voltage</div>
                            </div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 25px;" class="subsubjudul"><?=$row_value2?></div>
                            </div>
                            <div class="p-2 bd-highlight">
                                <div class="subsubjudul">Volt</div>
                            </div>
                        </div>
                        <!-- End of Upper title of Voltage Section -->
                        
                        <!-- Start of Voltage Graph -->
                        <div class="d-flex flex-row bd-highlight ">
                            <div class="p-1 bd-highlight graphbar">
                                <div class="progress progress-bar" role="progressbar" style="width: <?=$voltage_bar?>%; height: 3vh; background: #00AE86;border-radius: 61px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> 
                        </div>
                        <!-- End of Voltage Graph -->
                        <!-- End of Summary Graph: Voltage Section -->

                        <!-- Start of Summary Graph: Current Section -->
                        <!-- Start of Upper title of Current Section -->
                        <div class="d-flex flex-row bd-highlight ">
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 47px;" class="subsubjudul">Current</div>
                            </div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            <div class="p-2 bd-highlight"></div>
                            
                            <div class="p-2 bd-highlight">
                                <div style="min-width: 25px;" class="subsubjudul">
                                    <?=$row_value3?>
                                </div>
                            </div>
                            <div class="p-2 bd-highlight">
                                <div class="subsubjudul">A</div>
                            </div>
                        </div>
                        <!-- End of Upper title of Current Section -->

                        <!-- Start of Current Graph -->
                        <div class="d-flex flex-row bd-highlight mb-4">
                            <div class="bd-highlight graphbar">
                                <div class="p-1 bd-highlight graphbar">
                                    <div class="progress progress-bar" role="progressbar" style="width:<?=$current_bar?>%; height: 3vh; background: #FF902E;border-radius: 61px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div> 
                        </div>
                        <!-- End of Current Graph -->
                        <!-- End of Summary Graph: Current Section -->
                    </div>
                    <!-- End of Main Load Summary Bar Graph -->
                   
                    <!-- Start of Battery Monitoring Section -->
                    <div style="margin-top: 1vh;" class="p-2 bd-highlight controlswitchpanel">
                        <div class="d-flex flex-row bd-highlight ">
                            <div style="margin-top: 3vh ;" class="p-2 bd-highlight">
                                <img style="width:25px;max-height:auto;" src="assets/img/batterylogo.png">
                            </div>
                            <div style="max-width: 50px; margin-left: 5px;margin-top: 3vh;" class="bd-highlight">
                                <div class="subsubjudul">Battery Voltage</div>
                            </div>
                            <div style="font-size: 40px !important; margin-left: 5px; margin-right: 45px;" class="p-2 bd-highlight">
                                <?=$row_value2?>
                            </div>
                            <div style="margin-top: 25px;" class="p-1 bd-highlight">
                                <div class="subsubjudul">Volt</div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Battery Monitoring Section -->
                </div>
                <!-- End of Left Flex Section -->
            </div>
            
            <div class="p-2 bd-highlight ">
            <!-- Start of Right Flex Section -->
            <div class="d-flex flex-column bd-highlight mb-3 controlswitchpanel">
                <div style="justify-content: space-between;" class="p-2 bd-highlight">
                    <div class="d-flex flex-row bd-highlight ">
                        <div class="p-2 bd-highlight">
                        <!-- Start of Power Button Right Flex -->
                        <div>
                            <button id="power" style="padding-left: 4vw;padding-right: 4vw;border-radius: 61px;"onclick="changeBg(this);" class="powerflexkanan textflexkanan">
                                Power
                            </button>
                        </div>
                        <!-- End of Power Button Right Flex -->
                        </div>
                        <div class="p-2 bd-highlight">
                        <!-- Start of Voltage Button Right Flex -->
                        <div>
                            <button id="volt" style="padding-left: 4vw;padding-right: 4vw;border-radius: 61px;"onclick="changeBg(this);" class="voltflexkanan textflexkanan">
                                Voltage
                            </button>
                        </div>
                        <!-- End of Voltage Button Right Flex -->
                        </div>
                        <div class="p-2 bd-highlight">
                        <!-- Start of Current Button Right Flex -->
                        <div>
                            <button id="arus" style="padding-left: 4vw;padding-right: 4vw;border-radius: 61px;"onclick="changeBg(this);" class="currentflexkanan textflexkanan">
                                Current
                            </button>
                        </div>
                        <!-- End of Current Button Right Flex -->
                        </div>
                    </div>
                </div>
                <div class="p-2 bd-highlight mb-3">Flex item 2
                    <div id="linegrafik">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div id="linegrafik2">
                        <canvas id="myChart2"></canvas>
                    </div>
                    <div id="linegrafik3">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
              </div>
             <!-- End of Right Flex Section -->
            </div>
        </div>
    </div>
</body>

<script>
   let myChart = document.getElementById('myChart').getContext('2d');
   let bagan1 = new Chart(myChart, {
    type: 'line', //tipe grafik: line, pie, bar, dll.
    data:{
        labels : ['January', 'February', 'March', 'April'],
        datasets:[{
            label:'',
            data:[50, 40, 75, 87],
            backgroundColor:'#006CFF',
            borderColor:'#006CFF',
            borderWidth: 1
        }]
    },
    options:{}
   });
</script>

<script>
   let myChart2 = document.getElementById('myChart2').getContext('2d');
   let bagan2 = new Chart(myChart2, {
    type: 'line', //tipe grafik: line, pie, bar, dll.
    data:{
        labels : ['January', 'February', 'March', 'April'],
        datasets:[{
            label:'',
            data:[30, 10, 25, 47],
            backgroundColor: '#00A16A',
            borderColor: '#00A16A',
            borderWidth: 1
        }]
    },
    options:{}
   });
</script>

<script>
   let myChart3 = document.getElementById('myChart3').getContext('2d');
   let bagan3 = new Chart(myChart3, {
    type: 'line', //tipe grafik: line, pie, bar, dll.
    data:{
        labels : ['January', 'February', 'March', 'April'],
        datasets:[{
            label:'',
            data:[89, 77, 38, 52],
            backgroundColor: '#FF902E',
            borderColor: '#FF902E',
            borderWidth: 1
        }]
    },
    options:{
        
    }
   });
</script>

</html>