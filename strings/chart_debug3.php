<?php
  //Simple Example with One set of Data Line Graph
	//Include Class
	require_once('GoogleGraph.php');

	//Create Object
	$graph = new GoogleGraph();
	$graph->Graph->setSize(440,220); //maximum  size for maps
	echo 'String '.$graph->Graph->country_string;
	$z=$graph->Graph->setCountryString('KEDZTDLYZANAZWINCYETMG');
	echo 'String '.$graph->Graph->country_string;
	
	//$graph->Graph->setTitle('World Map', '#bebebe', 18);	  //sets title 
	$graph->Graph->setType('map');       //line bar pie venn scatter
	//$graph->Graph->setSubtype('world');   //chart or axis
	//$graph->printGraph();

	
		
	//Background
	//$graph->Graph->addFill('chart', '#FFFFFF', '');
	//$graph->Graph->addFill('background', '#FFFFFF', 'gradient', '#0000FF', 90, 0.7, 0);
	                      //area background chart 
	                      //color
	                      //gradient solid stripes
	                      //color 2
	                      //angle
	                      //
	
	
	//Output Graph
	$graph->printGraph();
	
	//Output Debug
	//$graph->debug();
	
	//$text=file_get_contents("http://www.powerset.com/explore/semhtml/History_of_Tibet?query=where+is+tibet");
	//echo $text;
?>	
<?php 
for ($i=30;$i<85;$i=$i+10){
  $s="http://chart.apis.google.com/chart?chs=225x125&cht=gom&chd=t:".$i;
  $s.="&chl=Production+".$i."%";
  echo '<div style="width:30%;float:left;border:1px solid #bebebe">';
	echo '<img src="'.$s.'"  title="Production Rates"'.'>';
	echo '<p style="font-size:small;text-align:center">Production Rate :'.$i.'%</p>'; 
	echo "</div>";
} ?>

<?php
  $text="THE IRAQI PROBLEM!";
  $url=  'bush-professor.jpg'; 
  $image= imagecreatefrompng('"http://chart.apis.google.com/chart?chs=225x125&cht=gom&chd=t:30'); 
  $white= imagecolorallocate($image, 255, 255, 255);
  $font= 'code2001.TTF';
  imagettftext($image, 14, 0, 6, 21, $white, $font, $text);
  imagejpeg($image,'test2.png',100);
  imagedestroy($image);
?>
<img src="test2.jpg" />
"http://chart.apis.google.com/chart?chs=225x125&cht=gom&chd=t:70&chl=Production+70%";

