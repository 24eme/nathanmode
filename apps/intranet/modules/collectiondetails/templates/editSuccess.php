<?php use_helper('I18N', 'Date') ?>

<div class="factor <?php echo strtolower($collection_detail->getSituation()) ?>">
<?php echo form_tag_for($form, '@collection') ?>
  <div class="productName">
    <span><?php echo $collection_detail->Fournisseur ?> - <?php echo $collection_detail->Client ?> - <?php echo $collection_detail->Saison ?></span>
    <?php include_partial('collection/form_actions', array('collection' => $collection_detail, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
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
</div>




