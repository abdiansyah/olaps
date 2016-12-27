<script src="<?php echo base_url('assets/plugins/highcharts/jquery-1.9.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/highcharts/js/highcharts.js');?>"></script>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>                   
                </ol>
                <!--Deklaration Carousel-->
<div class="carousel-inner" role="listbox">
    <div class="item active">
        <div class="col-md-8 col-md-offset-2" id="monitor_new_authorization"></div>
    </div>
    <div class="item">
        <div class="col-md-8 col-md-offset-2" id="monitor_renewal"></div>
    </div>
</div>
 </div>

<script type="text/javascript">
$().ready(function(){
    Highcharts.chart('monitor_new_authorization', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'New Authorization'
        },        
        xAxis: {
            categories: ['GMF Authorization', 'Certifying Staff', 'EASA Authorization', 'C of C'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Applicant',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            align: 'left',
            x: 5,
            verticalAlign: 'bottom',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203]
        }, {
            name: 'Year 1900',
            data: [133, 156, 947, 408]
        }, {
            name: 'Year 2012',
            data: [1052, 954, 420, 740]
        },{
            name : 'Year 2016',
          data : [1000, 900, 400, 200]
        }]
    });
});

$().ready(function(){
    Highcharts.chart('monitor_renewal', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Renewal'
        },        
        xAxis: {
            categories: ['GMF Authorization', 'Certifying Staff', 'EASA Authorization', 'C of C'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Applicant',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            align: 'left',
            x: 5,
            verticalAlign: 'bottom',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203]
        }, {
            name: 'Year 1900',
            data: [133, 156, 947, 408]
        }, {
            name: 'Year 2012',
            data: [1052, 954, 420, 740]
        },{
            name : 'Year 2016',
          data : [1000, 900, 400, 200]
        }]
    });
});
</script>

