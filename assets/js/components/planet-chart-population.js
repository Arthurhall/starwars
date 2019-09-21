import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

$(document).ready(function() {
    $('#planet-chart-population').css({
        width: '100%',
        height: '500px'
    });
    $.get($('#planet-chart-population').data('chart-url'), function( data ) {
        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("planet-chart-population", am4charts.PieChart);

            var title = chart.titles.create();
            title.text = "Population by climate";
            title.fontSize = 15;
            title.marginBottom = 10;

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "population";
            pieSeries.dataFields.category = "climate";

            // Let's cut a hole in our Pie chart the size of 30% the radius
            chart.innerRadius = am4core.percent(30);

            // Put a thick white border around each Slice
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.slices.template
              // change the cursor on hover to make it apparent the object can be interacted with
              .cursorOverStyle = [
                {
                  "property": "cursor",
                  "value": "pointer"
                }
              ];

            pieSeries.labels.template.bent = true;
            pieSeries.labels.template.radius = 3;
            pieSeries.labels.template.padding(0,0,0,0);

            // Create a base filter effect (as if it's not there) for the hover to return to
            var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
            shadow.opacity = 0;

            // Create hover state
            var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

            // Slightly shift the shadow and make it more prominent on hover
            var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
            hoverShadow.opacity = 0.7;
            hoverShadow.blur = 5;

            // Add a legend
            chart.legend = new am4charts.Legend();

            chart.data = data;

            $('#planet-chart-population').after('<hr />');
        });
    }, "json" );
});
