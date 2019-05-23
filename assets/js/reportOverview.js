$(function () {
    var BASEURL = window.location.origin + '/graymotion/admin/';
    $.get(BASEURL + 'report/income/getGraph', function(data) {
        var series = [{
                showInLegend: false, 
                name: 'Income',
                data: data.total
            }];
            chart1(data, series);
    }, 'json');

    $('.btn-cart').click(function() {
        var type = $(this).attr('data-type');

        $.get(BASEURL + 'report/' + type + '/getGraph', function(data) {
            if(type == 'income') {
                var series = [{
                    showInLegend: false,
                    name: 'Income',
                    data: data.total
                }];
            }
            else if(type == 'quantity') {
                var series = [{
                    name: 'Quantity',
                    data: data.qty
                }, {
                    name: 'Type',
                    data: data.type
                }];
            }

            chart1(data, series);
        }, 'json')
    })


    function chart1(data, series) {
        $('#chartku').highcharts({
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
            series: series
            
        });
    }
});