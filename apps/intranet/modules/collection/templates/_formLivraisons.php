<div class="tableau col-11">
    <div class="titre"><span>Livraison</span></div>
    <div class="px-2">
        <div class="subTitle">Livraison globale</div>

        <table width="20%" border="0" style="margin:10px 0px;">
            <tr style="font-size:14px; display:flex; justify-content:space-between;">
                <td><?php echo $form['reste_a_livrer']->renderLabel() ?>&nbsp;:</td>
                <td><?php echo $form['reste_a_livrer']->render() ?>
                    <?php echo $form['reste_a_livrer']->renderError() ?></td>
            </tr>
        </table>

        <?php if (! empty($form['date_livraison']->getValue()) || ! empty($form['adresse_livraison']->getValue()) || ! empty($form['fichier_confirmation']->getValue())): ?>
            <div style="display:inline-block; width:100%; margin:20px 0;">
                <table width="40%" border="0" cellpadding="0" cellspacing="0" class="tabloLivraison">
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
                    <tr>
                        <td width="150" style="vertical-align:top;">
                            <?php echo $form['fichier_confirmation']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
                        </td>
                        <td class="uploadFile">
                            <?php echo $form['fichier_confirmation']->render(array('class' => 'input')) ?>
                            <?php echo $form['fichier_confirmation']->renderError() ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <div class="px-2">
        <div class="subTitle">Livraison par produit</div>
        <?php include_partial('collection/relationLivraisonsForm', array('form' => $form)) ?>

        <div class="subTitle">Retards</div>

        <?php include_partial('collection/relationRetardsForm', array('form' => $form)) ?>

        <div class="subTitle"><?php echo $form['observation_livraison']->renderLabel() ?></div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <?php echo $form['observation_livraison']->renderError() ?>
              <?php echo $form['observation_livraison']->render(array('class' => 'txtArea')) ?>
            </td>
          </tr>
        </table>
    </div>
</div>
