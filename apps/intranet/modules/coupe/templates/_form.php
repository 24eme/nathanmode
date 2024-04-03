<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="colLeft">
    <div class="tableau">
        <div class="titre"><span>Infos générales</span></div>
        <div id="alertBox" class="bg-danger" style="float:left;width:100%; margin-top: -10px;"></div>
        <div class="contentLeft" style="width: 100%">
            <table width="50%" border="0" cellpadding="0" cellspacing="0" class="tabloInfoGen">
                <tr>
                    <td width="110"><?php echo $form['saison_id']->renderLabel() ?>&nbsp;:</td>
                    <td>
                        <?php echo $form['saison_id']->render() ?>
                        <?php echo $form['saison_id']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['fournisseur_id']->renderLabel() ?>&nbsp;:</td>
                    <td>
                        <?php echo $form['fournisseur_id']->render() ?>
                        <?php echo $form['fournisseur_id']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['commercial_id']->renderLabel() ?>&nbsp;:</td>
                    <td>
                        <?php echo $form['commercial_id']->render() ?>
                        <?php echo $form['commercial_id']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['client_id']->renderLabel() ?>&nbsp;:</td>
                    <td>
                        <?php echo $form['client_id']->render() ?>
                        <?php echo $form['client_id']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['paiement']->renderLabel() ?>&nbsp;:</td>
                    <td>
                        <?php echo $form['paiement']->render() ?>
                        <?php echo $form['paiement']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['date_commande']->renderLabel() ?>&nbsp;:</td>
                    <td style="text-align:left;">
                        <?php echo $form['date_commande']->render() ?>
                        <?php echo $form['date_commande']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:top;">
                        <?php echo $form['fichier']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
                    </td>
                    <td class="uploadFile">
                        <?php echo $form['fichier']->render(array('class' => 'input')) ?>
                        <?php echo $form['fichier']->renderError() ?>
                    </td>
                </tr>
                <tr>
    			  <td><?php echo $form['num_facture']->renderLabel() ?></td>
    			  <td><?php echo $form['num_facture']->render() ?><br /><?php echo $form['num_facture']->renderError() ?></td>
    			  <?php if ($help = $form['num_facture']->renderHelp()): ?>
    			  <td class="help"><?php echo $help ?></td>
    			  <?php endif; ?>
    			</tr>
                <tr>
    			  <td><?php echo $form['montant_facture']->renderLabel() ?></td>
    			  <td><?php echo $form['montant_facture']->render() ?>&nbsp;<?php echo $form['devise_id']->render(array('class' => 'small')) ?><br /><?php echo $form['montant_facture']->renderError() ?><?php echo $form['devise_id']->renderError() ?></td>
    			  <?php if ($help = $form['montant_facture']->renderHelp()): ?>
    			  <td class="help"><?php echo $help ?></td>
    			  <?php endif; ?>
    			</tr>
            </table>
            <table width="50%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2">
                        <?php echo $form['commission_fournisseur']->render(array('class' => 'small input-float',)) ?>
                        <?php echo $form['fournisseur_devise_id']->render(array('class' => 'small')) ?>
                        <?php echo $form['commission_fournisseur']->renderError() ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['commission_commercial']->render(array('class' => 'small input-float')) ?>
                        <?php echo $form['commercial_devise_id']->render(array('class' => 'small')) ?>
                        <?php echo $form['commission_commercial']->renderError() ?>
                    </td>
                </tr>
                <tr>
                  <td><?php echo $form['tissu']->renderLabel() ?></td>
                  <td>
                    <?php echo $form['tissu']->render(array('list' => "liste_qualite", 'style' => 'width: 250px;')) ?><br /><?php echo $form['tissu']->renderError() ?>
                    <datalist id="liste_qualite">
                        <?php foreach(CoupeTable::getInstance()->getTissus() as $libelle): ?>
                        <option value="<?php echo $libelle['tissu'] ?>">
                        <?php endforeach; ?>
                    </datalist>
                  </td>
                  <?php if ($help = $form['tissu']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td><?php echo $form['colori']->renderLabel() ?></td>
                  <td><?php echo $form['colori']->render() ?><br /><?php echo $form['colori']->renderError() ?></td>
                  <?php if ($help = $form['colori']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td><?php echo $form['metrage']->renderLabel() ?></td>
                  <td><?php echo $form['metrage']->render() ?><br /><?php echo $form['metrage']->renderError() ?></td>
                  <?php if ($help = $form['metrage']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td><?php echo $form['piece_categorie']->renderLabel() ?></td>
                  <td><?php echo $form['piece_categorie']->render() ?><br /><?php echo $form['piece_categorie']->renderError() ?></td>
                  <?php if ($help = $form['piece_categorie']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td><?php echo $form['piece']->renderLabel() ?></td>
                  <td><?php echo $form['piece']->render() ?><br /><?php echo $form['piece']->renderError() ?></td>
                  <?php if ($help = $form['piece']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
                <tr>
                  <td><?php echo $form['prix']->renderLabel() ?></td>
                  <td><?php echo $form['prix']->render() ?><br /><?php echo $form['prix']->renderError() ?></td>
                  <?php if ($help = $form['prix']->renderHelp()): ?>
                  <td class="help"><?php echo $help ?></td>
                  <?php endif; ?>
                </tr>
            </table>
        </div>
    </div>
    <script id="dependent_select_url_template" type="text/x-jquery-tmpl">
    	<?php echo url_for('client/paiement?id=var---id---'); ?>
    </script>
</div>

<div class="tableau rightTab">
    <div class="titre"><span>Livraison</span></div>
    <div class="contentRight">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabloLivraison">
            <tr>
              <td width="30%" style="vertical-align:top;">
                  <?php echo $form['fichier_confirmation']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
              </td>
              <td class="uploadFile">
                  <?php echo $form['fichier_confirmation']->render(array('class' => 'input')) ?>
                  <?php echo $form['fichier_confirmation']->renderError() ?>
              </td>
            </tr>
            <tr>
                <td><?php echo $form['livre_le']->renderLabel() ?>&nbsp;:</td>
                <td style="text-align:left;">
                    <?php echo $form['livre_le']->render() ?>
                    <?php echo $form['livre_le']->renderError() ?>
                </td>
            </tr>
        </table>
    </div>
</div>


<script id="dependent_select_url_template" type="text/x-jquery-tmpl">
	<?php echo url_for('client/paiement?id=var---id---'); ?>
</script>