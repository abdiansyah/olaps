<script src="<?php echo base_url('assets/plugins/highcharts/jquery-1.9.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/highcharts/js/highcharts.js');?>"></script>





<?php

    foreach($report as $result){
        $status[] = $result->status;
        $value[] = (float) $result->total_applicant;
    }
     
?>

<div class="col-sm-4" id="report"></div>

 
<script type="text/javascript">
$(function () {
    $('#report').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'License Application Status'
        },    
        xAxis: {
            categories: <?php echo json_encode($status);?>,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'License Application Status',
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
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: <?php echo json_encode($status);?>,
            data: <?php echo json_encode($value);?>,
        }]
    });
});
</script>

