<div class="tableau col-11">
    <div class="titre"><span>Livraison</span></div>
    <div class="px-2">
        <div class="subTitle">Livraisons</div>


        <table width="20%" border="0" style="margin:10px 0px;">
            <tr style="font-size:14px; display:flex; justify-content:space-between;">
                <td><?php echo $form['reste_a_livrer']->renderLabel() ?>&nbsp;:</td>
                <td><?php echo $form['reste_a_livrer']->render() ?>
                    <?php echo $form['reste_a_livrer']->renderError() ?></td>
            </tr>
        </table>
        <?php include_partial('collection/relationLivraisonsForm', array('form' => $form)) ?>

        <div class="subTitle">Retards</div>

        <?php include_partial('collection/relationRetardsForm', array('form' => $form)) ?>

        <div class="subTitle"><?php echo $form['observation_livraison']->renderLabel() ?></td></div>

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
