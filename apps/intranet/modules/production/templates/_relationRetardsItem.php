<div class="relation_item_form">
    <table width="50%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1rem; border-bottom: 1px solid #E1E1E1;">
        <tr>
            <td width="150">
                <?php echo $form['date']->renderLabel() ?>&nbsp;:
            </td>
            <td style="text-align:left;">
                <?php echo $form['date']->render() ?>
                <?php echo $form['date']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form['observation']->renderLabel() ?>&nbsp;:
            </td>
            <td style="text-align:left;">
                <?php echo $form['observation']->render(array('class' => 'txtArea')) ?>
                <?php echo $form['observation']->renderError() ?>
            </td>
        </tr>
        <tr>
          <td colspan="2" align="right" style="padding-right: 8%;">
            <a class="lien_supprimer_ligne" href="#">supprimer</a>
          </td>
        </tr>
    </table>
</div>
