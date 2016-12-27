/**
 * class 
 * @event
 * Digunakan pada class
 */

function loadChart(render)
{
    chart = new Highcharts.Chart({
        chart: {
            renderTo: render,
            type: 'column'
        },
        credits: {
            enabled: false
        },  
        title: {
            text: '<a style="color:white;" href="'+F.base_url()+'index.php/report/chart/'+render+'"> Test'</a>'
        },
        
        xAxis: {
            categories: ['']
        },
        yAxis: {
            min: 0,
            title: {
                text: false
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:12px">{series.name}</span>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span> : <b>{point.y:.2f}%</b>'
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    color: '#FFF',
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        lang: {
            showDetail: 'Show detail'
        },
        /*
        exporting: {
            buttons: {
                printButton: {
                    symbol: 'circle',
                    _titleKey: 'showDetail',
                    onclick: function () {
                        window.location = F.base_url()+'report/chart/'+render;
                    }
                }
            }
        },
        */
        series: [{
            name: 'Total Applicant',
            data: [total_applicant]
        }]
    });
}