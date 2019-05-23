$(function () {
    var BASEURL = window.location.origin + '/graymotion/admin/';
    $.get(BASEURL + 'getGraph', function(data) {
        chart1(data);
    }, 'json');

    function chart1(data) {
        $('#chart1').highcharts({
            title: {
                text: '',
            },
            xAxis: {
                categories: data.date
            },
            yAxis: {
                title: {
                    text: 'Graph'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            credits: false,
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Quantity',
                data: data.qty
            }, {
                name: 'Type',
                data: data.type
            }]
        });
    }
});