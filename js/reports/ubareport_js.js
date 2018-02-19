
window.onload = function(){
	$("#overlay").hide();
	$("#report").hide();
	info();
}

function info(){
	var user =  $('#user').val();
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'listar_info', user: user},
		url: '../../controller/labels/information_controller.php',
		
		success: function(respuesta){

			$('#info').html(respuesta);

		},
		error: function(respuesta){
			$('#info').html(respuesta);
		}
	});	
}



$(function() {

$('#btn_ubareport').on('click', function(){
	$.ajax({
		type: 'POST',
		data: $('#frm_ubareport').serialize()+'&param_opcion=pieChartUBA',
		url: '../../controller/reports/ubareports_controller.php',
		//dataType: "json",
		beforeSend: function(){
			$("#overlay").show();
			$("#report").hide();

		},

		success: function(data){
			

			var horas = [];
			var operaciones = [];

			for(var i in data) {
				horas.push(data[i].horas);
				operaciones.push(data[i].operaciones);
			}


			console.log(horas);
			console.log(operaciones[1]);
			$("#overlay").hide(); 
			$("#report").show();
			 // -------------
			  // - PIE CHART -
			  // -------------
			  // Get context with jQuery - using jQuery's .get() method.
			  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
			  var pieChart       = new Chart(pieChartCanvas);
			  var PieData        = [
                {
                  value    : operaciones[0],
                  color    : '#f56954',
                  highlight: '#f56954',
                  label    : horas[0]
                },
                {
                  value    : operaciones[1],
                  color    : '#00a65a',
                  highlight: '#00a65a',
                  label    : horas[1]
                },
                {
                  value    : operaciones[2],
                  color    : '#f39c12',
                  highlight: '#f39c12',
                  label    : horas[2]
                },
                {
                  value    : operaciones[3],
                  color    : '#00c0ef',
                  highlight: '#00c0ef',
                  label    : horas[3]
                },
                {
                  value    : operaciones[4],
                  color    : '#3c8dbc',
                  highlight: '#3c8dbc',
                  label    : horas[4]
                },
                {
                  value    : operaciones[5],
                  color    : '#d2d6de',
                  highlight: '#d2d6de',
                  label    : horas[5]
                },
                {
                  value    : operaciones[6],
                  color    : '#001f3f',
                  highlight: '#001f3f',
                  label    : horas[6]
                },
                {
                  value    : operaciones[7],
                  color    : '#39cccc',
                  highlight: '#39cccc',
                  label    : horas[7]
                }
              ]
			  var pieOptions     = {
			    // Boolean - Whether we should show a stroke on each segment
			    segmentShowStroke    : true,
			    // String - The colour of each segment stroke
			    segmentStrokeColor   : '#fff',
			    // Number - The width of each segment stroke
			    segmentStrokeWidth   : 1,
			    // Number - The percentage of the chart that we cut out of the middle
			    percentageInnerCutout: 50, // This is 0 for Pie charts
			    // Number - Amount of animation steps
			    animationSteps       : 100,
			    // String - Animation easing effect
			    animationEasing      : 'easeOutBounce',
			    // Boolean - Whether we animate the rotation of the Doughnut
			    animateRotate        : true,
			    // Boolean - Whether we animate scaling the Doughnut from the centre
			    animateScale         : false,
			    // Boolean - whether to make the chart responsive to window resizing
			    responsive           : true,
			    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			    maintainAspectRatio  : false,
			    // String - A legend template
			    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
			    // String - A tooltip template
			    tooltipTemplate      : '<%=label%> >> <%=value %>'
			  };
			  // Create pie or douhnut chart
			  // You can switch between pie and douhnut using the method below.
			  pieChart.clear();
			  pieChart.Doughnut(PieData, pieOptions);
			  // -----------------
			  // - END PIE CHART -
			  // -----------------

			  },
		error: function(respuesta){
			$('#pieChart').html('No data available');
			}
		});	

	});

});




