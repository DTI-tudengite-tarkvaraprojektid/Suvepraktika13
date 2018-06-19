$(document).ready(function(){
  $.ajax({
    url : "http://sisekliima.000webhostapp.com/sensordata.php",
    type : "GET",
    success : function(data){
      console.log(data);

      var time = [];
      var ruum = [];
	  var valgus = [];
	
      for(var i in data) {
        time.push(data[i].time);
        valgus.push(data[i].valgus);
        ruum.push(data[i].ruum);
      }

      var chartdata = {
        labels: time,
        datasets: [
		  {
            label: "VALGUSTIHEDUS(lx)",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(59, 89, 152, 0.75)",
            borderColor: "rgba(0,0,0,100)",
            pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            pointHoverBorderColor: "rgba(0,0,0,100)",
            data: valgus
          }]
    };
    var options = {
      responsive: true,
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
        value: 200,
        borderColor: 'rgb(255,0,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,          
          content: 'Arhiivid(200lx)'
        }
      },
      {
        id: 'line2',
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 300,
        borderColor: 'rgb(255,0,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,          
          content: 'Vastuvõtuletid, dokumendisäilitus jne(300lx)'
        }
      },{
        id: 'line3',
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 500,
        borderColor: 'rgb(255,0,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,          
          content: 'Töökabinetid, õpperuumid jne(500lx)'
        }
      },{
        id: 'line4',
        type: 'line',
        mode: 'horizontal',
        scaleID: 'y-axis-0',
        value: 750,
        borderColor: 'rgb(255,0,0)',
        borderWidth: 2,
        label: {
          enabled: true,
          fontSize: 18,          
          content: 'Joonestamine(750lx)'
        }
      }
      ]}
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