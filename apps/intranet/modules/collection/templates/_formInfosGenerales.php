<div class="tableau">
    <div class="titre"><span>Infos générales</span></div>
    <div id="alertBox" class="bg-danger" style="float:left;width:100%; margin-top: -10px;"></div>
    <div class="contentLeft">
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
                <td><?php echo $form['num_commande']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['num_commande']->render() ?>
                    <?php echo $form['num_commande']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['date_commande']->renderLabel() ?>&nbsp;:</td>
                <td style="text-align:left;">
                    <?php echo $form['date_commande']->render() ?>
                    <?php echo $form['date_commande']->renderError() ?>&nbsp;(jj/mm/aaaa)
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
        </table>
        <table width="50%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="103"><?php echo $form['situation']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['situation']->render() ?>
                    <?php echo $form['situation']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form['prix_fournisseur']->render(array('class' => 'small')) ?>
                    <?php echo $form['devise_fournisseur_id']->render(array('class' => 'small')) ?>
                    <?php echo $form['prix_fournisseur']->renderError() ?>
                </td>
            </tr>
            <tr>                            
                <td colspan="2">
                    <?php echo $form['prix_commercial']->render(array('class' => 'small')) ?>
                    <?php echo $form['devise_commercial_id']->render(array('class' => 'small')) ?>
                    <?php echo $form['prix_commercial']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['qualite']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['qualite']->render(array('class' => 'small')) ?>
                    <?php echo $form['qualite']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['ecru']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['ecru']->render(array('class' => 'small')) ?>
                    <?php echo $form['ecru']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                   <?php include_partial('collection/relationDetailsForm', array('form' => $form)) ?>
                </td>
            </tr>
        </table>
        <?php echo $form['observation_general']->renderError() ?>
        <?php echo $form['observation_general']->render(array('class' => 'txtAreaBig')) ?>
    </div>
</div>
<script id="dependent_select_url_template" type="text/x-jquery-tmpl">
	<?php echo url_for('client/paiement?id=var---id---'); ?>
</script>

