<?php
	$formulaone = "AA bb CC EE PP SS rnrn"; // Weibchen
	$colorone = "Einfarbig Schokolade";
	$formulatwo = "aa BB CC EE PP SS Rnrn"; // Männchen
	$colortwo = "Dalmatiner Schwarz";
	
	$colorparts_one = explode(" ", $formulaone);
	$colorparts_two = explode(" ", $formulatwo);
	
	$countcolor_m = 0;
	$countcolor_w = 0;
	$countcolor_mixed = 0;
	
	$differingProperties = array();
	
	foreach($colorparts_one as $key => $colorpart){
		if($colorparts_two[$key] != $colorpart){
			if(ctype_upper($colorparts_two[$key]) and ctype_lower($colorpart))
			{
				$countcolor_m++;
				echo "<b>Eigenschaft von Männchen überwiegt</b><br>";
			}
			else if(ctype_lower($colorparts_two[$key]) and ctype_upper($colorpart)){
				$countcolor_w++;
				echo "<b>Eigenschaft von Weibchen überwiegt</b><br>";
			}
			else
			{
				$countcolor_mixed++;
				echo "<b>Mischverhältnis könnte entstehen</b><br>";
			}
			
			echo $colorpart . " - " . $colorparts_two[$key] . "<br>";
			
		}
		else
		{
			echo "no differences<br>";
		}
	}
	
	$total = $countcolor_w + $countcolor_m + $countcolor_mixed;
	$chance_w = $countcolor_w *100 / $total;
	$chance_m = $countcolor_m * 100 / $total;
	$chance_mixed = $countcolor_mixed * 100 / $total;
	
	echo $chance_w . "% " . $colorone ."<br>";
	echo $chance_m . "% " . $colortwo ."<br>";
	echo $chance_mixed . "%<br>";
	
?>