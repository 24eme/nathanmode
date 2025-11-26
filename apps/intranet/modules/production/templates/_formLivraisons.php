<div class="tableau col-11">
    <div class="titre"><span>Livraison</span></div>
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
