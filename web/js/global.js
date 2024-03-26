$(document).ready(function() {
    $.initTemplateLigne();

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

  $('.actions input[type=submit]').on('click', function(event) {
    $(this).css('visibility', 'hidden');
    var buttonValider = $(this);
    setTimeout(function() { buttonValider.attr('disabled', 'disabled'); buttonValider.css('visibility', 'visible'); }, 500);
  });

	// COUPE CHOSEN
	$('#coupe_saison_id').chosen({width: "90%"});
	$('#coupe_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#coupe_client_id').sortSelect().chosen({width: "90%"});
	$('#coupe_commercial_id').sortSelect().chosen({width: "90%"});
	$('#coupe_paiement').sortSelect().chosen({width: "90%"});
	$('#coupe_devise_id').sortSelect().chosen({width: "25%"});
  $('#coupe_situation').sortSelect().chosen({width: "90%"});
  $('#coupe_fournisseur_devise_id').sortSelect().chosen({width: "25%"});
  $('#coupe_commercial_devise_id').sortSelect().chosen({width: "25%"});
  $('#coupe_piece_categorie').sortSelect().chosen({width: "90%"});


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
	$('#coupe_filters_tissu').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
	$('#coupe_filters_piece_categorie').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});
    $('#coupe_filters_situation').sortSelect().chosen({
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

    // COUPE MULTIPLE CHOSEN

    $('#table_coupe_multiple').find('[name*="saison_id"]').chosen();
    $('#table_coupe_multiple').find('[name*="commercial_id"]').sortSelect().chosen();
    $('#table_coupe_multiple').find('[name*="fournisseur_id"]').sortSelect().chosen();
    $('#table_coupe_multiple').find('[name*="client_id"]').sortSelect().chosen();
    $('#table_coupe_multiple').find('[name*="quantite_type"]').chosen();
    $('#table_coupe_multiple').find('[name*="situation"]').chosen();

    function addCoupeMultipleLine() {
        const lastLine = $('.coupe_multiple_ligne').last();
        lastLine.find('[name*="saison_id"]').chosen("destroy");
        lastLine.find('[name*="commercial_id"]').chosen("destroy");
        lastLine.find('[name*="fournisseur_id"]').chosen("destroy");
        lastLine.find('[name*="client_id"]').chosen("destroy");
        lastLine.find('[name*="quantite_type"]').chosen("destroy");
        lastLine.find('[name*="situation"]').chosen("destroy");
        let newLineIndex = parseInt(lastLine.attr('data-line-index')) + 1;
        let newLineHTML = lastLine.prop('outerHTML');
        lastLine.find('[name*="saison_id"]').chosen();
        lastLine.find('[name*="commercial_id"]').chosen();
        lastLine.find('[name*="fournisseur_id"]').chosen();
        lastLine.find('[name*="client_id"]').chosen();
        lastLine.find('[name*="quantite_type"]').chosen();
        lastLine.find('[name*="situation"]').chosen();
        newLineHTML = newLineHTML.replace(/coupe_multiple_coupes_[0-9]+/g, 'coupe_multiple_coupes_'+newLineIndex);
        newLineHTML = newLineHTML.replace(/coupe_multiple\[coupes\]\[[0-9]+\]/g, 'coupe_multiple[coupes]['+newLineIndex+']');
        let newLine = $(newLineHTML);
        newLine.attr('data-line-index', newLineIndex);
        newLine.find('[name*="saison_id"]').val(lastLine.find('[name*="saison_id"]').val());
        newLine.find('[name*="commercial_id"]').val(lastLine.find('[name*="commercial_id"]').val());
        newLine.find('[name*="date_commande"]').val(lastLine.find('[name*="date_commande"]').val());
        newLine.find('[name*="num_commande"]').val(lastLine.find('[name*="num_commande"]').val());
        newLine.find('[name*="fournisseur_id"]').val(lastLine.find('[name*="fournisseur_id"]').val());
        newLine.find('[name*="client_id"]').val(lastLine.find('[name*="client_id"]').val());
        newLine.find('[name*="qualite"]').val(lastLine.find('[name*="qualite"]').val());

        newLine = newLine.insertAfter(lastLine);
        newLine.css('opacity', 0.5);
        newLine.find('.required').removeAttr('required');
        newLine.find('[name*="saison_id"]').chosen();
        newLine.find('[name*="commercial_id"]').chosen();
        newLine.find('[name*="fournisseur_id"]').chosen();
        newLine.find('[name*="client_id"]').chosen();
        newLine.find('[name*="quantite_type"]').chosen();
        newLine.find('[name*="situation"]').chosen();
        newLine.find('.input-float').inputNumberFormat();
    }
    
    $('#table_coupe_multiple').on('keypress', 'input, select', function(e) {
        activeLine($(e.currentTarget).parents('.coupe_multiple_ligne'));
    });
    $('#table_coupe_multiple').on('change', 'input, select', function(e) {
        activeLine($(e.currentTarget).parents('.coupe_multiple_ligne'));
    });
    $('#table_coupe_multiple').on('click', '.chosen-single', function(e) {
        activeLine($(e.currentTarget).parents('.coupe_multiple_ligne'));
    });

    $('#table_coupe_multiple').on('change', '[name*="qualite"]', function() {
        verifUniciteCommande($(this).parents('.coupe_multiple_ligne'));
    });
    $('#table_coupe_multiple').on('change', '[name*="client_id"]', function() {
        verifUniciteCommande($(this).parents('.coupe_multiple_ligne'));
    });
    $('#table_coupe_multiple').on('change', '[name*="saison_id"]', function() {
        verifUniciteCommande($(this).parents('.coupe_multiple_ligne'));
    });
    
    function activeLine(line) {
        line.css('opacity', '1');
        line.find('.required').attr('required', 'required');
    }

    function verifUniciteCommande(line) {
        let q = line.find('[name*="qualite"]').val();
        let s = line.find('[name*="saison_id"]').val();
        let c = line.find('[name*="client_id"]').val();
        
        $('#alertBox').hide();
        $('#alertBox').html('');
        if (q&&s&&c) {
          $.get("/collection/getbysaisonqualite", {qualite: q, saison: s, client: c, coupe: 1}, function(infos) {
            if (infos) {
              const json = JSON.parse(infos);
              let html = '<div style="padding:5px 10px;">/!\ Qualité "'+q+'" commandée par les clients suivants :</div><ul style="padding:0px 10px 10px 10px;" class="list-unstyled">';
              for (let i in json) {
                html += '<li><a href="'+i+'" target="_blank">'+json[i]+'</a></li>';
              }
              html += '</ul>';
              $('#alertBox').html(html);
              $('#alertBox').show();
            }
          });
        }
    }
 
    $('#table_coupe_multiple').on('focus', '.coupe_multiple_ligne:last input:last', function(e) {
        let id = $(this).parents('.chosen-container-single').attr('id');
        addCoupeMultipleLine();
        $('#'+id+' input').focus();
    });


    $('#lien_ajouter_ligne').on('click', function(e) {
        addCoupeMultipleLine();

        return false;
    });
    
    $('#table_coupe_multiple').on('click',  '.lien_supprimer_ligne_tr', function(e) {
        if(!confirm('Etes vous sûr de voulois supprimer cet élément ?')) {
            return false;
        }
        $(this).parents('tr').remove();
        return false;
    });

    $('.sf_admin_row').on('blur', 'input[type="text"].submit_ajax_on_change', function() {
        saveFormPartialAjax(this);
    });
    
    $('.sf_admin_row').on('blur', 'input[type="date"].submit_ajax_on_change', function() {
        saveFormPartialAjax(this);
    });
    
    $('.sf_admin_row').on('change', 'select.submit_ajax_on_change', function() {
        saveFormPartialAjax(this);
    });
    
    $('.sf_admin_row').on('change', 'input[type="file"].submit_ajax_on_change', function() {
        saveFormPartialAjax(this);
    });
    
    var saveFormPartialAjax = function(element){
        element.style.visibility = 'hidden';
        let form = $('#' + $(element).attr('form'));
        formData = new FormData(document.getElementById($(element).attr('form')));
        let xhr = new XMLHttpRequest();
        xhr.open(form.attr('method'), form.attr('action'), true);
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200 && element.dataset.partialview) {
                $(element).parents('td').load(element.dataset.partialview);
            }
        };
        xhr.send(formData);
    }
    
    var inputDiscreetState = function(element, focus) {
        if(focus || element.value || element.querySelectorAll('option[selected]').length > 0) {
            element.style.opacity = '1';
        } else {
            element.style.opacity = '0.3';
        }
    }
    document.querySelectorAll('.input-discreet').forEach(function(item) {
        inputDiscreetState(item, false);
    });
    $('body').on('focus', '.input-discreet', function() {
        inputDiscreetState(this, true);
    });
    $('body').on('blur', '.input-discreet', function() {
        inputDiscreetState(this, false);
    });
    $('td .clic2showfield').parent('td').on('click', function() {
        $(this).find('input').show();
        $(this).find('span').hide();
    });

    $('.input-float').inputNumberFormat();

	// COLLECTION & PRODUCTION CHOSEN
	$('#collection_saison_id').chosen({width: "90%"});
	$('#collection_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#collection_commercial_id').sortSelect().chosen({width: "90%"});
	$('#collection_client_id').sortSelect().chosen({width: "90%"});
	$('#collection_paiement').sortSelect().chosen({width: "90%"});
	$('#collection_situation').sortSelect().chosen({width: "90%"});
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

  $('#coupe_fournisseur_id').on('change', function() {
    const fId = this.value;
    $.get("/fournisseur/"+fId+"/getcommission", function(infos) {
      const json = JSON.parse(infos);
      $('#coupe_commission_fournisseur').val(json.commission);
      $('#coupe_devise_fournisseur_id').val(json.devise_id);
      $('#coupe_devise_fournisseur_id').trigger("chosen:updated");
    });
  });

  if($('#coupe_fournisseur_id').length > 0 && !editUrlRegexp.test($('form').attr('action'))) {
    $('#coupe_fournisseur_id').trigger( "change" );
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

  $('#coupe_client_id').on('change', function() {
    const cId = this.value;
    $.get("/client/"+cId+"/getpaiement", function(infos) {
      const json = JSON.parse(infos);
      $('#coupe_paiement').val(json.paiement);
      $('#coupe_paiement').trigger("chosen:updated");
    });
  });
  if($('#coupe_client_id').length > 0 && !editUrlRegexp.test($('form').attr('action'))) {
    $('#coupe_client_id').trigger( "change" );
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


  $('#coupe_tissu').on('change', function() {
    const q = this.value;
    const s = $('#coupe_saison_id').val();
    const c = $('#coupe_client_id').val();
    $('#alertBox').html('');
    if (q&&s&&c) {
      $.get("/collection/getbysaisonqualite", {qualite: q, saison: s, client: c, coupe: 1}, function(infos) {
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
  if($('#coupe_tissu').length > 0) {
    $('#coupe_tissu').trigger( "change" );
  }
  $('#coupe_saison_id').on('change', function() {
    $('#coupe_tissu').trigger( "change" );
  });
  $('#coupe_client_id').on('change', function() {
    $('#coupe_tissu').trigger( "change" );
  });

	// NOTE DE CREDIT CHOSEN
	$('#credit_saison_id').chosen({width: "90%"});
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

  $('#sf_admin_batch_actions_form').submit(function( event ) {
    var datasTab = $(this).serializeArray();
    var datas = {};
    $(datasTab).each(function(i, field){
      datas[field.name] = field.value;
    });
    if (!datas.hasOwnProperty('date')||!datas['date']) {
      $('#facturePayeeDateChoiceModal').modal({show:true});
      event.preventDefault();
    }
  });
  $('#sf_admin_batch_actions_complete_form').submit(function( event ) {
      var date = $(this).find("input[type=date]").val();
      $('#sf_admin_batch_actions_date').val(date);
      $('#sf_admin_batch_actions_form').submit();
      event.preventDefault();
  });

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
