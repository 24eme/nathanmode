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

        <?php $ca = 0; $com = 0; ?>
        <div class="tableau col-11">
            <div class="titre"><span>Factures</span></div>
            <div class="px-2">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
                <thead>
                    <tr>
                        <th style="text-align: center;">Numéro</th>
                        <th style="text-align: right;">Commission</th>
                        <th style="text-align: right;">Montant</th>
                        <th style="text-align: center;">Date de paiement</th>
                        <th style="text-align: center;">Statut</th>
                        <th style="text-align: center;">PDF</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($collection->getCollectionLivraisons() as $livraison): ?>
                <?php if($livraison->getFacture()->isNew()): continue; endif; ?>
                <tr>
                <td><?php echo $livraison->getFacture()->getNumero(); ?></td>
                <td style="text-align: right;"><?php echo number_format($livraison->getFacture()->getTotalFournisseur(), 2, ',', ' '); ?></td>
                <td style="text-align: right;"><?php echo number_format($livraison->getFacture()->getMontant(), 2, ',', ' '); ?></td>
                <td><?php echo $livraison->getFacture()->getDateDebit(); ?></td>
                <td><a href="<?php echo url_for('facture_edit', $livraison->getFacture()) ?>"><?php echo $livraison->getFacture()->getStatut(); ?></a></td>
                <td><a href="/uploads/factures/<?php echo $livraison->getFacture()->getFichier() ?>">PDF</a></td>
                </tr>
                <?php $ca += $livraison->getFacture()->getMontant(); $com += $livraison->getFacture()->getTotalFournisseur(); ?>
                <?php endforeach; ?>
                <tr>
                  <td style="text-align: right;"><strong>TOTAL</strong></td>
                  <td style="text-align: right;"><strong><?php echo number_format($com, 2, ',', ' ') ?></strong></td>
                  <td style="text-align: right;"><strong><?php echo number_format($ca, 2, ',', ' ') ?></strong></td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>

        <?php $ca = 0; $com = 0; $quantite = 0; ?>
        <div class="tableau col-11">
            <div class="titre"><span>Commercial activity</span></div>
            <div class="px-2">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
                <thead>
                    <tr>
                        <th style="text-align: center;">Type</th>
                        <th style="text-align: center;">Catégorie</th>
                        <th style="text-align: center;">Référence</th>
                        <th style="text-align: center;">Colori</th>
                        <th style="text-align: center;">Quantité</th>
                        <th style="text-align: center;">Devise</th>
                        <th style="text-align: right;">COM</th>
                        <th style="text-align: right;">CA</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($collection->getCollectionDetails() as $detail): ?>
                    <?php if ($commande = $detail->getCommande()): ?>
                      <?php if ($commande->isNew()) continue; ?>
                      <tr>
                        <td style="text-align: left;">Commande <?php echo $commande->getId() ?></td>
                        <td><?php echo $commande->getPieceCategorie() ?></td>
                        <td><?php echo $commande->getQualite() ?></td>
                        <td><?php echo $commande->getColori() ?></td>
                        <td><?php echo ($commande->getPiece())? $commande->getPiece() : $commande->getMetrage(); ?></td>
                        <td><?php echo $commande->getDeviseMontant()->getSymbole(); ?></td>
                        <td style="text-align: right;"><?php echo number_format($commande->getTotalFournisseur(), 2, ',', ' ') ?></td>
                        <td  style="text-align: right;"><?php echo number_format($commande->getMontant(), 2, ',', ' ') ?></td>
                      </tr>
                    <?php $ca += $commande->getMontant(); $com += $commande->getTotalFournisseur(); $quantite += ($commande->getPiece())? $commande->getPiece() : $commande->getMetrage(); endif; ?>
                  <?php endforeach; ?>
                  <?php foreach($collection->getCollectionLivraisons() as $livraison): ?>
                    <?php if ($facture = $livraison->getFacture()): ?>
                      <?php if ($facture->isNew()||$facture->getType() == 'Facture'||!in_array($facture->getStatut(), array('DEDUITE','EN_ATTENTE','PAYEE'))) continue; ?>
                      <tr>
                        <td style="text-align: left;">Bon <?php echo $facture->getId() ?></td>
                        <td><?php echo $facture->getPieceCategorie() ?></td>
                        <td><?php echo $facture->getQualite() ?></td>
                        <td></td>
                        <td><?php echo ($facture->getPiece())? $facture->getPiece() : $facture->getMetrage(); ?></td>
                        <td><?php echo $facture->getDeviseMontant()->getSymbole(); ?></td>
                        <td style="text-align: right;"><?php echo number_format(-1* $facture->getTotalFournisseur(), 2, ',', ' ') ?></td>
                        <td  style="text-align: right;"><?php echo number_format(-1* $facture->getMontantTotal(), 2, ',', ' ') ?></td>
                      </tr>
                    <?php $ca += -1* $facture->getMontantTotal(); $com += -1* $facture->getTotalFournisseur(); $quantite += ($facture->getPiece())? $facture->getPiece() : $facture->getMetrage(); endif; ?>
                  <?php endforeach; ?>
                  <?php if ($cc = $collection->getCreditCommande()): ?>
                      <tr>
                        <td style="text-align: left;">Bon::CreditCommande <?php echo $cc->getId() ?></td>
                        <td><?php echo $cc->getPieceCategorie() ?></td>
                        <td><?php echo $cc->getQualite() ?></td>
                        <td></td>
                        <td><?php echo ($cc->getPiece())? $cc->getPiece() : $cc->getMetrage(); ?></td>
                        <td><?php echo $cc->getDeviseMontant()->getSymbole(); ?></td>
                        <td style="text-align: right;"><?php echo number_format(-1* $cc->getTotalFournisseur(), 2, ',', ' ') ?></td>
                        <td style="text-align: right;"><?php echo number_format(-1 * $cc->getMontantTotal(), 2, ',', ' ') ?></td>
                      </tr>
                  <?php $ca += -1* $cc->getMontantTotal(); $com += -1* $cc->getTotalFournisseur(); $quantite += ($cc->getPiece())? $cc->getPiece() : $cc->getMetrage(); endif; ?>
                  <tr>
                    <td colspan="4" style="text-align: right;"><strong>TOTAL</strong></td>
                    <td><strong><?php echo $quantite ?></strong></td>
                    <td></td>
                    <td style="text-align: right;"><strong><?php echo number_format($com, 2, ',', ' ') ?></strong></td>
                    <td style="text-align: right;"><strong><?php echo number_format($ca, 2, ',', ' ') ?></strong></td>
                  </tr>
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
        stickyBanner.setAttribute("style", "border:2px solid var(--couleur-primaire); position:sticky; border-radius:8px; top:20px; z-index:1000; background-color:#ffffff; height:60px; padding:15px 0 !important; width:98% !important; margin: 0 auto !important;");
    }else if (window.scrollY < 145) {
      stickyBanner.removeAttribute('style');
    }
  });
</script>
