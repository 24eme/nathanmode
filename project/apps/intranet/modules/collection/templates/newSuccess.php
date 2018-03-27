<?php use_helper('I18N', 'Date') ?>
<?php include_partial('collection/assets') ?>

<?php echo form_tag_for($form, '@collection') ?>
  <div class="productName">
    <span>Nouvelle collection</span>
    <?php include_partial('collection/form_actions', array('collection' => $collection, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

    <?php include_partial('collection/flashes') ?>

    <?php echo $form->renderHiddenFields(false); ?>
    <?php echo $form->renderGlobalErrors(false); ?>

    <div class="colLeft">
        <?php include_partial('collection/formInfosGenerales', array('form' => $form)) ?>
        <?php include_partial('collection/formTirelles', array('form' => $form)) ?>
        <?php include_partial('collection/formFicheClient', array('form' => $form)) ?>
    </div>                                                                
    <?php include_partial('collection/formLivraisons', array('form' => $form)) ?>

</form>