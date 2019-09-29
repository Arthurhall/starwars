import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import am4themes_dataviz from "@amcharts/amcharts4/themes/dataviz";
import * as am4plugins_forceDirected from "@amcharts/amcharts4/plugins/forceDirected"; 

$(document).ready(function() {
    var id = 'species-chart-characters';
    var $container = $('#'+id);

    $.get($container.data('chart-url'), function( data ) {
        $container.css({
            width: '100%',
            minWidth: '750px',
            height: '500px'
        });
        am4core.ready(function() {
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create(id, am4plugins_forceDirected.ForceDirectedTree);
            chart.legend = new am4charts.Legend();

            var title = chart.titles.create();
            title.text = $container.data('title');
            title.fontSize = 15;
            title.marginBottom = 10;

            var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries());

            networkSeries.data = data;

            networkSeries.dataFields.linkWith = "linkWith";
            networkSeries.dataFields.name = "name";
            networkSeries.dataFields.id = "name";
            networkSeries.dataFields.value = "value";
            networkSeries.dataFields.children = "children";

            networkSeries.nodes.template.tooltipText = "{name}";
            networkSeries.nodes.template.fillOpacity = 1;

            networkSeries.nodes.template.label.text = "{name}"
            networkSeries.fontSize = 8;
            networkSeries.maxLevels = 2;
            networkSeries.maxRadius = am4core.percent(6);
            networkSeries.manyBodyStrength = -16;
            networkSeries.nodes.template.label.hideOversized = true;
            networkSeries.nodes.template.label.truncate = true;

            $container.after('<hr />');
        });
    }, "json" );
});
