	$(document).ready(function() {
		$('#warningLetalFactor').hide();
        $('#warningLetalFactor').css("display", "none");
		
		$('[data-toggle="popover"]').popover();
	
		// Eventhandling for buttons
		
		$("#btnAddWeighing").on('click', function(e){
			e.preventDefault();
			var tableWeighingsBody = $("#tblWeighings tbody");
			tableWeighingsBody.append(	"<tr>"+
											"<td><input type='date' class='form-control' name='date[]' id='date' placeholder='Wiegedatum Meerschweinchen'/></td>" +
											"<td><input type='number' class='form-control' name='weight[]' id='weight' placeholder='Gewicht Meerschweinchen'/> kg</td>" +
										"</tr>");
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
		
		$("#cbHaarlos").change(function() {
			if($(this).is(":checked")) {
				$("#ddlHaarlos").prop( "disabled", false );
			}
			else
			{
				$("#ddlHaarlos").prop( "disabled", true );
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
					'mId': idM,
					'wId': idW
				},
				dataType: 'json',
				success: function(data) {
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
		
		$("#btnCreateWurfTemp").on('click', function(e){
			e.preventDefault();
			generatePossibleLitter($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
		});
		
		function createColorFormula(){
			var colorFormula = [];
			
			colorFormula["A"] = "";
			colorFormula["B"] = "";
			colorFormula["C"] = "";
			colorFormula["E"] = "";
			colorFormula["P"] = "";
			colorFormula["Rn"] = "";
			colorFormula["ss"] = "";
		}
		
		function createRaceFormula(){
		
		}
	});