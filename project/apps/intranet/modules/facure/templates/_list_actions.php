<?php echo link_to(__('Rapport des factures', array(), 'messages'), 'facure/facturesCsv', array()) ?>
<?php echo link_to(__('Rapport des factures non commissionnées', array(), 'messages'), 'facure/rapport', array()) ?>
<?php echo link_to(__('Factures archivées', array(), 'messages'), 'facure_payee/index', array()) ?>
<a href="javascript:void(0)" id="payer">Payer les factures</a>
<div id="dialog-form" title="Payer les factures">
	<p style="padding: 10px 0;">Selectionner la date de paiement des factures de la liste.</p>
	<form action="<?php echo url_for('facure/payer') ?>" method="post">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td width="30%"><label for="facture_date_debit">Date de paiement</label></td>
	  				<td><input type="text" id="facture_date_debit" name="facture_date_debit"><br></td>
	              	<td class="help"><br>(jj/mm/aaaa)</td>
	      		</tr>
			</tbody>
		</table>
	</form>
</div>
 <script type="text/javascript">
$(function() {
var dialog, form
date = $( "#date" );

dialog = $( "#dialog-form" ).dialog({
autoOpen: false,
height: 190,
width: 500,
modal: true,
buttons: {
"Valider": function() {
form[0].submit();
}
},
close: function() {
form[ 0 ].reset();
allFields.removeClass( "ui-state-error" );
}
});

form = dialog.find( "form" ).on( "submit", function( event ) {
event.preventDefault();
});

$( "#payer" ).on( "click", function() {
dialog.dialog( "open" );
});
});
</script>