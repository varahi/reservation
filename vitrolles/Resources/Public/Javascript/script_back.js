
jQuery(document).ready(function(){
	jQuery('input, textarea').placeholder();
	jQuery('input').iCheck();
	
	/**** COOKIES BAR ****/
	jQuery('.cookie-message').cookieBar({
		domain: 'dev-vitrolles05.dyndns.org/'
	});
	/**** COOKIES BAR ****/
	
	/**** FORM MULTIPLE MAIL ****/
	/*jQuery('.tx-powermail form.layout1').submit(function(){
		if(jQuery(this).find('input[name="tx_powermail_pi1[field][nom]"]').val() != "" && 
			jQuery(this).find('input[name="tx_powermail_pi1[field][email]"]').val() != "" && 
			jQuery(this).find('input[name="tx_powermail_pi1[field][demande]"]').val() != ""){
			swal({   
				title: "Envoyer mon mail à :",
				html: jQuery('.tx-powermail form.layout1 .powermail_radio_outer').html(),
				showCancelButton: true,  
				closeOnConfirm: true,  
				cancelButtonText: "Annuler",
				confirmButtonText: "Confirmer"
			}, function(isConfirm){   
				if (isConfirm) {
					jQuery('.tx-powermail form.layout1').submit();
				}
			});
		}
		return false;
	});*/
	/**** FORM MULTIPLE MAIL ****/
	
	var isMobile = false; //initiate as false
	// device detection
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
	
	if(isMobile){
		jQuery(document).on('click', '#main-menu ul li a', function(e){
			if(jQuery(this).parent().find('>ul').length > 0){
				return false;
			}
		});
	}
	
	var isIE11 = !!navigator.userAgent.match(/Trident.*rv[ :]*11\./)
	if(jQuery.browser['msie'] || isIE11){
		jQuery('html').addClass('ie');
	}
	
	jQuery(document).on('click', '#map_canvas', function () {
		jQuery('#map_canvas .gm-style').css("pointer-events", "auto");
	});
	
	/****** SELECT JQUERY UI ******/
	jQuery('select').selectmenu({
		create: function( event, ui ) {
			jQuery(this).after(jQuery('#'+jQuery(this).attr('id')+'-menu').parent());
		}
	});
	/****** SELECT JQUERY UI ******/
	
	
	/****** SIMILATION CLICK ******/
	jQuery('.list-article .article').click(function(){
		window.location = $(this).find('.bt-more a').attr('href');
	});
	/****** FIN SIMILATION CLICK ******/
	
	
	/****** TRUNCATE TEXT ******/
	jQuery('#list-article .article .info').dotdotdot({});
	/****** FIN TRUNCATE TEXT ******/
	
	
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
	
	
	/****** SLIDER ACCUEIL ******/
	slider_home = jQuery('#slideshow ul').bxSlider({
		//mode: 'fade',
		auto: true,
		pager: false,
		speed: 1000,
		pause: 7000,
		controls: false,
		responsive: true,
		adaptiveHeight: true,
		preloadImage: 'all',
		onSliderLoad: function(){
			resizeImg(jQuery('#slideshow ul li'));
		}
	});
	/****** FIN SLIDER ACCUEIL ******/
	
	
	/****** SLIDER CONTENU ******/
	slider_content = jQuery('.slider-content ul').bxSlider({
		auto: true,
		pager: false,
		speed: 1000,
		pause: 7000,
		controls: true,
		responsive: true,
		adaptiveHeight: true,
		preloadImage: 'all',
		infiniteLoop: false,
		hideControlOnEnd: true
	});
	/****** FIN SLIDER CONTENU ******/
		
				
	/*enquire.register("screen and (max-width: 1024px)", {
		match : function() {
			console.log('teets');
		},  
		unmatch : function() {
			jQuery(document).unbind('click');
		}
	});*/
	
	if(jQuery('#headband').find('img').length <= 0){
		jQuery('#headband').append('<img src="/fileadmin/templates/default/images/image-bandeau.jpg" width="1200" height="146" alt="Image bandeau"/>');
	}
	
	if(jQuery('#right-main').length <= 0){
		jQuery('#right-main').append('<div id="map_canvas"></div>');
	}
	
	if(jQuery('body').height() < jQuery(window).height()){
		jQuery('#left').css({minHeight: jQuery(window).height() - jQuery('header').outerHeight(true)+"px"});
	}
	
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
	resizeImg(jQuery('#headband'));
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

function resizeImg(content){
	content.each(function(){
		if(jQuery(this).find('img').width() <= content.width()){
			jQuery(this).find('img').css({
				height: "auto",
				width: "100%"
			});
			jQuery(this).find('img').css({
				marginLeft: "0",
				marginTop: -(jQuery(this).find('img').height() - content.height())/2 +"px"
			});
		}
		if(jQuery(this).find('img').height() <= content.height()){
			jQuery(this).find('img').css({
				width: "auto",
				height: "100%"
			});
			jQuery(this).find('img').css({
				marginTop: "0",
				marginLeft: -(jQuery(this).find('img').width() - content.width())/2 +"px"
			});
		}
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