<div class="tableau col-8">
    <div class="titre"><span>Tirelle</span></div>
    <div class="contentLeft">
        <?php include_partial('collection/relationTirellesForm', array('form' => $form)) ?>

        <?php echo $form['observation_tirelle']->renderError() ?>
        <?php echo $form['observation_tirelle']->render(array('class' => 'txtAreaBig')) ?>
    </div>
</div>
