$(document).ready(function() {
    $.initTemplateLigne();
    $.coupeDependentSelect();

    var editUrlRegexp = /[0-9]+/g;

    $('body').on('click', '[data-toggle="modal"]', function(){
    	var url = $(this).attr('data-url');
    	var target = $(this).attr('data-target');
      	$(target+' .modal-content').load(url,function(result){
      		$('#modal_filters_client_id').sortSelect().chosen({
      	    	placeholder_text_single: "-",
      			allow_single_deselect:true,
      	   	 	width: "100%"
      	  	});
      		$('#modal_filters_fournisseur_id').sortSelect().chosen({
      	    	placeholder_text_single: "-",
      			allow_single_deselect:true,
      	   	 	width: "100%"
      	  	});
            $('#modal_filters_commercial_id').sortSelect().chosen({
      	    	placeholder_text_single: "-",
      			allow_single_deselect:true,
      	   	 	width: "100%"
      	  	});
    	    $(target).modal({show:true});
    	});
    });

    $('body').on('click', '#detailsTabs a', function(event){
    	$("#detailsTabs a").each(function() {
    		$(this).removeClass('active');
    	});
		$(this).addClass('active');
    	$("#detailsTabsContent div").each(function() {
    		$(this).removeClass('show active');
    	});
    	$($(this).attr('href')).addClass('show active');
    });

	// COUPE CHOSEN
	$('#coupe_saison_id').sortSelect().chosen({width: "90%"});
	$('#coupe_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#coupe_client_id').sortSelect().chosen({width: "90%"});
	$('#coupe_commercial_id').sortSelect().chosen({width: "90%"});
	$('#coupe_paiement').sortSelect().chosen({width: "90%"});

	$('#coupe_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#coupe_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#coupe_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#activite_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#activite_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#activite_filters_produit').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});


	// COLLECTION & PRODUCTION CHOSEN
	$('#collection_saison_id').sortSelect().chosen({width: "90%"});
	$('#collection_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#collection_commercial_id').sortSelect().chosen({width: "90%"});
	$('#collection_client_id').sortSelect().chosen({width: "90%"});
	$('#collection_paiement').sortSelect().chosen({width: "90%"});
	$('#collection_situation').sortSelect().chosen({width: "90%"});
	$('#collection_qualite').sortSelect().chosen({width: "90%"});
  $('#collection_devise_fournisseur_id').sortSelect().chosen({width: "25%"});
  $('#collection_devise_commercial_id').sortSelect().chosen({width: "25%"});
  $('#sf_guard_user_commercial_id').sortSelect().chosen({allow_single_deselect:true,width: "90%"});

	$('#collection_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#collection_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#collection_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#collection_filters_situation').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#collection_filters_qualite').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
  $('#sf_guard_user_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});

  $('#collection_fournisseur_id').on('change', function() {
    const fId = this.value;
    $.get("/fournisseur/"+fId+"/getcommission", function(infos) {
      const json = JSON.parse(infos);
      $('#collection_prix_fournisseur').val(json.commission);
      $('#collection_devise_fournisseur_id').val(json.devise_id);
      $('#collection_devise_fournisseur_id').trigger("chosen:updated");
    });
  });
  if($('#collection_fournisseur_id').length > 0 && !editUrlRegexp.test($('form').attr('action'))) {
    $('#collection_fournisseur_id').trigger( "change" );
  }

  $('#collection_client_id').on('change', function() {
    const cId = this.value;
    $.get("/client/"+cId+"/getpaiement", function(infos) {
      const json = JSON.parse(infos);
      $('#collection_paiement').val(json.paiement);
      $('#collection_paiement').trigger("chosen:updated");
    });
  });
  if($('#collection_client_id').length > 0 && !editUrlRegexp.test($('form').attr('action'))) {
    $('#collection_client_id').trigger( "change" );
  }



  $('#collection_qualite').on('change', function() {
    const q = this.value;
    const s = $('#collection_saison_id').val();
    const c = $('#collection_client_id').val();
    $('#alertBox').html('');
    if (q&&s&&c) {
      $.get("/collection/getbysaisonqualite", {qualite: q, saison: s, client: c}, function(infos) {
        if (infos) {
          const json = JSON.parse(infos);
          let html = '<div style="padding:5px 10px;">/!\ Qualité commandée par les clients suivants :</div><ul style="padding:0px 10px 10px 10px;" class="list-unstyled">';
          for (let i in json) {
            html += '<li><a href="'+i+'" target="_blank">'+json[i]+'</a></li>';
          }
          html += '</ul>';
          $('#alertBox').html(html);
        }
      });
    }
  });
  if($('#collection_qualite').length > 0) {
    $('#collection_qualite').trigger( "change" );
  }
  $('#collection_saison_id').on('change', function() {
    $('#collection_qualite').trigger( "change" );
  });
  $('#collection_client_id').on('change', function() {
    $('#collection_qualite').trigger( "change" );
  });

	// NOTE DE CREDIT CHOSEN
	$('#credit_saison_id').sortSelect().chosen({width: "90%"});
	$('#credit_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#credit_commercial_id').sortSelect().chosen({width: "90%"});
	$('#credit_client_id').sortSelect().chosen({width: "90%"});
	$('#credit_statut').sortSelect().chosen({width: "90%"});

	$('#credit_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#credit_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#credit_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#credit_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#credit_filters_statut').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});

	// LAB DIP CHOSEN
	$('#lab_dip_saison_id').sortSelect().chosen({width: "90%"});
	$('#lab_dip_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#lab_dip_client_id').sortSelect().chosen({width: "90%"});
	$('#lab_dip_statut').sortSelect().chosen({width: "90%"});

	$('#lab_dip_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#lab_dip_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#lab_dip_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#lab_dip_filters_statut').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});



	// FACTURES CHOSEN
	$('#facture_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#facture_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#facture_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#facture_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});


	// CLIENTS CHOSEN
	$('#client_filters_condition_paiement').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});


	// STATS CHOSEN
	$('#bon_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#bon_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#bon_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#bon_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#bon_filters_statut').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});


	$('#commande_filters_fournisseur_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#commande_filters_saison_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#commande_filters_client_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#commande_filters_commercial_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});


	$('#client_condition_paiement').sortSelect().chosen();
	$('#client_filters_condition_paiement').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});

  $('#fournisseur_devise_id').sortSelect().chosen();
  $('#commercial_devise_id').sortSelect().chosen();

	//$(':text').addClass('input');
});

$.initTemplateLigne = function() {
    $('.lien_ajouter_ligne').live('click', function() {
        var template = $($(this).attr('data-template'));
        var container = $($(this).attr('data-container'));

        var content = template.html().replace(/var---nbItem---/g, UUID.generate());
        container.append(content);

        return false;
    });

    $('.lien_supprimer_ligne').live('click', function() {
        if(!confirm('Etes vous sûr de voulois supprimer cet élément ?')) {
            return false;
        }

        $(this).parents(".relation_item_form").remove();

        return false;
    });
}
$.coupeDependentSelect = function() {
	if ($('#coupe_client_id').length != 0) {
	    $('#coupe_client_id').live('change', function() {
			$.coupeUpdateSelect();
	        return false;
	    });
	}
}
$.coupeUpdateSelect = function() {
	var client_id = $('#coupe_client_id').val();
	var url = $('#dependent_select_url_template').html().replace('var---id---', client_id);
	$.get(url, function(paiement) { $('#coupe_paiement').val(paiement); });
}

$.fn.sortSelect = function () {
	var mylist = $(this);
	var listitems = mylist.children('option').get();

	listitems.sort(function(a, b) {
	   var compA = $(a).text().toUpperCase();
	   var compB = $(b).text().toUpperCase();
	   return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
	})

	$.each(listitems, function(idx, itm) { mylist.append(itm); });
	return $(this);
}
