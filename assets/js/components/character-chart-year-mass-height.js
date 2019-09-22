import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import am4themes_dataviz from "@amcharts/amcharts4/themes/dataviz";

$(document).ready(function() {
    var id = 'character-chart-year-mass-height';
    var $container = $('#'+id);

    $.get($container.data('chart-url'), function( data ) {
        $container.css({
            width: '100%',
            height: '500px'
        });
        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            am4core.useTheme(am4themes_dataviz);

            var chart = am4core.create(id, am4charts.XYChart);
            chart.colors.step = 3;

            var title = chart.titles.create();
            title.text = $container.data('title');
            title.fontSize = 15;
            title.marginBottom = 10;

            var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
            xAxis.renderer.minGridDistance = 50;
            xAxis.title.text = $container.data('x-axis-title');

            var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
            yAxis.renderer.minGridDistance = 50;
            yAxis.title.text = $container.data('y-axis-title');

            $.each(data, function (i, val) {
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "y";
                series.dataFields.valueX = "x";
                series.dataFields.value = "r";
                series.dataFields.label = "label";
                series.strokeOpacity = 0;
                series.name = val.label;
                series.data = val.data;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.strokeOpacity = 0.2;
                bullet.stroke = am4core.color("#ffffff");
                bullet.nonScalingStroke = true;
                bullet.tooltipText = "[bold]{label}[/] \n "
                    + $container.data('birth-year') + " : {valueX}\n "
                    + $container.data('height') + " : {valueY}\n "
                    + $container.data('mass') + " : {value}";
                series.heatRules.push({
                  target: bullet.circle,
                  min: 10,
                  max: 60,
                  property: "radius"
                });
            });

            chart.scrollbarX = new am4core.Scrollbar();
            chart.scrollbarY = new am4core.Scrollbar();
            chart.legend = new am4charts.Legend();

            $container.after('<hr />');
        });
    }, "json" );
});
