$(document).ready(function(){
  $.ajax({
    url : "http://sisekliima.000webhostapp.com/sensordata.php",
    type : "GET",
    success : function(data){
      console.log(data);

      var time = [];
      var ruum = [];
	  var temperatuur = [];
	
      for(var i in data) {
        time.push(data[i].time);
        temperatuur.push(data[i].temperatuur);
        ruum.push(data[i].ruum);
      }

      var chartdata = {
        labels: time,
        datasets: [
		  {
            label: "TEMPERATUUR(ºC)",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(0,0,0,100)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(0,0,0,100)",
            data: temperatuur
          }]
    };
    var options = {
      responsive: true,
    scales: {
        xAxes: [{
            display: true,
            scaleLabel: {
                display: true,
            }
        }],
        yAxes: [{
            display: true,
            ticks: {
                min: 5,
                max: 40,
                stepSize: 5
            }
        }]
                },        
      tooltips: {
        mode: 'index',
        intersect: true
      },
      annotation: {
        annotations: [{
        id: 'line1',
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 19,
        borderColor: 'rgb(255,0,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,          
          content: 'Alampiir'
        }
      },
      {
        id: 'line2',
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 25,
        borderColor: 'rgb(255,69,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,
          content: 'Ülempiir'
        }
      }]
    }
  };
      
      var ctx = $("#mycanvas");

      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        options: options
	  });
    },
    error : function(data) {
    }
    
  });
});