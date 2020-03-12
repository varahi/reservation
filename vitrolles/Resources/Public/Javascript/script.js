
jQuery(document).ready(function(){
	jQuery('input, textarea').placeholder();
	jQuery('input').iCheck();

	/****** SELECT JQUERY UI ******/
	jQuery('select').selectmenu({
		create: function( event, ui ) {
			jQuery(this).after(jQuery('#'+jQuery(this).attr('id')+'-menu').parent());
		}
	});
	/****** SELECT JQUERY UI ******/
	
	
	/****** DATEPICKER JQUERY UI ******/
	jQuery('form .layout2').each(function(e){
		if(e%2 == 1){
			jQuery(this).addClass('layout2-right');
		}
	});
	var disponibilites = [ 
			{ Date: new Date("01/08/2016"), type: "unvailable"}, 
			{ Date: new Date("01/10/2016"), type: "unvailable"}, 
			{ Date: new Date("01/11/2016"), type: "wait"}, 
			{ Date: new Date("01/20/2016"), type: "unvailable"}, 
			{ Date: new Date("01/25/2016"), type: "wait"}, 
			{ Date: new Date("01/26/2016"), type: "unvailable"}
		]

	disponibilitesSalle = new Array();
	jQuery('#booking-left #reservation_1 li').each(function(){
			disponibilitesSalle.push( { dateStart: new Date($(this).attr('dateStart')), dateEnd: new Date($(this).attr('dateEnd')), type: $(this).attr('class') } );
	});
	
	/*disponibilitesSalle2 = new Array();
	jQuery('#booking-left #reservation_2 li').each(function(){
			disponibilitesSalle2.push( { Date: new Date($(this).html()), type: $(this).attr('class') } );
	});*/
	
		
	jQuery('.calendar, .datepicker').datepicker({
		autoSize: false,
		dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
		monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
		monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
		showOtherMonths: false,
		firstDay: 1,
		minDate: new Date(),
		dateFormat: 'dd MM yy',
		beforeShowDay: function(date) {
			return datePickerBeforeShowDay(date, disponibilitesSalle);
		},
		onSelect: function(dateText, inst ) {
			datePickerOnSelect(dateText, inst, disponibilitesSalle );
		}
	});
	jQuery('#datepickerDateStart').datepicker({
		autoSize: false,
		dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
		monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
		monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
		showOtherMonths: false,
		firstDay: 1,
		minDate: new Date(),
		dateFormat: 'dd MM yy',
		altField: "#dateStart",
		altFormat: "yy-mm-dd",
		beforeShowDay: function(date) {
			return datePickerBeforeShowDay(date, disponibilitesSalle);
		},
		onSelect: function(dateText, inst ) {
			datePickerOnSelect(dateText, inst, disponibilitesSalle );
		}
	});
	jQuery('#datepickerDateEnd').datepicker({
		autoSize: false,
		dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
		monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
		monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
		showOtherMonths: false,
		firstDay: 1,
		minDate: new Date(),
		dateFormat: 'dd MM yy',
		altField: "#dateEnd",
		altFormat: "yy-mm-dd",
		beforeShowDay: function(date) {
			return datePickerBeforeShowDay(date, disponibilitesSalle);
		},
		onSelect: function(dateText, inst ) {
			datePickerOnSelect(dateText, inst, disponibilitesSalle);
		}
	});
	/****** DATEPICKER JQUERY UI ******/
	
	
	/****** JQUERY SELECT RESERVATION ******/
	jQuery('.tx-vitrolles .input-select select.list-salles').selectmenu( "destroy" );
	jQuery('.tx-vitrolles .input-select select.list-salles').selectmenu({
		create: function( event, ui ) {
			jQuery(this).after(jQuery('#'+jQuery(this).attr('id')+'-menu').parent());
		},
		change: function( event, ui ) {
			var value = ui.item.value;
			var date = jQuery('#booking-left #reservation_'+value);
			disponibilitesSalle = [];
			date.find('li').each(function(){
				disponibilitesSalle.push( { dateStart: new Date($(this).attr('dateStart')), dateEnd: new Date($(this).attr('dateEnd')), type: $(this).attr('class') } );
			});
			resetDatepicker(jQuery('.calendar, .datepicker'), 'dd MM yy', disponibilitesSalle);
			resetDatepicker(jQuery('#datepickerDateStart'), 'dd MM yy', disponibilitesSalle, '#dateStart', 'yy-mm-dd');
			resetDatepicker(jQuery('#datepickerDateEnd'), 'dd MM yy', disponibilitesSalle, '#dateEnd', 'yy-mm-dd');
				
			jQuery('.tx-vitrolles .input-select select.list-salles').val(value);
			jQuery('.tx-vitrolles .input-select select.list-salles').selectmenu( "refresh" );
		}
	});
	/****** FIN JQUERY SELECT RESERVATION ******/
	
	jQuery('#newResa').submit(function(e){
        e.preventDefault();
		
		//vérification des champs obligatoires
        if($("#newResa input[name='tx_vitrolles_reservation[lastName]']").val()==''){
            swal("Erreur !", "Merci de saisir votre nom !", "error");
            return false;
        }
        if($("#newResa input[name='tx_vitrolles_reservation[firstName]']").val()==''){
            swal("Erreur !", "Merci de saisir votre prénom !", "error");
            return false;
        }
        if($("#newResa input[name='tx_vitrolles_reservation[email]']").val()==''){
            swal("Erreur !", "Merci de saisir votre email !", "error");
            return false;
        }
        if($("#newResa input[name='tx_vitrolles_reservation[telephone]']").val()==''){
            swal("Erreur !", "Merci de saisir votre téléphone !", "error");
            return false;
        }
        
        //appel ajax
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        
        $.ajax({
                    type: "POST",
                    url: formURL,
                    dataType: 'json',
                    data: postData,
                    success: function(result) {
                            //on supprime le loader
                            //removeLoader();
                            
                            if(result['status'] == 'ok'){
                            
                                swal({
                                    title: "Enregistré!",
                                    text : "Votre réservation a bien été prise en compte !", 
                                    type : "success",
                                },
                                function(){
                                    location.reload();
                                });
                            }else{
                                swal("Erreur !", result['msg'], "error");
                            }
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                            swal("Erreur !", "Une erreur s'est produite !", "error");

                            //on supprime le loader
                            //removeLoader();
//console.log("passe dans le error ==>"+textStatus+" "+errorThrown);
                    }
        });

        return false;
	});
});

jQuery(window).load(function(){	
	//resizeImg(jQuery('#headband'));
});

function tooltips(div){
	/** Hover tooltips footer **/
	jQuery(div).hover(function(){
		attrTitle = jQuery(this).find('img').attr('alt');
		jQuery(this).append('<div class="tooltips"><p>'+jQuery(this).find('img').attr('alt')+'</p></div>');
		jQuery(this).find('img').attr('alt', '');
	}, function(){
		jQuery('.tooltips').remove();
		jQuery(this).find('img').attr('alt', attrTitle);
	});
}


function resetDatepicker(div, dateFormat, disponibilite, altField, altFormat){
	div.datepicker( "destroy" );
	div.datepicker({
		autoSize: false,
		dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		dayNamesMin: [ "D", "L", "M", "M", "J", "V", "S" ],
		monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
		monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jui", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
		showOtherMonths: false,
		firstDay: 1,
		minDate: new Date(),
		dateFormat: dateFormat,
		altField: altField,
		altFormat: altFormat,
		beforeShowDay: function(date) {
			return datePickerBeforeShowDay(date, disponibilite);
		},
		onSelect: function(dateText, inst ) {
			datePickerOnSelect(dateText, inst, disponibilite );
		}
	});
}

function datePickerOnSelect(dateText, inst, disponibilites ) {
		var date,
		selectedDate = jQuery('#'+inst.id).datepicker('getDate'),
		i = 0,
		disponibilite = [];
		/* Determine if the user clicked an disponibilite: */
		while (i < disponibilites.length) {
			dateStart = disponibilites[i].dateStart;
			dateEnd = disponibilites[i].dateEnd;
			// if (selectedDate.valueOf() === dateStart.valueOf()) {
			if (selectedDate.valueOf() >= dateStart.valueOf() && selectedDate.valueOf() <= dateEnd.valueOf()) {
				disponibilite.push(disponibilites[i]);
				if(disponibilites[i].type != "available"){
					swal("Erreur !", "Jour indisponible", "error");
				}
			}
			i++;
		}
		if (disponibilite.length > 0) {

			for(k=0; k<disponibilite.length; k++){
				// Contenu de la lightbox
			}
		}
		else{
		}
}

function datePickerBeforeShowDay(date, disponibilites) {
			var result = [true, '', null];
			var dateNew,
				selectedDate = new Date(date),
				i = 0,
				j = 0,
				disponibilite = [];

			var matching = jQuery.grep(disponibilites, function(disponibilite) {
				return disponibilite.dateStart.valueOf() === date.valueOf();
			});
			
			
			// Récupération des éléments du tableau disponibilite (type)
			while (i < disponibilites.length) {
				dateStart = disponibilites[i].dateStart;
				dateEnd = disponibilites[i].dateEnd;

				// if (selectedDate.valueOf() === dateNew.valueOf()) {
				if (selectedDate.valueOf() >= dateStart.valueOf() && selectedDate.valueOf() <= dateEnd.valueOf()) {
					disponibilite.push(disponibilites[i]);
				}
				i++;
				j++;
			}
			
			var type = [];
			for(k=0; k<disponibilite.length; k++){
				if(jQuery.inArray(disponibilite[k].type,type)<0){
					type.push(disponibilite[k].type);
				}
			}
			result = [true, type, null];
			return result;
}