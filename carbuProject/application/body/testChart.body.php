<h1>TestChart</h1>
<?php
if (isset ($_SESSION['message'])){
	echo '<p class="notice">'.$_SESSION['message'].'</p>';
	unset($_SESSION['message']);
}

 	include("../outils/pChart2.1.3/class/pDraw.class.php");  
 	include("../outils/pChart2.1.3/class/pData.class.php");
 	include("../outils/pChart2.1.3/class/pRadar.class.php");
  	include("../outils/pChart2.1.3/class/pImage.class.php");
  	  
  	
/* Prepare some nice data & axis config */ 
$MyData = new pData;   
//$MyData->addPoints(array(12,12,12,12,12),"NoteMoyenne");
$MyData->addPoints(array(18,8,10,12,19),"NoteEleve"); 
 
$MyData->setSerieDescription("NoteEleve","Eleve");
$MyData->setPalette("NoteEleve",array("R"=>217,"G"=>5,"B"=>0,"Alpha"=>100));

//$MyData->setSerieDescription("NoteMoyenne","Moyenne");
//$MyData->setPalette("NoteMoyenne",array("R"=>0,"G"=>5,"B"=>250,"Alpha"=>0));

/* Create the X serie */ 
$MyData->addPoints(array("Géométrie","Calcul","Lecture","Dérivée","Application"),"Labels");
$MyData->setAbscissa("Labels");

/* Create the pChart object */
$myPicture = new pImage(1000,400,$MyData);

/* Draw a solid background */
$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);
$myPicture->drawFilledRectangle(0,0,1000,400,$Settings);

/* Overlay some gradient areas */
$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,1000,400,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,40,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

/* Draw the border */
$myPicture->drawRectangle(0,0,999,399,array("R"=>0,"G"=>0,"B"=>0));

/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"calibri.ttf","FontSize"=>10));
$myPicture->drawText(20,20,"Radar - Résultat diagnostic",array("R"=>255,"G"=>255,"B"=>255));

/* Define general drawing parameters */
$myPicture->setFontProperties(array("FontName"=>"calibri.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));
$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

/* Create the radar object */
$SplitChart = new pRadar();

/* Draw the 1st radar chart */
$myPicture->setGraphArea(50,50,300,300);
$Options = array("SegmentHeight"=>4,"Segments"=>5,"DrawAxisValues"=>FALSE,"DrawPoly"=>TRUE,"WriteValues"=>TRUE,"LabelsBackground"=>FALSE, "ValueFontSize"=>6,"FixedMax"=>20,"Layout"=>RADAR_LAYOUT_STAR,"LabelPos"=>RADAR_LABELS_HORIZONTAL,"BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50));
$SplitChart->drawRadar($myPicture,$MyData,$Options);
//$SplitChart->drawRadar($myPicture,$MyData2,$Options);

/* Draw the 2nd radar chart */
/* Draw the 1st radar chart */
$myPicture->setGraphArea(300,50,600,600);
$Options = array("SegmentHeight"=>4,"Segments"=>5,"DrawAxisValues"=>FALSE,"DrawPoly"=>TRUE,"WriteValues"=>TRUE,"LabelsBackground"=>FALSE, "ValueFontSize"=>6,"FixedMax"=>20,"Layout"=>RADAR_LAYOUT_STAR,"LabelPos"=>RADAR_LABELS_HORIZONTAL,"BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50));
$SplitChart->drawRadar($myPicture,$MyData,$Options);


/* Write down the legend */
$myPicture->setFontProperties(array("FontName"=>"../outils/pChart2.1.3/fonts/calibri.ttf","FontSize"=>10));
$myPicture->drawLegend(10,60,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));

/* Render the picture */
$myPicture->Render("drawradar.png");
  echo "<img src=\"drawradar.png\"/>";
   
?>