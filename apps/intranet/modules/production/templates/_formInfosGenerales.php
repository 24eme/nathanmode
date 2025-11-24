<div class="tableau col-11">
    <div class="titre"><span>Infos générales</span></div>
    <div id="alertBox" class="bg-danger" style="float:left;width:100%; margin-top: -10px;"></div>
    <div class="px-2">
        <table width="33%" border="0" cellpadding="0" cellspacing="0" class="tabloInfoGen">
            <tr>
                <td width="150"><?php echo $form['saison_id']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['saison_id']->render(['required' => 'required']) ?>
                    <?php echo $form['saison_id']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['fournisseur_id']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['fournisseur_id']->render(['required' => 'required']) ?>
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
                    <?php echo $form['client_id']->render(['required' => 'required']) ?>
                    <?php echo $form['client_id']->renderError() ?>
                </td>
            </tr>
            <tr>
              <td><?php echo $form['paiement']->renderLabel() ?>&nbsp;:</td>
              <td>
                  <?php echo $form['paiement']->render(['required' => 'required']) ?>
                  <?php echo $form['paiement']->renderError() ?>
              </td>
            </tr>
        </table>
        <table width="33%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td><?php echo $form['paiement']->renderLabel() ?>&nbsp;:</td>
              <td>
                  <?php echo $form['paiement']->render(['required' => 'required']) ?>
                  <?php echo $form['paiement']->renderError() ?>
              </td>
          </tr>
          <tr>
              <td width="150"><?php echo $form['num_commande']->renderLabel() ?>&nbsp;:</td>
              <td colpsan="2">
                  <?php echo $form['num_commande']->render(['required' => 'required']) ?>
                  <?php echo $form['num_commande']->renderError() ?>
              </td>
          </tr>
          <tr>
              <td><?php echo $form['date_commande']->renderLabel() ?>&nbsp;:</td>
              <td style="text-align:left;" colpsan="2">
                  <?php echo $form['date_commande']->render(['required' => 'required']) ?>
                  <?php echo $form['date_commande']->renderError() ?>
              </td>
          </tr>
          <tr>
              <td style="vertical-align:top;">
                  <?php echo $form['fichier']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
              </td>
              <td class="uploadFile" colpsan="2">
                  <?php echo $form['fichier']->render(array('class' => 'input')) ?>
                  <?php echo $form['fichier']->renderError() ?>
              </td>
          </tr>
            <?php if(isset($form['ecru'])): ?>
            <tr>
                <td><?php echo $form['ecru']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['ecru']->render() ?>
                    <?php echo $form['ecru']->renderError() ?>
                </td>
              </tr>
            <?php endif; ?>
          </table>

          <table width="33%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td  width="150"><?php echo $form['devise_id']->renderLabel() ?>&nbsp;:</td>
                <td <?php if (sfConfig::get('app_no_metrage')): ?> class="default-dollar" <?php endif ?> >
                    <?php echo $form['devise_id']->render(array('class' => 'chosen')) ?>
                    <?php echo $form['devise_id']->renderError() ?>
                </td>
        </tr>
            <?php if(isset($form['prix_fournisseur'])): ?>
            <tr>
                <td><?php echo $form['prix_fournisseur']->renderLabel() ?>&nbsp;:</td>
                <td>
                  <?php echo $form['prix_fournisseur']->render(array('class' => 'small input-float', 'required' => 'required', 'style' => 'width: 40% !important;')) ?>
                  <?php echo $form['devise_fournisseur_id']->render(array('class' => 'small')) ?>
                  <?php echo $form['prix_fournisseur']->renderError() ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td><?php echo $form['situation']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['situation']->render() ?>
                    <?php echo $form['situation']->renderError() ?>
                </td>
            </tr>
          </table>

          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="150"><?php echo $form['observation_general']->renderLabel() ?> :</td>
              <td>
                <?php echo $form['observation_general']->renderError() ?>
                <?php echo $form['observation_general']->render(array('class' => 'txtAreaSmall')) ?>
              </td>
            </tr>
          </table>
    </div>
</div>
<script id="dependent_select_url_template" type="text/x-jquery-tmpl">
	<?php echo url_for('client/paiement?id=var---id---'); ?>
</script>
