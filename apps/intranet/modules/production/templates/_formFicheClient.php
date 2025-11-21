<div class="tableau">
    <div class="titre"><span>Fiche client</span></div>
    <div class="contentLeft">
        <table width="60%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="vertical-align:top;">
                    <?php echo $form['fiche_technique']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
                </td>
                <td class="uploadFile">
                    <?php echo $form['fiche_technique']->render(array('class' => 'input')) ?>
                    <?php echo $form['fiche_technique']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">
                    <?php echo $form['fiche_client']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
                </td>
                <td class="uploadFile">
                    <?php echo $form['fiche_client']->render(array('class' => 'input')) ?>
                    <?php echo $form['fiche_client']->renderError() ?>
                </td>
            </tr>
        </table>    
        <?php echo $form['observation_client']->renderError() ?>
        <?php echo $form['observation_client']->render(array('class' => 'txtAreaBig')) ?>              
    </div>
</div>