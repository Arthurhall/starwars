import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import am4themes_dataviz from "@amcharts/amcharts4/themes/dataviz";

$(document).ready(function() {
    var id = 'starship-chart-price';
    var $container = $('#'+id);

    $container.css({
        width: '100%',
        height: '500px'
    });
    $.get($container.data('chart-url'), function( data ) {
        am4core.ready(function() {
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create(id, am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();

            var title = chart.titles.create();
            title.text = $container.data('title');
            title.fontSize = 15;
            title.marginBottom = 10;

            chart.data = data;

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "name";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.logarithmic = true;
            valueAxis.renderer.minWidth = 50;
            valueAxis.numberFormatter = new am4core.NumberFormatter();
            valueAxis.numberFormatter.numberFormat = "# a";
            valueAxis.title.text = $container.data('y-axis-title');

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "price";
            series.dataFields.categoryX = "name";
            series.tooltipText = "[{categoryX} : bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

            // on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function(fill, target) {
              return chart.colors.getIndex(target.dataItem.index);
            });

            var speedValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            speedValueAxis.renderer.opposite = true;
            speedValueAxis.renderer.grid.template.disabled = true;
            speedValueAxis.cursorTooltipEnabled = false;

            var speedSeries = chart.series.push(new am4charts.LineSeries());
            speedSeries.dataFields.valueY = "speed";
            speedSeries.dataFields.categoryX = "name";
            speedSeries.yAxis = speedValueAxis;
            speedSeries.tooltipText = $container.data('speed') + " : {valueY}";
            speedSeries.bullets.push(new am4charts.CircleBullet());
            speedSeries.strokeWidth = 2;
            speedSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
            speedSeries.strokeOpacity = 0.5;

            // Cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panX";

            $container.after('<hr />');
        });
    }, "json" );
});
