function getDatasFromForm(form) {
  var elements = form.querySelectorAll('input, select, textarea');
  var datas = {};
  elements.forEach(element => {
    datas[element.name] = element.value;
  });
  return datas;
}
function compareObj(obj1, obj2) {
  var ret = {};
  for(var i in obj2) {
    if(!obj1.hasOwnProperty(i) || obj2[i] !== obj1[i]) {
      if (i && obj2[i]) {
        ret[i] = obj2[i];
      }
    }
  }
  return ret;
};

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


  $('form').submit(function(e){
      e.preventDefault();
      $('form input[type=submit]').prop('disabled', true);
      $(this).unbind('submit').submit();
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
  $('.chosen').chosen({width: "100%"});
  $('.smallchosen').chosen({width: "35%"});
	$('#collection_saison_id').chosen({width: "90%"});
	$('#collection_fournisseur_id').sortSelect().chosen({width: "90%"});
	$('#collection_commercial_id').sortSelect().chosen({width: "90%"});
	$('#collection_client_id').sortSelect().chosen({width: "90%"});
	$('#collection_paiement').sortSelect().chosen({width: "90%"});
	$('#collection_situation').sortSelect().chosen({width: "90%"});
  $('#collection_devise_fournisseur_id').sortSelect().chosen({width: "35%"});
  $('#collection_devise_commercial_id').sortSelect().chosen({width: "35%"});
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

  $('#fournisseur_filters_devise_id').sortSelect().chosen({
    	placeholder_text_single: "-",
		allow_single_deselect:true,
   	 	width: "100%"
  	});

  $('#commercial_filters_devise_id').sortSelect().chosen({
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



  $(document).on('submit', "#sf_admin_batch_actions_form", function(event) {
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

  $(document).on('submit', "#sf_admin_batch_actions_complete_form", function(event) {
      var date = $(this).find("input[type=date]").val();
      $('#sf_admin_batch_actions_date').val(date);
      $('#sf_admin_batch_actions_form').submit();
      event.preventDefault();
  });

  updateIndicateurs();
  updateDeviseSymbol();
  $("#collection_devise_id").on("change", function () { updateIndicateurs(), updateDeviseSymbol(); });
  $("#collection_part_frais").on("change", function () { updateIndicateurs() });
  $("#collection_prix_public").on("change", function () { updateIndicateurs() });


  $('.lien_ajouter_ligne_livraison').live('click', function() {
      document.getElementById("ajouter_livraison").click();
      const reference = $(this).closest('tr').find('.reference').val();
      const colori = $(this).closest('tr').find('.colori').val();
      const quantite = $(this).closest('tr').find('.quantite').val();
      const prixVente = $(this).closest('tr').find('.prix_vente').val();
      const ligne = $('#form_livraisons_container tr:last');
      ligne.find('.reference').val(reference);
      ligne.find('.colori').val(colori);
      ligne.find('.quantite').val(resteALivrer);
      ligne.find('.prix_vente').val(prixVente);
      document.getElementById("ajouter_livraison").scrollIntoView({ behavior: "smooth" });
      event.preventDefault();
  });

});

function updateIndicateurs() {
  const lignes = document.querySelectorAll('.ligne_calcul_marges');
  lignes.forEach(ligne => {
    const inputAchat = ligne.querySelector('.prix_achat');
    const inputVente = ligne.querySelector('.prix_vente');
    const inputFrais = ligne.querySelector('.part_frais');
    if (inputAchat && inputVente) {
        inputAchat.addEventListener('input', () => calculeIndicateurs(ligne));
        inputVente.addEventListener('input', () => calculeIndicateurs(ligne));
	inputFrais.addEventListener('input', () => calculeIndicateurs(ligne))
        calculeIndicateurs(ligne);
      }
  });
}

function calculeIndicateurs(tr) {
  const usdRate = document.getElementById('collection_usd_rate').value;
  const eurRate = document.getElementById('collection_eur_rate').value;
  const devise = document.getElementById('collection_devise_id').value;

  document.querySelectorAll('.ligne_calcul_marges').forEach(calcMargesLigne => {

    const pxPublicId = calcMargesLigne.querySelector('[id^="collection_details_"][id$="_prix_public"]');
    const prixPublicTTC = parseFloat(pxPublicId.value) || 0;
    const prixPublicHT = prixPublicTTC ? (prixPublicTTC / 1.2).toFixed(2) : 0;
    console.log(prixPublicHT);

    const inputAchat = calcMargesLigne.querySelector('.prix_achat');
    const inputVente = calcMargesLigne.querySelector('.prix_vente');
    const spanMargeEur = calcMargesLigne.querySelector('.marge_eur');
    const spanMargeUsd = calcMargesLigne.querySelector('.marge_usd');
    const spanCoef = calcMargesLigne.querySelector('.marge_coef');
    const spanPart = calcMargesLigne.querySelector('.marge_part');
    const spanCoefClient = calcMargesLigne.querySelector('.marge_client_coef');
    const spanPartClient = calcMargesLigne.querySelector('.marge_client_part');

    const prixAchat = parseFloat(inputAchat.value) || 0;
    const prixVente = parseFloat(inputVente.value) || 0;

    const marge = prixVente - prixAchat;
    const coef = prixAchat !== 0 ? prixVente / prixAchat : 0;
    const part = prixVente !== 0 ? marge / prixVente * 100 : 0;
    let prixVenteEur  = prixVente;

    if (devise == 1) {
      spanMargeEur.textContent = marge.toFixed();
      spanMargeUsd.textContent = (marge*usdRate).toFixed();
    } else if (devise == 2) {
      spanMargeUsd.textContent = marge.toFixed();
      spanMargeEur.textContent = (marge*eurRate).toFixed();
      prixVenteEur *= eurRate;
    }

    spanCoef.textContent = coef.toFixed(2);
    spanPart.textContent = part.toFixed(2);

    const partFraisId = calcMargesLigne.querySelector('[id^="collection_details_"][id$="_part_frais"]');

    const frais = parseFloat(partFraisId.value) || 0;
    const prixClient = prixVenteEur * (1+frais/100);
    const coefClient = prixClient !== 0 ? prixPublicHT / prixClient : 0;
    const partClient = prixPublicHT !== 0 ? (prixPublicHT - prixClient) / prixPublicHT * 100 : 0;

    spanCoefClient.textContent = coefClient.toFixed(2);
    spanPartClient.textContent = partClient.toFixed(2);
  });

}

function updateDeviseSymbol() {
  const spansDeviseSymbols = document.querySelectorAll('.devise-symbol');

  if (document.getElementById('collection_devise_id')) {
    const devise = document.getElementById('collection_devise_id').value;
    spansDeviseSymbols.forEach(function (spanDeviseSymbol) {
      if (devise == 1) {
        spanDeviseSymbol.textContent = '€';
      } else if (devise == 2) {
        spanDeviseSymbol.textContent = '$';
      }
    });
  }
}

$.initTemplateLigne = function() {
    $('.lien_ajouter_ligne').live('click', function() {
        var template = $($(this).attr('data-template'));
        var container = $($(this).attr('data-container'));

        var content = template.html().replace(/var---nbItem---/g, UUID.generate());
        container.append(content);
        $('.chosen').chosen({width: "90%"});
        $('.smallchosen').chosen({width: "35%"});

        updateIndicateurs();
        updateDeviseSymbol();
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

$(document).ready(function () {
  if (".default-dollar") {
    let champDevise = $(".default-dollar .chosen");
    $(champDevise).val("2").trigger('chosen:updated').trigger('change');
  }
});
