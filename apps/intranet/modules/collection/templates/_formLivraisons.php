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
                <td><?php echo $form['date_livraison']->renderLabel() ?>&nbsp;:</td>
                <td style="text-align:left;">
                    <?php echo $form['date_livraison']->render() ?>
                    <?php echo $form['date_livraison']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['adresse_livraison']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['adresse_livraison']->render() ?>
                    <?php echo $form['adresse_livraison']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['reste_a_livrer']->renderLabel() ?>&nbsp;:</td>
                <td>
                    <?php echo $form['reste_a_livrer']->render() ?>
                    <?php echo $form['reste_a_livrer']->renderError() ?>
                </td>
            </tr>
        </table>
        <?php echo $form['observation_livraison']->renderError() ?>
        <?php echo $form['observation_livraison']->render(array('class' => 'txtArea')) ?>

        <?php include_partial('collection/relationRetardsForm', array('form' => $form)) ?>

        <?php include_partial('collection/relationLivraisonsForm', array('form' => $form)) ?>
        
        <div class="subTitle">Commande soldée</div>   
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <?php echo $form['commande_soldee']->render() ?>
                    <?php echo $form['commande_soldee']->renderError() ?> 
                </td>
            </tr>
        </table>
    </div>
</div>