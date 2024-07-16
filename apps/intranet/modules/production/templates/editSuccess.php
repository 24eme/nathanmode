<?php use_helper('I18N', 'Date') ?>

<?php echo form_tag_for($form, '@collection_production') ?>
    <div class="productName">
        <span><?php echo $collection->Fournisseur ?> - <?php echo $collection->Client ?> - <?php echo $collection->Saison ?></span>
        <?php include_partial('production/form_actions', array('collection' => $collection, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <?php include_partial('production/flashes') ?>

    <?php echo $form->renderHiddenFields(false); ?>
    <?php echo $form->renderGlobalErrors(false); ?>

    <div class="colLeft">
        <?php include_partial('collection/formInfosGenerales', array('form' => $form)) ?>
        <?php include_partial('collection/formTirelles', array('form' => $form)) ?>
        <?php include_partial('collection/formTestMatiere', array('form' => $form)) ?>
    </div>
    <?php include_partial('collection/formLivraisons', array('form' => $form)) ?>

</form>
<script type="text/javascript">
  var form = document.querySelector('form');
  var initialDatas = getDatasFromForm(form);
  var formSubmitting = false;
  form.addEventListener('submit', () => {
    formSubmitting = true;
  });
  window.addEventListener('beforeunload', (event) => {
    if (!formSubmitting) {
      var datas = getDatasFromForm(form);
      var diff = compareObj(initialDatas, datas);
      if (Object.keys(diff).length !== 0) {
        const message = 'Are you sure you want to leave ?';
        event.returnValue = message;
        return message;
      }
    }
  });
</script>
