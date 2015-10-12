	$(document).ready(function() {
	
		$('#warningLetalFactor').hide();
		$("#tblLitterParams").hide();
		$("#hLitter").hide();
		$("#hLitterParams").hide();
		$("#tblLitterRace").hide();
		$("#tblLitterColor").hide();
		
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
		
		function generatePossibleLitterColor(idW, idM){
			$.ajax('http://localhost:8080/GuineaPigIDPA/server.php/litter-overview/generate', {
				data: {
					'idM': idM,
					'idW': idW,
					'information': 'color'
				},
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					$("#tblLitterColor").show("slow");
					$("#hLitter").show("slow");
					$("#tblLitterColor tbody > tr").remove();
					$.each(data, function(index, item) {
						
						var tblRow = "<tr>" +
										"<td>" + item.possibility + "</td>" + 
										"<td>" + item.combination + "</td>" + 
									 "</tr>"; 
					
						$("#tblLitterColor tbody").append(tblRow);
						
					});
					$("#tblLitterColor tbody").stop();
					$("#tblLitterColor tbody").hide().delay(250).fadeIn();
				},
				done: function(data) {
					
				},
				error: function(xhr, status, error) {
				}
			});
		}
		
		function generatePossibleLitterRace(idW, idM){
			$.ajax('http://localhost:8080/GuineaPigIDPA/server.php/litter-overview/generate', {
				data: {
					'idM': idM,
					'idW': idW,
					'information': 'race'
				},
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					$("#tblLitterRace").show("slow");
					$("#hLitter").show("slow");
					$("#tblLitterRace tbody > tr").remove();
					$.each(data, function(index, item) {
						
						var tblRow = "<tr>" +
										"<td>" + item.possibility + "</td>" + 
										"<td>" + item.combination + "</td>" + 
									 "</tr>"; 
					
						$("#tblLitterRace tbody").append(tblRow);
						
					});
					$("#tblLitterRace tbody").stop();
					$("#tblLitterRace tbody").hide().delay(250).fadeIn();
				},
				done: function(data) {
					
				},
				error: function(xhr, status, error) {
				}
			});
		}

		function generatePossibleLitterParams(agefield){
			$("#tblLitterParams tbody > tr").remove();
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
			generatePossibleLitterColor($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
			generatePossibleLitterRace($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
			generatePossibleLitterParams($("#spAgeW"));
		});
	});