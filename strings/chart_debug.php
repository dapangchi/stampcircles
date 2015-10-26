<?php
	//Include Class
	require_once('GoogleGraph.php');

	//Create Object
	$graph = new GoogleGraph();
	
	//Graph
	$graph->Graph->setType('line');       //line bar pie venn scatter
	$graph->Graph->setSubtype('chart');   //chart or axis
	$graph->Graph->setSize(350, 350);     //size in pixels
	$graph->Graph->setAxis(array('x','t','y','r','t')); //no arguments means all on
	$graph->Graph->setGridLines(5, 5, 3, 2);  //x axis y axis length of line length of blank
	
	//Title
	$graph->Graph->setTitle('This is a test', '#FF0000', 50);	  //sets title 
	
	//Background
	$graph->Graph->addFill('chart', '#FFFFFF', '');
	$graph->Graph->addFill('background', '#FFFFFF', 'gradient', '#0000FF', 90, 0.7, 0);
	                      //area background chart 
	                      //color
	                      //gradient solid stripes
	                      //color 2
	                      //angle
	                      //
	
	//Axis Labels
	$graph->Graph->addAxisLabel(array('Jan', 'July', 'Jan', 'July', 'Jan'));
	$graph->Graph->addAxisLabel(array('0','100'));
	$graph->Graph->addAxisLabel(array('A', 'B', 'C'));
	$graph->Graph->addAxisLabel(array('2005', '2006', '2007'));	
	$graph->Graph->addLabelPosition(array(1, 10, 37, 75));
	$graph->Graph->addLabelPosition(array(2, 0, 1, 2, 4));		
	$graph->Graph->setAxisRange(array(0, 200, 300, 400));
	$graph->Graph->addAxisStyle(array(0, '#0000dd', 10));
	$graph->Graph->addAxisStyle(array(3, '#0000dd', 12, 1));	
	
	//Lines
	$graph->Graph->setLineColors(array('#FF0000', '#00FF00', '#0000FF')); //sets colors for the arrays
	$graph->Graph->addLineStyle(array(1, 4, 2)); //use more than one if you need various
	                                             //  styles line thickness, line length, blank
	                                             //3 thickness  
	$graph->Graph->addLineStyle(array(1, 1, 0)); //info for second line
	
	//Shapes
	$graph->Graph->addShapeMarker(array('circle', '#0000ff', 0, 3, 10));  //arrow cross diamond circle square small_vertical_line horizontal_line 
	//color 
	// 3 represents the index of the line to draw marker
	// 20 size of marker in pixels
	$graph->Graph->addShapeMarker(array('diamond', '#80C65A', 2, 2, 10));	
	$graph->Graph->addShapeMarker(array('arrow', '#80C65A', 1, 1, 10));
	//Data	
	$graph->Data->addData(array(0,0,5, 10, 58, 95)); //adds the data one add per set of lines
	$graph->Data->addData(array(0,0,5, 30, 8, 63));
	$graph->Data->addData(array(0,0,3, 17, 90, 4,100,5,12,12,0,0));
	
	//Output Graph
	$graph->printGraph();
	
	//Output Debug
	$graph->debug();
?>