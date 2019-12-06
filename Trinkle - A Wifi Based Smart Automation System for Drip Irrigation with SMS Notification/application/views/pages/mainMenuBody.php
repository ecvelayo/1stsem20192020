<!--    peepeepoopoo's whole career 


    Page Content -->
<div class="container-fluid">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/highcharts.css');?>">
    <script src="<?php echo base_url('assets/js/highcharts.js');?>"></script>
    <script src="<?php echo base_url('assets/js/highcharts-more.js');?>"></script>
    <script src="<?php echo base_url('assets/js/solid-gauge.js');?>"></script>
    <script src="<?php echo base_url('assets/img');?>"></script>

    <div id="page-content-wrapper" class="toggled">
    <div class="container-fluid off">       
        <h1 class="mt-4">Current Sensor Readings</h1>
        <br>
        <h2 class="mt-4"><?php echo $crop_data->crop_name?></h2> <!--CROP NAME-->
        <br>
        <div id=""> </div>
         
<br>
<br>
          <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin'){ ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Plants</button>
            <!-- MODAL CROP -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Choose Crop.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-labe="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                 <!--Modal Content -->
                        <form method="POST" action="<?php echo base_url('Pages/use_crop_data')?>">
                        <div class="form-group">
                        <select class="form-control" name="crop_id">
                            <?php 
                                $x = 0;
                                while($x < count($all_crop_data)){
                                    echo "<option id='{$all_crop_data[$x]->crop_id}' value='{$all_crop_data[$x]->crop_id}' >{$all_crop_data[$x]->crop_name}</option>";
                                $x++;
                                }
                            ?>
                        </select>
                        </div>
<!--                         <div class="form-group">
                            <label>ID</label>
                        
                        </div> -- >
                        <!-- <div class="form-group">
                            <label>Name</label>
                            <p class="crop_name" id="get_crop_name">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Soil Moisture Minimum:</label>
                            <p class="crop_soil_min" id="get_soil_min">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Soil Moisture Maximum:</label>
                            <p class="crop_soil_max" id="get_soil_max">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Temperature Minimum:</label>
                            <p class="crop_temp_min" id="get_temp_min">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Temperature Maximum:</label>
                            <p class="crop_temp_max" id="get_temp_max">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Carbon Dioxide Minimum:</label>
                            <p class="crop_carbon_min" id="get_carbon_min">
                            </p>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Carbon Dioxide Maximum:</label>
                            <p class="crop_carbon_max" id="get_carbon_max">
                            </p>
                        </div> -->
                        <div class="form-group" style="margin-left: 40%">
                            <input type="submit" value="Submit" class="btn btn-success"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>

        <div class="form-row">
            <div class="form-group col-md-5  offset-3">
                <br>
                <br>
                <label for="plant_status">Status:</label>
                <input type="text" readonly class="form-control" id="plant_status_valve" name="condition" 
                value="<?php if($valve_status) { echo"The valve is currently open."; }else{ echo"The valve is currently closed."; } ?>" required="required">
                <input type="text" readonly class="form-control" id="plant_status" name="condition" placeholder="System is Monitoring..." required="required">
            </div>
        </div>
        <br>
        <br>
        <div class="container-fluid">
            <?php echo "<h3 class='mt-4'>Threshold:</h3>";
                    echo "<h4 class='mt-4'>";
                    echo "<div class=' offset-1'><span class='oi oi-droplet'></span> Soil Moisture $crop_data->soilmoisture_min - $crop_data->soilmoisture_max,";
                    echo"<br>";
                    
                    echo "<span><i class='fa fa-thermometer'></i></span> Temperature $crop_data->temperature_min - $crop_data->temperature_max,";
                    echo "<br>"; 
                    echo "Carbon Dioxide $crop_data->min_carbon_dioxide - $crop_data->max_carbon_dioxide </div>";
                    echo "</h4>";
                ?>
            <div class="row section-box">
                <div class="outer">
               <p>
            <?php
                echo '<div id="container-soilmoisture" class="chart-container">Soil Moisture </div>';
            //echo "{$load_latest->soilmoisture_value}";
            ?>
            <p>
            <?php
                echo '<div id="container-temperature" class="chart-container">Temperature</div>';
                    //echo "{$load_latest->temperature_value}";
            ?>
            <p>
            <?php
                echo '<div id="container-carbondioxide" class="chart-container">Carbon Dioxide</div>';
                echo "<br>";
                    //echo "{$load_latest->humidity_value}";
            ?>
            </p>
            </p>
            </p>
            
            </div>
        </div>
    </div>  
    <!-- /#page-content-wrapper -->
  </div>
</div>
  <script>

$(document).ready(function(){    
      requestData();
});

var gaugeOptions = {

    chart: {
        type: 'solidgauge',
        events: {
            load: requestData
        }
    },

    title: null,

    pane: {
        center: ['50%', '85%'],
        size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    tooltip: {
        enabled: false
    },

    // the value axis
    yAxis: {
        stops: [
            [0.1, '#55BF3B'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#DF5353'] // red
        ],
        lineWidth: 0,
        minorTickInterval: null,
        tickAmount: 2,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

// The soil moisture gauge

var chartSoilMoisture = Highcharts.chart('container-soilmoisture', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: 'Soil Moisture'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Soil Moisture',
        data: [<?php echo $load_latest->soilmoisture_value ?>],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">%</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));

var chartTemperature = Highcharts.chart('container-temperature', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: 'Temperature'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Temperature',
        data: [<?php echo $load_latest->temperature_value?>],
        //data: [20], //Placeholder Value
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">°C</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));

var chartCarbonDioxide = Highcharts.chart('container-carbondioxide', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1000,
        title: {
            text: 'Carbon Dioxide'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Carbon Dioxide',
        data: [<?php echo $load_latest->carbondioxide_value?>],
        //data: [500], //Placeholder Value
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">Parts per million (ppm) </span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));


/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
 
function requestData() {
    var base_url = "<?php echo base_url()?>";
    var pointSoil;
    var pointTemp;
    var pointCarbon;
    $.ajax({
        url: base_url + "Pages/latest_data",

        dataType: "json",
        success: function(data) {
            // var series = chart.series[0],
            //     shift = series.data.length > 20; // shift if the series is 
            //                                      // longer than 20

            // // add the point
            //chart.series[0].addPoint(point, true, shift);
            //chart.series[0].data = data.soilmoisture_value;
            // call it again after one second
            //console.log(data.soilmoisture_value);
            //setTimeout(requestData, 2000);    
            if(data.soilmoisture_value >= 0 && data.soilmoisture_value <= 1024){
                console.log(data.soilmoisture_value);
                pointSoil = chartSoilMoisture.series[0].points[0];
                pointTemp = chartTemperature.series[0].points[0];
                pointCarbon = chartCarbonDioxide.series[0].points[0];
                pointSoil.update(Math.round(data.soilmoisture_value));
                pointTemp.update(Math.round(data.temperature_value));
                pointCarbon.update(Math.round(data.carbondioxide_value));

            }
            setTimeout(requestData, 1000);   
        },
        cache: false
    });
}

function append_crop_info(clicked_id){
    console.log("brother");
     var base_url = "<?php echo base_url()?>";
       $.ajax({
            type: "POST",
            url : base_url +"Pages/append_crop_data",
            data: {
              id : clicked_id
            },
            dataType: "json",
            success: function(data) {
              console.log(data);
                
               $('#get_crop_name').text(data[0].crop_name);
               $('#get_soil_min').text(data[0].soilmoisture_min);
               $('#get_soil_max').text(data[0].soilmoisture_max);
               $('#get_temp_min').text(data[0].temperature_min);
               $('#get_temp_max').text(data[0].temperature_max);
               $('#get_carbon_min').text(data[0].min_carbon_dioxide);
               $('#get_carbon_max').text(data[0].max_carbon_dioxide);
            },
            error: function(data){
              alert("Error appending user data. ");
            }
            });
    }
 </script>