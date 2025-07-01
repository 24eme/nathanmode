<div class="tableau col-8">
    <div class="titre"><span>Test matière</span></div>
    <div class="contentLeft">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="30%"><?php echo $form['tm_date_expedition']->renderLabel() ?> :</td>
                <td style="text-align:left;">
                    <?php echo $form['tm_date_expedition']->render() ?>
                    <?php echo $form['tm_date_expedition']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['tm_refus_test']->renderLabel() ?> :</td>
                <td>
                    <?php echo $form['tm_refus_test']->render() ?>
                    <?php echo $form['tm_refus_test']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['tm_validation']->renderLabel() ?> :</td>
                <td>
                    <?php echo $form['tm_validation']->render() ?>
                    <?php echo $form['tm_validation']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['tm_date_expedition_coteco']->renderLabel() ?> :</td>
                <td style="text-align:left;">
                    <?php echo $form['tm_date_expedition_coteco']->render() ?>
                    <?php echo $form['tm_date_expedition_coteco']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['tm_metrage_coteco']->renderLabel() ?> :</td>
                <td>
                    <?php echo $form['tm_metrage_coteco']->render() ?>
                    <?php echo $form['tm_metrage_coteco']->renderError() ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['tm_validation_coteco']->renderLabel() ?> :</td>
                <td>
                    <?php echo $form['tm_validation_coteco']->render() ?>
                    <?php echo $form['tm_validation_coteco']->renderError() ?>
                </td>
            </tr>
        </table> 
        <?php echo $form['tm_observation']->renderError() ?>
        <?php echo $form['tm_observation']->render(array('class' => 'txtAreaBig')) ?>   
    </div>
</div>