<?php if (isset($form['tirelles'])): ?>
<div class="tableau col-11">
    <div class="titre"><span>Tirelle</span></div>
    <div class="px-2">
        <?php include_partial('collection/relationTirellesForm', array('form' => $form)) ?>

        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="150"><?php echo $form['observation_tirelle']->renderLabel() ?> :</td>
            <td>
              <?php echo $form['observation_tirelle']->renderError() ?>
              <?php echo $form['observation_tirelle']->render(array('class' => 'txtArea')) ?>
            </td>
          </tr>
        </table>
    </div>
</div>
<?php endif; ?>
