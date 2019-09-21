import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

$(document).ready(function() {
    $('#character-chart-year-mass-height').css({
        width: '100%',
        height: '500px'
    });
    $.get($('#character-chart-year-mass-height').data('chart-url'), function( data ) {
        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create('character-chart-year-mass-height', am4charts.XYChart);
            chart.colors.step = 3;

            var title = chart.titles.create();
            title.text = "Characters";
            title.fontSize = 15;
            title.marginBottom = 10;

            var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
            xAxis.renderer.minGridDistance = 50;
            xAxis.title.text = "Year (0 is Battle of Yavin)";

            var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
            yAxis.renderer.minGridDistance = 50;
            yAxis.title.text = "Height";

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
                bullet.tooltipText = "[bold]{label}[/] \n birth year : {valueX}\n height : {valueY}\n mass : {value}";
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

            $('#character-chart-year-mass-height').after('<hr />');
        });
    }, "json" );
});
