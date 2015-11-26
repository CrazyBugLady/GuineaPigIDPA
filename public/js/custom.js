	$(document).ready(function() {
		var earliestperiod = 68;
		var expectedlitterperiod = 80; // ca. 80 Tage, liegt zwischen dem Mittelwert und dem häufigsten Wert
			
		$('#warningLetalFactor').hide();
		$("#tblLitterParams").hide();
		$("#hLitter").hide();
		$("#hLitterParams").hide();
		$("#tblLitterRace").hide();
		$("#tblLitterColor").hide();
		$('#divCreate').hide();
		
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
			cancelCreating();
			createWurfTemp();
			$('#divCreate').hide();
		});
		
		$("#ddlMaennchen").change(function(){
			getDataMaennchen();
			cancelCreating();
			createWurfTemp();
			$('#divCreate').hide();
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
					
					if ((colorfield.html().indexOf("Dalmatiner") >= 0 || colorfield.html().indexOf("Schimmel") >= 0) && colorfieldoppositegender.html().indexOf("Dalmatiner") >= 0 || colorfieldoppositegender.html().indexOf("Schimmel") >= 0){
						$('#warningLetalFactor').show("slow");
					}
					else
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
												"<td>"+ earliestperiod + "</td>" +
												"<td>"+ expectedlitterperiod + "</td>" +
												"<td>1:1</td>" +
												"</tr>");
												
			$("#tblLitterParams").show("slow");
			$("#hLitterParams").show("slow");
		}
		
		function setUpDates(startdate){
			var startdatefragments = startdate.split(".")
			var startdate = new Date(startdatefragments[2], (startdatefragments[1] - 1), startdatefragments[0]);
			var earliestLitterDate = new Date();
			var possibleLitterDate = new Date();
			var msperDay = 86400000;

			earliestLitterDate.setTime(startdate.getTime() + earliestperiod * msperDay);
			possibleLitterDate.setTime(startdate.getTime() + expectedlitterperiod * msperDay);
			
			$("#tbExpectedLitterdate").val(possibleLitterDate.getDate() + "." + (possibleLitterDate.getMonth() + 1) + "." + possibleLitterDate.getFullYear());
			$("#tbEarliestLitterdate").val(earliestLitterDate.getDate() + "." + (earliestLitterDate.getMonth() + 1) + "." + earliestLitterDate.getFullYear());
		}		
		
		$("#tbStartdate").on('change', function() {
			setUpDates($("#tbStartdate").val());
		});
		
		function setUpFormForCreating(){
			$('#divCreate').show('slow');
			var startdateDefault = new Date();
			var strStartdateDefault = startdateDefault.getDate() + "." + (startdateDefault.getMonth() + 1) + "." + startdateDefault.getFullYear()
			$("#tbStartdate").val(strStartdateDefault);
			setUpDates(strStartdateDefault);
			$("#btnCreateWurf").text("Verpaarung abbrechen");
			$("#btnCreateWurf").addClass("btn-danger");
			$("#btnCreateWurf").removeClass("btn-success");
		}
		
		function cancelCreating(){
			$('#divCreate').hide("slow");
			
		
			$("#btnCreateWurf").text("Verpaarung erstellen");
			$("#btnCreateWurf").addClass("btn-success");
			$("#btnCreateWurf").removeClass("btn-danger");
		}
		
		function createWurfTemp(){
			generatePossibleLitterColor($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
			generatePossibleLitterRace($("#ddlWeibchen").val(), $("#ddlMaennchen").val());
			generatePossibleLitterParams($("#spAgeW"));
		}
		
		$("#btnCreateWurfTemp").on('click', function(e){
			e.preventDefault();
			createWurfTemp();
			cancelCreating();
			
		});
		$("#btnCreateWurf").on('click', function(e){
			e.preventDefault();
			if($("#divCreate").is(':visible') == false){
				setUpFormForCreating();
			}
			else
			{
				cancelCreating();
			}
			
		});
	});