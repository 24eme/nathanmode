<?php use_helper('I18N', 'Date') ?>

<?php echo form_tag_for($form, '@collection_production') ?>
<div class="productName row justify-content-center float-none p-0 w-auto">
  <div class="tableau col-11 border-0">
        <span>Nouvelle production</span>
        <?php include_partial('production/form_actions', array('collection' => $collection, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>
</div>

    <?php include_partial('production/flashes') ?>

    <?php echo $form->renderHiddenFields(false); ?>
    <?php echo $form->renderGlobalErrors(false); ?>

    <div class="row justify-content-center">
      <?php include_partial('collection/formInfosGenerales', array('form' => $form)) ?>
      <?php include_partial('collection/formDetails', array('form' => $form)) ?>
      <?php include_partial('collection/formLivraisons', array('form' => $form)) ?>
      <?php include_partial('collection/formTirelles', array('form' => $form)) ?>
      <?php include_partial('collection/formTestMatiere', array('form' => $form)) ?>
    </div>
</form>
