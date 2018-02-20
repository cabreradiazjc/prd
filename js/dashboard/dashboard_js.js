
window.onload = function(){
	profile();
	//espaciosChart();
	//incidence();
	//emergencySVT();
	//lastApertura();
	isUpdated();
	//users();
	//lastIn();
	//lastSvt();
	info();
}

function profile(){
	var user =  $('#user').val();
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'profile', user: user},
		url: '../../controller/labels/information_controller.php',
		success: function(respuesta){
			$('#profile').html(respuesta);


		},
		error: function(respuesta){
			$('#profile').html(respuesta);
		}
	});	
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



function isUpdated(){
	$.ajax({

		type: 'POST',
		data:{param_opcion: 'isUpdated'},

		url: '../../controller/dashboard/dashboard_controller.php',

		success: function(respuesta){

			if(respuesta==1){
				 $.toast({
		            heading: 'Bitácoras Actualizadas',
		            text: '¡Gracias por mantener al día nuestro sistema!',
		            position: 'top-right',
		            loaderBg:'#009e69',
		            icon: 'success',
		            hideAfter: 3500, 
		            stack: 6,
		            bgColor: '#23ce9e'
		          });
			}else
			{
				$.toast({
		            heading: 'Bitácoras Desactualizadas',
		            text: 'Por favor, revisar las bitácoras y llenar las faltantes.',
		            position: 'top-right',
		            loaderBg:'#ff6849',
		            icon: 'error',
		            hideAfter: 3500
		            
		          });
			}
			

		},
		error: function(respuesta){
			
		}
	});	
}

$(function() {
    "use strict";
      $(".isUpdated").click(function(){
      	$.ajax({

			type: 'POST',
			data:{param_opcion: 'isUpdated'},

			url: '../../controller/dashboard/dashboard_controller.php',

			success: function(respuesta){
				if(respuesta==1){
					 $.toast({
			            heading: 'Bitácoras Actualizadas',
			            text: '¡Gracias por mantener al día nuestro sistema!',
			            position: 'top-right',
			            loaderBg:'#009e69',
			            icon: 'success',
			            hideAfter: 3500, 
			            stack: 6,
			            bgColor: '#23ce9e'
			          });
				}else
				{
					$.toast({
			            heading: 'Bitácoras Desactualizadas',
			            text: 'Por favor, revisar las bitácoras y llenar las faltantes.',
			            position: 'top-right',
			            loaderBg:'#ff6849',
			            icon: 'error',
			            hideAfter: 3500
			          });
				}
				

			},
			error: function(respuesta){
				
			}
		});	

     });

});

/*
function isUpdated(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'isUpdated'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#isUpdated').html(respuesta);


		},
		error: function(respuesta){
			$('#isUpdated').html(respuesta);
		}
	});	
}

function lastSvt(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'lastSvt'},

		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			//$('#table_lastIn').DataTable().destroy();
			$('#lastSvt').html(respuesta);
			

		},
		error: function(respuesta){
			$('#lastSvt').html(respuesta);
		}
	});	
}



function lastIn(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'lastIn'},

		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			//$('#table_lastIn').DataTable().destroy();
			$('#body_lastIn').html(respuesta);
			

		},
		error: function(respuesta){
			$('#body_lastIn').html(respuesta);
		}
	});	
}


function users(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'users'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#users').html(respuesta);


		},
		error: function(respuesta){
			$('#users').html(respuesta);
		}
	});	
}



function lastApertura(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'lastApertura'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#lastApertura').html(respuesta);


		},
		error: function(respuesta){
			$('#lastApertura').html(respuesta);
		}
	});	
}

function emergencySVT(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'emergencySVT'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#emergencySVT').html(respuesta);


		},
		error: function(respuesta){
			$('#emergencySVT').html(respuesta);
		}
	});	
}

function espaciosChart(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'espaciosChart'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#espaciosChart').html(respuesta);


		},
		error: function(respuesta){
			$('#espaciosChart').html(respuesta);
		}
	});	
}

function incidence(){
	$.ajax({
		type: 'POST',
		data:{param_opcion: 'incidence'},
		url: 'controller/dashboard/dashboard_controller.php',
		success: function(respuesta){
			$('#incidence').html(respuesta);


		},
		error: function(respuesta){
			$('#incidence').html(respuesta);
		}
	});	
}


$.ajax({
	 	type: 'POST',
	 	data:{param_opcion: 'chartAperturabt'},
	    url: 'controller/dashboard/dashboard_controller.php',
	        
	    success : function(data) {

	      //chartData = data;
	      //console.log(data);
	     'use strict';

		   // LINE CHART
	    var line = new Morris.Line({
	      element: 'line-chart',
	      resize: true,
	      data: data,
		    xkey: 'fecha',
		    ykeys: ['hora'],
		    labels: ['Hora'],
		    lineColors: ['#3c8dbc'],
		    hideHover: 'auto',
		   xLabels: 'day',
		    yLabelFormat: function(y) {
				  return y = '0' + y + ':00 a.m.';
				},
			hoverCallback: function (index, options, content,row) {
			    var data = options.data[index];
        		return data.fecha;
        		
			  }
		    });

			    },
		error: function(data){
			
		}
	});




$(function() {




	$.ajax({
		type: 'POST',
		data:{param_opcion: 'pieChartSVT'},
		url: 'controller/dashboard/dashboard_controller.php',
		//dataType: "json",
		success: function(data){
			

			var svt_ambiente = [];
			var total = [];

			for(var i in data) {
				svt_ambiente.push(data[i].svt_ambiente);
				total.push(data[i].total);
			}


			console.log(svt_ambiente);
			console.log(total[1]);

			 // -------------
			  // - PIE CHART -
			  // -------------
			  // Get context with jQuery - using jQuery's .get() method.
			  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
			  var pieChart       = new Chart(pieChartCanvas);
			  var PieData        = [
                {
                  value    : total[0],
                  color    : '#4289f1',
                  highlight: '#4289f1',
                  label    : svt_ambiente[0]
                },
                {
                  value    : total[1],
                  color    : '#8ec0d8',
                  highlight: '#8ec0d8',
                  label    : svt_ambiente[1]
                },
                {
                  value    : total[2],
                  color    : '#97e1b3',
                  highlight: '#97e1b3',
                  label    : svt_ambiente[2]
                },
                {
                  value    : total[3],
                  color    : '#eed896',
                  highlight: '#eed896',
                  label    : svt_ambiente[3]
                },
                {
                  value    : total[4],
                  color    : '#e3b2b2',
                  highlight: '#e3b2b2',
                  label    : svt_ambiente[4]
                },
                {
                  value    : total[5],
                  color    : '#fff941',
                  highlight: '#fff941',
                  label    : svt_ambiente[5]
                },
                {
                  value    : total[6],
                  color    : '#9f6480',
                  highlight: '#9f6480',
                  label    : svt_ambiente[6]
                },
                {
                  value    : total[7],
                  color    : '#cfbaea',
                  highlight: '#cfbaea',
                  label    : svt_ambiente[7]
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
			    tooltipTemplate      : '<%=value %> <%=label%>'
			  };
			  // Create pie or douhnut chart
			  // You can switch between pie and douhnut using the method below.
			  pieChart.Doughnut(PieData, pieOptions);
			  // -----------------
			  // - END PIE CHART -
			  // -----------------

			  },
		error: function(respuesta){
			$('#pieChart').html(respuesta);
		}
	});	

});

*/


