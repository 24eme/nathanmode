<?php use_helper('I18N', 'Date') ?>
<?php include_partial('coupe/assets') ?>

  <?php echo form_tag_for($form, '@coupe') ?>
  <div class="productName">
    <span><?php echo __('Modification de la coupe %%tissu%% %%colori%% %%metrage%%', array('%%tissu%%' => $coupe->getTissu(), '%%colori%%' => $coupe->getColori(), '%%metrage%%' => $coupe->getMetrage()), 'messages') ?></span>
    <?php include_partial('coupe/form_actions', array('coupe' => $coupe, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <?php include_partial('coupe/flashes') ?>


  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <?php include_partial('coupe/form', array('coupe' => $coupe, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

  </form>

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
          <?php if($facture = $coupe->getFacture()): ?>
          <tr>
          <td><?php echo $facture->getNumero(); ?></td>
          <td style="text-align: right;"><?php echo number_format($facture->getTotalFournisseur(), 2, ',', ' '); ?></td>
          <td style="text-align: right;"><?php echo number_format($facture->getMontant(), 2, ',', ' '); ?></td>
          <td><?php echo $facture->getDateDebit(); ?></td>
          <td><a href="<?php echo url_for('facture_edit', $facture) ?>"><?php echo $facture->getStatut(); ?></a></td>
          <td><a href="/uploads/factures/<?php echo $facture->getFichier() ?>">PDF</a></td>
          </tr>
          <?php $ca += $facture->getMontant(); $com += $facture->getTotalFournisseur(); ?>
        <?php endif; ?>
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
              <?php if ($commande = $coupe->getCommande()): ?>
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
