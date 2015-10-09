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
	
		$('#warningLetalFactor').hide();
		$("#tblLitterParams").hide();
		$("#hLitter").hide();
		$("#hLitterParams").hide();
		$("#tblLitter").hide();
		
        $('#warningLetalFactor').css("display", "none");
		
		$('[data-toggle="popover"]').popover();
	
		// Eventhandling for buttons
		
		$("#btnAddWeighing").on('click', function(e){
			e.preventDefault();
			var tableWeighingsBody = $("#tblWeighings tbody");
			tableWeighingsBody.append(	"<tr>"+
											"<td><input type='date' class='form-control' name='date[]' id='date' placeholder='Wiegedatum Meerschweinchen'/></td>" +
											"<td><input type='number' pattern='[0-9]+([\.|,][0-9]+)?' step='0.01' class='form-control' name='weight[]' id='weight' placeholder='Gewicht Meerschweinchen'/> kg</td>" +
										"</tr>");
		});
	
	
		$("#ddLongHair").change(function(){
			
		});
	
		$("#cbAgouti").change(function() {
			if($(this).is(":checked")) {
				$("#ddlAgouti").prop( "disabled", false );
			}
			else
			{
				$("#ddlAgouti").prop( "disabled", true );
			}
		});
		
		getDataWeibchen();
		getDataMaennchen();
		
		function getDataWeibchen(){
			getGuineaPigInformation($("#ddlWeibchen").val(), $("#spRaceW"), $("#spColorW"), $("#spColorM"), $("#spAgeW"));
		}
		
		function getDataMaennchen(){
			getGuineaPigInformation($("#ddlMaennchen").val(), $("#spRaceM"), $("#spColorM"), $("#spColorW"), $("#spAgeM"));
		}
		
		$("#ddlWeibchen").change(function(){
			getDataWeibchen();
		});
		
		$("#ddlMaennchen").change(function(){
			getDataMaennchen();
		});
		
		function getGuineaPigInformation(idGuineaPig, racefield, colorfield, colorfieldoppositegender, agefield){

			$.ajax('http://localhost:8080/GuineaPigIDPA/server.php/guineapigs-overview/dataGP/' + idGuineaPig, {
				dataType: 'json',
				success: function(data) {
					$.each(data, function(index, item) {
						racefield.html(item.race);
						colorfield.html(item.color);
						agefield.html(item.age);
					});
					
					if (colorfield.html().indexOf("Rn") >= 0 && colorfieldoppositegender.html().indexOf("Rn") >= 0){
						$('#warningLetalFactor').show("slow");
					}else
					{
						$('#warningLetalFactor').hide();
					}
					
				},
				done: function(data) {
					
				},
				error: function(xhr, status, error) {
				}
			});
		}
		
		function generatePossibleLitter(idW, idM){
			$.ajax('http://localhost:8080/GuineaPigIDPA/server.php/litter-overview/generate', {
				data: {
					'idM': idM,
					'idW': idW
				},
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					$("#tblLitter").show("slow");
					$("#hLitter").show("slow");
					$("#tblLitter tbody > tr").remove();
					$.each(data, function(index, item) {
						
						var tblRow = "<tr>" +
										"<td>Junges #" + (index + 1) + "</td>" + 
										"<td>" + item.color + "</td>" + 
										"<td>" + item.race + "</td>" + 
									 "</tr>"; 
					
						$("#tblLitter tbody").append(tblRow);
						
					});
					$("#tblLitter tbody").stop();
					$("#tblLitter tbody").hide().delay(250).fadeIn();
				},
				done: function(data) {
					
				},
				error: function(xhr, status, error) {
				}
			});
		}
		
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
		
		function generatePossibleLitterParams(agefield){
			var age = parseFloat(agefield.html());
			var lettersize = "0";
			var gestationperiod = 80; // ca. 80 Tage, liegt zwischen dem Mittelwert und dem häufigsten Wert
			
			if(age < 1)
			{
				lettersize = "3";
			}
			else if(age > 1 && age < 2){
				lettersize = "4";
			}
			else if (age > 2 && age < 4){
				lettersize = "3";
			}
			else 
			{
				lettersize = "> 4";
			}
			
			$("#tblLitterParams tbody").append("<tr>" +
												"<td>"+ lettersize + "</td>" +
												"<td>"+ gestationperiod + "</td>" +
												"<td>1:1</td>" +
												"</tr>");
												
			$("#tblLitterParams").show("slow");
			$("#hLitterParams").show("slow");
		}
		
		$("#btnCreateWurfTemp").on('click', function(e){
			e.preventDefault();
			generatePossibleLitter($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
			generatePossibleLitterParams($("#spAgeW"));
		});
		
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
	});