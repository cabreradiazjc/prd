
window.onload = function(){
	listar_year();
  
}

function listar_year() {
    $.ajax({
        type: 'POST',
        data: {param_opcion: 'listar_year'},
        url: '../../controller/reports/aperturabt_controller.php',
        success: function (respuesta) {
           
            $('#param_year').html(respuesta);
        },
        error: function (respuesta) {
            $('#param_year').html(respuesta);
        }
    });

}

function chartAperturabt(){

     $.ajax({
        type: 'POST',
        data:{param_opcion: 'chartAperturabt'},
        url: '../../controller/dashboard/dashboard_controller.php',
            
        success : function(data) {

           
    
        },
        error: function(data){      
            }
    });

}





$(function() {

      //Fecha
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        } 

        if(mm<10) {
            mm = '0'+mm
        } 

        today = yyyy + '-' + mm + '-' + dd;
        //document.write(today);
        //end fecha

    $('#r_aperturabt_year').on('click', function(){

      


        var year = $('#param_year').val();

        

        if (year.length == '' ) {            
            $("#mensaje").html(
                '<div class="alert alert-warning alert-dismissible">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3>'+
                'Debe llenar los campos necesarios</div>').show(200).delay(3500).hide(200);
        } else {
            $.ajax({
                type: 'POST',        
                data: 'param_year='+year+'&param_opcion=r_aperturabt_year',
                url: '../../controller/reports/aperturabt_controller.php',
                success: function(data){
                    swal("Good job!", "¡Guardado satisfactoriamente!", "success");
                                //window.location = "../index.php";
                    $('#param_opcion').val('');
                        var fecha = [];
                        var hora = [];

                        for(var i in data) {
                            fecha.push(data[i].fecha);
                            hora.push(data[i].hora);
                        }

                        //console.log(fecha);
                        var chart = new Chartist.Line('.campaign', {
                        labels: fecha,
                        series: [
                           hora
                            
                          ]}, {
                        
                        showArea: true,
                        fullWidth: true,
                        
                         chartPadding: {
                            right: 40,
                            left: 20
                          },
                            
                            axisY: {
                            onlyInteger: false
                            , scaleMinSpace: 40    
                            , offset: 20
                            , labelInterpolationFnc: function (value) {
                                var decimalTimeString = value;
                                var decimalTime = parseFloat(decimalTimeString);
                                decimalTime = decimalTime * 60 * 60;
                                var hours = Math.floor((decimalTime / (60 * 60)));
                                decimalTime = decimalTime - (hours * 60 * 60);
                                var minutes = Math.floor((decimalTime / 60));
                                decimalTime = decimalTime - (minutes * 60);
                                var seconds = Math.round(decimalTime);
                                if(hours < 10)
                                {
                                    hours = "0" + hours;
                                }
                                if(minutes < 10)
                                {
                                    minutes = "0" + minutes;
                                }
                                if(seconds < 10)
                                {
                                    seconds = "0" + seconds;
                                }
                                

                                return ("" + hours + ":" + minutes);
                            }
                        },
                        });

                            // Offset x1 a tiny amount so that the straight stroke gets a bounding box
                            // Straight lines don't get a bounding box 
                            // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
                            chart.on('draw', function(ctx) {  
                              if(ctx.type === 'area') {    
                                ctx.element.attr({
                                  x1: ctx.x1 + 0.001
                                });
                              }
                            });

                            // Create the gradient definition on created event (always after chart re-render)
                            chart.on('created', function(ctx) {
                              var defs = ctx.svg.elem('defs');
                              defs.elem('linearGradient', {
                                id: 'gradient',
                                x1: 0,
                                y1: 1,
                                x2: 0,
                                y2: 0
                              }).elem('stop', {
                                offset: 0,
                                'stop-color': 'rgba(255, 255, 255, 1)'
                              }).parent().elem('stop', {
                                offset: 1,
                                'stop-color': 'rgba(38, 198, 218, 1)'
                              });
                            });
                        
                                
                            var chart = [chart];


                            // ============================================================== 
                            // This is for the animation
                            // ==============================================================
                            
                            for (var i = 0; i < chart.length; i++) {
                                chart[i].on('draw', function(data) {
                                    if (data.type === 'line' || data.type === 'area') {
                                        data.element.animate({
                                            d: {
                                                begin: 500 * data.index,
                                                dur: 500,
                                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                                to: data.path.clone().stringify(),
                                                easing: Chartist.Svg.Easing.easeInOutElastic
                                            }
                                        });
                                    }
                                    if (data.type === 'bar') {
                                        data.element.animate({
                                            y2: {
                                                dur: 500,
                                                from: data.y1,
                                                to: data.y2,
                                                easing: Chartist.Svg.Easing.easeInOutElastic
                                            },
                                            opacity: {
                                                dur: 500,
                                                from: 0,
                                                to: 1,
                                                easing: Chartist.Svg.Easing.easeInOutElastic
                                            }
                                        });
                                    }
                                });
                            }

                },
                error: function(data){
                           
                } 
            });
        }
        
    });



});
