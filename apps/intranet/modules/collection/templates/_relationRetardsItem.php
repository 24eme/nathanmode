<div class="relation_item_form">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30%">
                <?php echo $form['date']->renderLabel() ?>&nbsp;:
            </td>
            <td style="text-align:left;">
                <?php echo $form['date']->render() ?>
                <?php echo $form['date']->renderError() ?>
            </td>
        </tr>
    </table>
    <?php echo $form['observation']->renderError() ?>
    <?php echo $form['observation']->render(array('class' => 'txtArea')) ?>
    <a class="lien_supprimer_ligne" href="#">Supprimer</a>
    <div class="dash">
        &nbsp;
    </div>
</div>