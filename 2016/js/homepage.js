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


var countdown = document.getElementById("countdown");

var interval = setInterval(function () {

  var newAmount = countdown.textContent - 3;
  countdown.textContent = newAmount;

  if (newAmount === parseInt(149)) {
    clearInterval(interval);
  }
}, 10);

var today    = moment();
var confDate = moment("2016-05-16");

document.getElementById("days-left").textContent = Math.abs(confDate.diff(today,'days'));




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