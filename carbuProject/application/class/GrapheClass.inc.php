<?php


//---------------------------------------------------------------------------
// Classe Graphe
//---------------------------------------------------------------------------
class Graphe {

	function __construct() {

		require_once 'application/inc/declarations.inc.php';
		require_once 'pDraw.class.php';
		require_once 'pData.class.php';
		require_once 'pRadar.class.php';
		require_once 'pImage.class.php';
	}

	public function CreateGrapheSimple($valeurs,$titres,$titreImage,$titre,$sousTitre = ''){
		$fontName = './application/outils/pChart2.1.3/fonts/calibri.ttf';

		//$titreImage = 'drawradar';
		//$valeurs = array(30,20,50,90,70);
		//$titres = array("Géométrie","Calcul","Lecture","Dérivée","Application");
		//$titre = 'Résultat';

		$taille = 400;
		$fontSize = 8;

		/* Prepare some nice data & axis config */
		$MyData = new pData;
		$MyData->addPoints($valeurs,"NoteEleve");

		$MyData->setSerieDescription("NoteEleve","Eleve");
		$MyData->setPalette("NoteEleve",array("R"=>217,"G"=>5,"B"=>0,"Alpha"=>100));

		/* Create the X serie */
		$MyData->addPoints($titres,"Labels");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		$myPicture = new pImage($taille,$taille,$MyData);

		/* Draw a solid background */
		$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);
		$myPicture->drawFilledRectangle(0,0,$taille,$taille,$Settings);

		/* Overlay some gradient areas */
		$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);
		$myPicture->drawGradientArea(0,0,$taille,$taille,DIRECTION_VERTICAL,$Settings);
		$myPicture->drawGradientArea(0,0,$taille,($taille/10),DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

		/* Draw the border */
		$myPicture->drawRectangle(0,0,($taille-1),($taille-1),array("R"=>0,"G"=>0,"B"=>0));

		/* Titres et sous titres */
		$myPicture->setFontProperties(array("FontName"=> $fontName,"FontSize"=>$fontSize+1));
		$myPicture->drawText(20,20,$titre,array("R"=>255,"G"=>255,"B"=>255));
		$myPicture->drawText(20,35,$sousTitre,array("R"=>255,"G"=>255,"B"=>255));

		/* Define general drawing parameters */
		$myPicture->setFontProperties(array("FontName"=>$fontName,"FontSize"=>$fontSize,"R"=>80,"G"=>80,"B"=>80));
		$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Create the radar object */
		$SplitChart = new pRadar();

		/* Draw the 1st radar chart */
		$myPicture->setGraphArea(0,($taille/10),$taille-($taille/10),$taille);
		$Options = array("SegmentHeight"=>20,"Segments"=>5,"DrawAxisValues"=>false,"DrawPoly"=>TRUE,"WriteValues"=>TRUE,"LabelsBackground"=>FALSE, "ValueFontSize"=>10,"FixedMax"=>100,"Layout"=>RADAR_LAYOUT_STAR,"LabelPos"=>RADAR_LABELS_ROTATED,"BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50));
		$SplitChart->drawRadar($myPicture,$MyData,$Options);


		/* Render the picture */
		$myPicture->Render($titreImage.".png");
		//echo '<img width = "200px" height = "200px" src="'.$titreImage.'.png"/>';
	}

	public function CreateGrapheBarre($valeurs,$titres,$titreImage,$titre,$sousTitre = ''){

		$fontName = './application/outils/pChart2.1.3/fonts/calibri.ttf';

		//=================== INIT VARIABLES ====================
		$tailleGrapheH = 200;
		$tailleGrapheL = 400;
		$fontSize = 8;

		$MyData = new pData();
		
		//=================== POINTS et AXES ============================
		$MyData->addPoints($valeurs,"noteEleve");
		$MyData->setAxisName(0,"Note (%)");
		$abs = array();
		$i = 1;
		foreach($valeurs as $v){
			$abs[] = $i;
			$i++;
		}  
		$MyData->addPoints($abs,"Labels");
		$MyData->setAbscissa("Labels");
		$MyData->setAbscissaName("Competences");
		//$MyData->addPoints($titres,"Labels");
		
		//=================== COULEURS =================================
		$couleurA = array("R"=>0,"G"=>255,"B"=>0,"Alpha"=>100);
		$couleurB = array("R"=>255,"G"=>204,"B"=>0,"Alpha"=>100);
		$couleurC = array("R"=>255,"G"=>0,"B"=>0,"Alpha"=>100);
		$couleurD = array("R"=>0,"G"=>0,"B"=>0,"Alpha"=>100);
		$listeCouleur = array(0 => $couleurD, 33 => $couleurC, 67 => $couleurB, 100 => $couleurA);
		
		foreach ($valeurs as $note) $Palette[] = $listeCouleur[number_format($note,0)];
		
		//================== GRAPHE ====================================
		$myPicture = new pImage(800,230,$MyData);
		$myPicture->drawGradientArea(50,30,$tailleGrapheL,$tailleGrapheH,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$myPicture->drawGradientArea(50,30,$tailleGrapheL,$tailleGrapheH,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$myPicture->setFontProperties(array("FontName"=>$fontName,"FontSize"=>$fontSize));
		$myPicture->setGraphArea(50,30,$tailleGrapheL,$tailleGrapheH);
		$myPicture->drawScale(array("Mode" => SCALE_MODE_MANUAL, "ManualScale" => array(0=>array("Min"=>0,"Max"=>100)) ));	
		$settings = array("AroundZero"=>TRUE, "Gradient"=>TRUE, "DisplayOrientation"=>ORIENTATION_VERTICAL, "DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE, "DisplayOrientation"=>ORIENTATION_HORIZONTAL,"OverrideColors"=>$Palette);
		$myPicture->drawBarChart($settings);
		
		//================= STATS ====================================
		$listeNote = array(0 => 0, 33 => 0, 67 => 0, 100 => 0);
		$moy = 0;
		$nbNote = 0;
		foreach ($valeurs as $note ){
			$listeNote[number_format($note,0)]++;
			$moy += $note;
			$nbNote++;
		}
		$moy = number_format($moy/array_sum($listeNote),2);
		
		$TextSettings = array("DrawBox"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Angle"=>0,"FontSize"=>9);
		$myPicture->drawText(420,30,$titre,$TextSettings);
		$myPicture->drawText(420,50,$sousTitre,$TextSettings);
		$myPicture->drawText(420,70,'Compétences évaluées: '.$nbNote.' - Moy: '.$moy,$TextSettings);
		$myPicture->drawText(420,90,'Note A: '.$listeNote[100],$TextSettings);
		$myPicture->drawText(420,110,'Note B: '.$listeNote[67],$TextSettings);
		$myPicture->drawText(420,130,'Note C: '.$listeNote[33],$TextSettings);
		$myPicture->drawText(420,150,'Note D: '.$listeNote[0],$TextSettings);
		

		$myPicture->Render($titreImage.".png");
	}

};

