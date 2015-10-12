	$(document).ready(function() {
		var raceFormula = [];
			
		raceFormula["L"] = "";
		raceFormula["Rhm"] = "";
		raceFormula["st"] = "";
		raceFormula["sn"] = "";
		raceFormula["rx"] = "";
		raceFormula["ch"] = "";
		raceFormula["fz"] = "";
		raceFormula["lu"] = "";
		raceFormula["haarlos"] = "";
	
		var colorFormula = [];
			
		colorFormula["A"] = "";
		colorFormula["B"] = "";
		colorFormula["C"] = "";
		colorFormula["E"] = "";
		colorFormula["P"] = "";
		colorFormula["Rn"] = "";
		colorFormula["s"] = "";		
		
		$('#cbHaarlos').change(function(){
			if($('#cbHaarlos').is(':checked') == false) {
				$("#ddlHaarlos").prop( "disabled", true );
				$("#cbskTraeger").attr("disabled", false);
				$("#cbBdTraeger").attr("disabled", false);
			}
			else
			{
				$("#ddlHaarlos").prop( "disabled", false );
				checkForNakedType();
			}
		});
		
		$('#ddlHaarlos').change(function(){
			checkForNakedType();
		});
		
		function checkForNakedType(){
			if($("#ddlHaarlos").val() == "bdbd"){
					$("#cbBdTraeger").attr("disabled", true);
					$("#cbskTraeger").attr("disabled", false);
			}
			else
			{
				$("#cbBdTraeger").attr("disabled", false);
				$("#cbskTraeger").attr("disabled", true);
			}
		}
		
		function fillColorFormulaArray(a, b, c, e, p, rn, s){
			colorFormula["A"] = a;
			colorFormula["B"] = b;
			colorFormula["C"] = c;
			colorFormula["E"] = e;
			colorFormula["P"] = p;
			colorFormula["Rn"] = rn;
			colorFormula["s"] = s;
		}
		
		function fillRaceFormulaArray(l, rhm, st, sn, rx, ch, fz, lu, haarlos){
			raceFormula["L"] = l;
			raceFormula["Rhm"] = rhm;
			raceFormula["st"] = st;
			raceFormula["sn"] = sn;
			raceFormula["rx"] = rx;
			raceFormula["ch"] = ch;
			raceFormula["fz"] = fz;
			raceFormula["lu"] = lu;
			raceFormula["haarlos"] = haarlos;
		}
		
		$("#ddlE").change(function(){
			if($('#ddlE').val() == "1"){
				$("#ddlRotreihe").attr("disabled", true);
				$("#ddlSchwarzreihe").attr("disabled", false);
			}
			else if($('#ddlE').val() == "2"){
				$("#ddlRotreihe").attr("disabled", false);
				$("#ddlSchwarzreihe").attr("disabled", true);
			}
			else if($('#ddlE').val() == "0"){
				$("#ddlRotreihe").attr("disabled", false);
				$("#ddlSchwarzreihe").attr("disabled", false);
			}
		});
		
		function createColorFormula(){
			var agouti = "";
		
			if($('#cbAgouti').is(':checked')){
				var agoutitype = $('#ddlAgouti').val();
				
				if(agoutitype == "0"){
					agouti = "A";
				}
				else if(agoutitype == "1")
				{
					agouti = "arar";
				}
				else if(agoutitype == "2"){
					agouti = "atat";
				}
				else
				{
					agouti = "aa";
				}
			}
		
			if($('#ddlE').val() == "0"){
				var Schwarzreihe = $("#ddlSchwarzreihe").val();
				var Rotreihe = $("#ddlSchwarzreihe").val();
				
				if(Schwarzreihe === "0"){ // Beige
					tbFarbformel.text(agouti + " bb CC EE pp SS rnrn");
				else if(Schwarzreihe === "1"){ // Lilac
					tbFarbformel.text(agouti + " BB CC EE pp SS rnrn");
				else if(Schwarzreihe === "2"){ // Coffee
					tbFarbformel.text(agouti + " bb CC EE prpr SS rnrn");
				}
				else if(Schwarzreihe == "3"){ // Slate blue
					tbFarbformel.text(agouti + " BB CC EE prpr SS rnrn");
				}
				else if(Schwarzreihe == "4"){ // Schokolade
					tbFarbformel.text(agouti + " bb CC EE PP SS rnrn");
				}
				else // Schwarz
				{
					tbFarbformel.text(agouti + " BB CC EE PP SS rnrn");
				}
			}
		
			if($('#ddlE').val() == "1"){
				var Schwarzreihe = $("#ddlSchwarzreihe").val();
				
				if(Schwarzreihe === "0"){ // Beige
					tbFarbformel.text(agouti + " bb CC EE pp SS rnrn");
				else if(Schwarzreihe === "1"){ // Lilac
					tbFarbformel.text(agouti + " BB CC EE pp SS rnrn");
				else if(Schwarzreihe === "2"){ // Coffee
					tbFarbformel.text(agouti + " bb CC EE prpr SS rnrn");
				}
				else if(Schwarzreihe == "3"){ // Slate blue
					tbFarbformel.text(agouti + " BB CC EE prpr SS rnrn");
				}
				else if(Schwarzreihe == "4"){ // Schokolade
					tbFarbformel.text(agouti + " bb CC EE PP SS rnrn");
				}
				else // Schwarz
				{
					tbFarbformel.text(agouti + " BB CC EE PP SS rnrn");
				}
			}
			
			if($('#ddlE').val() == "2"){
				var Rotreihe = $("#ddlRotreihe").val();
				
				if(Rotreihe === "0"){ // gold red eyes
					tbFarbformel.text(agouti + " bb CC ee pp SS rnrn");
				else if(Rotreihe === "1"){ // gold dark eyes
					tbFarbformel.text(agouti + " bb CC ee PP SS rnrn");
				else if(Rotreihe === "2"){ // rot
					tbFarbformel.text(agouti + " BB CC ee PP SS rnrn");
				}
				else if(Rotreihe == "3"){ // buff
					tbFarbformel.text(agouti + " bb cdcd ee PP SS rnrn");
				}
				else if(Rotreihe == "4"){ // safran
					tbFarbformel.text(agouti + " bb CC EE PP SS rnrn");
				}
				else if(Rotreihe == "5"){ // creme red eyes
					tbFarbformel.text(agouti + " bb cdcr ee pp SS rnrn");
				}
				else if(Rotreihe == "6"){ // creme dark eyes
					tbFarbformel.text(agouti + " bb cdca ee PP SS rnrn");
				}
				else if(Rotreihe == "7"){ // weiss red eyes
					tbFarbformel.text(agouti + " bb crcr ee pp SS rnrn");
				}
				else // weiss dark eyes
				{
					tbFarbformel.text(agouti + " bb crcr ee PP SS rnrn");
				}
			}
		}
		
		function createRaceFormula(){
			var sn = "SnSn";
			var haarlos = "";
			var rx = "";
			var fz = "";
			var ch = "";
			var lu = "";
			var st = "";
			var rhm = "";
			var l = "LL";
			
			if($('#optionSatin1').is(':checked')) 
			{ 
				sn = "SnSn";
			}
			else if($('#optionSatin2').is(':checked')) 
			{ 
				sn = "snsn";
			}
			else if($('#optionSatin3').is(':checked')) 
			{ 
				sn = "Snsn";
			}
			
			if($('#cbHaarlos').is(':checked')) 
			{ 
				haarlos = $("#ddlHaarlos").val();
			}
			else
			{
				if($("#cbBdTraeger").is(':checked')){
					haarlos += "Bdbd";
				}
				if($("#cbskTraeger").is(':checked')){
					haarlos += "Sksk";
				}
			}
		
			var ddShortHair = $("#ddlShortHair");
			var ddLongHair = $("#ddlLongHair");
			
			if($('#cbLanghaar').is(':checked'))
			{
				var l = "ll";
			}
			else
			{
				var l = "LL";
			}
			
			fillRaceFormulaArray(l, rhm, st, sn, rx, ch, fz, lu, haarlos);
			
		}
		
		$("#cbAgouti").change(function() {
			if($(this).is(":checked")) {
				$("#ddlAgouti").prop( "disabled", false );
			}
			else
			{
				$("#ddlAgouti").prop( "disabled", true );
			}
		});
		
		$("#ddLongHair").change(function(){
			
		});
	});