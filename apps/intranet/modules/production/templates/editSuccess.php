<?php use_helper('I18N', 'Date') ?>

<?php echo form_tag_for($form, '@collection_production') ?>
<div id="sticky-banner" class="productName row justify-content-center float-none p-0 w-auto">
  <div class="tableau col-11 border-0" style="display:flex;">
        <span><?php echo $collection->Fournisseur ?> - <?php echo $collection->Client ?> - <?php echo $collection->Saison ?></span>
        <?php include_partial('production/form_actions', array('collection' => $collection, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>
</div>

    <?php include_partial('production/flashes') ?>

    <?php echo $form->renderHiddenFields(false); ?>
    <?php echo $form->renderGlobalErrors(false); ?>

    <div class="row justify-content-center">
        <?php include_partial('production/formInfosGenerales', array('form' => $form)) ?>
        <?php include_partial('production/formDetails', array('form' => $form, 'collection' => $collection)) ?>
        <?php include_partial('production/formLivraisons', array('form' => $form)) ?>
        <?php include_partial('production/formTirelles', array('form' => $form)) ?>
        <?php include_partial('production/formTestMatiere', array('form' => $form)) ?>

        <div class="tableau col-11">
            <div class="titre"><span>Factures</span></div>
            <div class="px-2">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Montant</th>
                        <th>Commission</th>
                        <th>Date de paiement</th>
                        <th>Statut</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($collection->getCollectionLivraisons() as $livraison): ?>
                <?php if($livraison->getFacture()->isNew()): continue; endif; ?>
                <tr>
                <td><?php echo $livraison->getFacture()->getNumero(); ?></td>
                <td><?php echo $livraison->getFacture()->getMontant(); ?></td>
                <td><?php echo $livraison->getFacture()->getTotalFournisseur(); ?></td>
                <td><?php echo $livraison->getFacture()->getDateDebit(); ?></td>
                <td><a href="<?php echo url_for('facture_edit', $livraison->getFacture()) ?>"><?php echo $livraison->getFacture()->getStatut(); ?></a></td>
                <td><a href="">PDF</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

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

  window.addEventListener('scroll', (event) => {
    const stickyBanner = document.getElementById('sticky-banner');
    if (window.scrollY >= 145) {
      stickyBanner.setAttribute("style", "border:2px solid #164066; position:sticky; border-radius:8px; top:20px; z-index:1000; background-color:#ffffff; height:60px; padding:15px 0 !important; width:98% !important; margin: 0 auto !important;")
    }else if (window.scrollY < 145) {
      stickyBanner.removeAttribute('style');
    }
  });
</script>
