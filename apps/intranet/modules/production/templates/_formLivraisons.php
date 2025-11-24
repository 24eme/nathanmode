<div class="tableau col-11">
    <div class="titre"><span>Livraison</span></div>
    <div class="px-2">
        <div class="subTitle">Livraison globale</div>

        <div style="display:inline-block; width:100%; margin:20px 0;">
            <table width="40%" border="0" cellpadding="0" cellspacing="0" class="tabloLivraison">
                <?php if (! empty($form['date_livraison']->getValue()) || ! empty($form['adresse_livraison']->getValue()) || ! empty($form['fichier_confirmation']->getValue())): ?>
                            <tr>
                                <td width="150"><?php echo $form['date_livraison']->renderLabel() ?>&nbsp;:</td>
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
                <?php endif; ?>
            </table>
        </div>
    </div>
    <div class="px-2">
        <div class="subTitle">Livraison par produit</div>
        <?php include_partial('production/relationLivraisonsForm', array('form' => $form)) ?>

        <div class="subTitle">Retards</div>

        <?php include_partial('production/relationRetardsForm', array('form' => $form)) ?>

        <?php if (! empty($form['observation_livraison']->getValue())) : ?>
            <div class="subTitle"><?php echo $form['observation_livraison']->renderLabel() ?></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                    <?php echo $form['observation_livraison']->renderError() ?>
                    <?php echo $form['observation_livraison']->render(array('class' => 'txtArea')) ?>
                    </td>
                </tr>
            </table>
        <?php endif;?>
    </div>
</div>
