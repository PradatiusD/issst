(function adjustElements ($) {

	var $confHeader = $('#conf-header');
	$confHeader.idealRatio = 768/1283;

	var $win = $(window);

	function adjustHeaderAndVideoSizing (e) {
		var width = e.target.innerWidth;

		$confHeader.css('min-height', width * $confHeader.idealRatio);

		var $phoenixSkyline = $('#my-video');
		$phoenixSkyline.idealRatio = 0.56338028169;  // or 240/426;

		$phoenixSkyline.css({
			width: width,
			height: width * $phoenixSkyline.idealRatio
		});
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





(function neuralNetwork() {

var width  = 1283;
var height = 768;

var colors = d3.scale.category20();

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

console.log("yay",svg);

var node = svg.selectAll(".node"),
    link = svg.selectAll(".link");

// 1. Add three nodes and three links.


// file:///Applications/MAMP/htdocs/issst/wp-content/issst/test.html

var counter = 0;
var intervalID;

function main () {
  counter++;

  nodes.push({
    id: counter,
    group: Math.floor(Math.random() * 5),
    value: Math.floor(Math.random() * 3)
  })

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
  link = link.data(force.links(), function(d) { return d.source.id + "-" + d.target.id; });
  link
    .enter()
    .insert("line", ".node")
    .attr("class", "link")
    .style("stroke-width", function(d) { return Math.sqrt(d.value); })
  ;
  link.exit().remove();

  node = node.data(force.nodes(), function(d) { return d.id;});
  node
    .enter()
    .append("circle")
    .attr("class", function(d) { return "node " + d.id; })
    .attr("r", 8)
    .style("fill", function(d) { return colors(d.group); })
  ;

  node.exit().remove();

  force.start();
}

function tick() {
  node.attr("cx", function(d) { return d.x; })
      .attr("cy", function(d) { return d.y; })

  link.attr("x1", function(d) { return d.source.x; })
      .attr("y1", function(d) { return d.source.y; })
      .attr("x2", function(d) { return d.target.x; })
      .attr("y2", function(d) { return d.target.y; });
}

})()