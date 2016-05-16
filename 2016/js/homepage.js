(function adjustElements ($) {

	var $confHeader = $('#conf-header');
	$confHeader.idealRatio = 768/1283;

	var $win = $(window);

	function adjustHeaderAndVideoSizing (e) {
		var width = e.target.innerWidth;
		$confHeader.css('min-height', width * $confHeader.idealRatio);
	}


	// On Initialization
	adjustHeaderAndVideoSizing({
		target: {
			innerWidth: $win.width()
		}
	});

	// On Reize
	$win.resize(adjustHeaderAndVideoSizing);

})(jQuery);


(function neuralNetwork ($) {

var $body = $('body');

var width  = $body.width();
var height = parseInt($body.width() * 768/1283);

// If height is less than 480 make the svg square
height = (height >= 480) ? height: width;

var counter = 0;
var intervalID;

var colors = ["#402168","#C22C8C","#ECC354","#4571B9","#9F351F"]; // d3.scale.category20();

// Make all <span> in neural network match color

$('.neural-network').find('span').each(function (i){
  $(this).css('color',colors[i]);
});

var nodes = [];
var links = [];

var force = d3.layout.force()
    .nodes(nodes)
    .links(links)
    .charge(-200)
    .linkDistance(120)
    .size([width, height])
    .on("tick", tick);

var svg = d3.select("#neural-network")
    .attr("width", width)
    .attr("height", height);


var node = svg.selectAll(".node");
var link = svg.selectAll(".link");


function main () {
  counter++;

  nodes.push({
    id: counter,
    group: Math.floor(Math.random() * 5),
    value: Math.floor(Math.random() * 3)
  });

  if (nodes.length >= 2) {

    for (var i = 0; i < Math.ceil(Math.random() * nodes.length); i++) {

      if (Math.random() > 0.7) {
        links.push({
          source: nodes[counter - 1],
          target: nodes[i]
        });        
      }
      // links.push({source: nodes[counter - 1], target: nodes[counter - 2]});  
    };
  }

  if (nodes.length === 45) {
    clearInterval(intervalID);
  }
  
  start();
}

main();
intervalID = setInterval(main, 3000);


function start() {
  link = link.data(force.links(), function (d) { return d.source.id + "-" + d.target.id; });
  link
    .enter()
    .insert("line", ".node")
    .attr("class", "link")
    .style("stroke-width", function (d) { return Math.sqrt(d.value); })
  ;
  link.exit().remove();

  node = node.data(force.nodes(), function (d) { return d.id;});
  node
    .enter()
    .append("circle")
    .attr("class", function (d) { return "node " + d.id; })
    .attr("r",     function (d) { return 8 + d.value;    })
    .style("fill", function (d) { return colors[d.group];})
  ;

  node.exit().remove();

  force.start();
}

function tick() {
  node.attr("cx", function (d) { return d.x; })
      .attr("cy", function (d) { return d.y; })

  link.attr("x1", function (d) { return d.source.x; })
      .attr("y1", function (d) { return d.source.y; })
      .attr("x2", function (d) { return d.target.x; })
      .attr("y2", function (d) { return d.target.y; });
}

})(jQuery);


angular.module('ScheduleApp', []).controller("ScheduleController",function ($scope, $http, $sce) {

  $scope.trustSnippet = function(data) {
    return $sce.trustAsHtml(data);
  };

  $scope.eventOrder = function (d) {

    var title = d["Session Title"];
    var prefix = ['A:', 'B:','C:','4Space:'];

    for (var i = 0; i < prefix.length; i++) {
      if (title.indexOf(prefix[i])) {
        d.startTime += i;    
      }
    }

    return d.startTime;
  }


  var url = window.location.origin.indexOf('localhost') > -1 ? 'http://localhost/issst/2016':'http://issst2016.net';
  url    += '/wp-content/themes/2016/schedule.csv';

  var query = $http.get(url);

  query.then(function (response) {

    $scope.data = response.data;

    var rows     = response.data.split('\n"13');
    var headers  = rows.shift().split(',').map(function (d) {

      d = d.replace(/"/g,'').replace(/\(/g,'').replace(/\)/g,'').replace(" Optional",'');

      if (d.indexOf("Description") > -1) {
        d = "Description";
      }
      return d;

    });

    rows = rows.map(function (row) {

      var o = {};

      row = row.split(',"');

      row.forEach(function (cell, index) {

        var lastChar = cell[cell.length -1];

        if (lastChar === "\"") {
          cell = cell.substring(0, cell.length - 1);
        }

        if (cell[0] === "\"") {
          cell = cell.substring(1, cell.length);
        }

        if (index === 7 && cell[cell.length - 2] === "\"") {
          cell = cell.substring(0, cell.length - 2);
        }

        o[headers[index]] = cell;
      });


      var startTime = o.Date +" ";

      if (o["Time Start"].indexOf('PM') > -1) {
        startTime += o["Time Start"].replace(/(.*):/, (parseInt(o["Time Start"].match(/(.*):/)[1]) + 12) + ":").replace('PM','');
      } else {
        startTime += o["Time Start"].replace('AM','')
      }

      o.startTime = new Date(startTime).getTime();

      return o;
    });

    var days = {};

    for (var i = 0; i < rows.length; i++) {

      var row = rows.shift();
      var day = row.Date;

      if (!days[day]) {
        days[day] = [];
      }

      days[day].push(row);
    };

    for (var k in days) {
      var newK = moment(new Date(k)).format("dddd, MMM Do");
      days[newK] = days[k];
      delete days[k];
    }

    $scope.days = days;

    console.log(days);
  });
});