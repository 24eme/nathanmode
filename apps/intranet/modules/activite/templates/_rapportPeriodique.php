<div class="p-3 text-dark">
    <h4><?php echo $titre ?></h4>
</div>
<?php $montant = $activites->getMontant($devise, $clientId, $fournisseurId); ?>
<?php $montant1 = $activites1->getMontant($devise, $clientId, $fournisseurId); ?>
<?php $montant2 = $activites2->getMontant($devise, $clientId, $fournisseurId); ?>
<?php $mvts = $activites->getMts($devise, $clientId, $fournisseurId); ?>
<?php $mvts1 = $activites1->getMts($devise, $clientId, $fournisseurId); ?>
<?php $mvts2 = $activites2->getMts($devise, $clientId, $fournisseurId); ?>
<?php $com = $activites->getCom($devise, $clientId, $fournisseurId); ?>
<?php $com1 = $activites1->getCom($devise, $clientId, $fournisseurId); ?>
<?php $com2 = $activites2->getCom($devise, $clientId, $fournisseurId); ?>
<?php $pcs = $activites->getPcsAccessoires($devise, $clientId, $fournisseurId); ?>
<?php $pcs1 = $activites1->getPcsAccessoires($devise, $clientId, $fournisseurId); ?>
<?php $pcs2 = $activites2->getPcsAccessoires($devise, $clientId, $fournisseurId); ?>
<?php $pcsNA = $activites->getPcsNonAccessoires($devise, $clientId, $fournisseurId); ?>
<?php $pcs1NA = $activites1->getPcsNonAccessoires($devise, $clientId, $fournisseurId); ?>
<?php $pcs2NA = $activites2->getPcsNonAccessoires($devise, $clientId, $fournisseurId); ?>

<div class="row">
    <div class="col-sm-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white">
              <h5>
                <?php if(isset($annuel)): ?><?php echo $from->format('Y') ?><?php else: ?>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php endif; ?>
                  <?php if(isset($detailsLink) && $detailsLink): ?>
                    <a style="margin-left: 10px;" href="#" class="float-end" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="bi bi-eye-fill fs-5 text-white" title="details" aria-hidden="true"></span></a>
                  <?php endif; ?>
                  <a href="<?php echo url_for('activiteCsv', array('from' => $activites->from, 'to' => $activites->to, 'devise' => $devise, 'client' => $clientId, 'fournisseur' => $fournisseurId, 'commercial' => $activites->commercial, 'produit' => $activites->produit, 'saison' => $activites->saison)) ?>" class="float-end"><span class="bi bi-arrow-down-square-fill fs-5 text-white" title="Télécharger le détail" aria-hidden="true"></span></a>
                  <?php if(!isset($annuel)): ?>
                  <a style="margin-right: 10px;" href="<?php echo url_for('activiteGraph') ?>" class="float-end"><span class="bi bi-bar-chart-line-fill fs-5 text-white" title="Graph" aria-hidden="true"></span></a>
                  <?php endif; ?>
              </h5></div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-9 text-end text-dark"><?php echo number_format($montant, 2, ',', ' ') ?></div>
                </div>
                <?php if ($comFiltered && $comFiltered->is_super_commercial): ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-9 text-end text-dark"><?php echo number_format($com, 2, ',', ' ') ?></div>
                </div>
                <?php endif; ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-9 text-end text-dark"><?php echo number_format($mvts, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">ACCES. <small class="text-muted">pcs</small></div>
                    <div class="col-9 text-end text-dark"><?php echo number_format($pcs, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF CN <small class="text-muted">pcs</small></div>
                    <div class="col-9 text-end text-dark"><?php echo number_format($pcsNA, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-secondary">
            <div class="card-header bg-secondary text-white">
              <h5>
                <?php if(isset($annuel)): ?><?php echo $from->format('Y')-1 ?><?php else: ?><strong>N-1</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites1->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites1->to)->format('d/m/Y'); ?><?php endif; ?>
                  <?php if(isset($detailsLink) && $detailsLink): ?>
                    <a href="#" style="margin-left: 10px;" class="float-end" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-1).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-1).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="bi bi-eye-fill fs-5 text-white" title="details" aria-hidden="true"></span></a>
                  <?php endif; ?>
                  <a href="<?php echo url_for('activiteCsv', array('from' => $activites1->from, 'to' => $activites1->to, 'devise' => $devise, 'client' => $clientId, 'fournisseur' => $fournisseurId, 'commercial' => $activites1->commercial, 'produit' => $activites1->produit, 'saison' => $activites1->saison)) ?>" class="float-end"><span class="bi bi-arrow-down-square-fill fs-5 text-white" title="Télécharger le détail" aria-hidden="true"></span></a>
                </h5>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($montant > 0 && $montant1 > 0):
                                $diff = $montant / $montant1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($montant1, 2, ',', ' ') ?></div>
                </div>
                <?php if ($comFiltered && $comFiltered->is_super_commercial): ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-3">
                        <?php

                            if ($com > 0 && $com1 > 0):
                                $diff = $com / $com1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($com1, 2, ',', ' ') ?></div>
                </div>
              <?php endif; ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($mvts > 0 && $mvts1 > 0):
                                $diff = $mvts / $mvts1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($mvts1, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">ACCES. <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcs > 0 && $pcs1 > 0):
                                $diff = $pcs / $pcs1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($pcs1, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF CN <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcsNA > 0 && $pcs1NA > 0):
                                $diff = $pcsNA / $pcs1NA;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($pcs1NA, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-secondary">
            <div class="card-header bg-secondary text-white">
              <h5>
                <?php if(isset($annuel)): ?><?php echo $from->format('Y')-2 ?><?php else: ?><strong>N-2</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites2->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites2->to)->format('d/m/Y'); ?><?php endif; ?>
                <?php if(isset($detailsLink) && $detailsLink): ?><a style="margin-left: 10px;" href="#" class="float-end" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-2).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-2).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="bi bi-eye-fill fs-5 text-white" title="details" aria-hidden="true"></span></a><?php endif; ?>
                <a href="<?php echo url_for('activiteCsv', array('from' => $activites2->from, 'to' => $activites2->to, 'devise' => $devise, 'client' => $clientId, 'fournisseur' => $fournisseurId, 'commercial' => $activites2->commercial, 'produit' => $activites2->produit, 'saison' => $activites2->saison)) ?>" class="float-end"><span class="bi bi-arrow-down-square-fill fs-5 text-white" title="Télécharger le détail" aria-hidden="true"></span></a>
              </h5>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($montant > 0 && $montant2 > 0):
                                $diff = $montant / $montant2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($montant2, 2, ',', ' ') ?></div>
                </div>
                <?php if ($comFiltered && $comFiltered->is_super_commercial): ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<i class="bi bi-currency-dollar fs-6"></i>' : '<i class="bi bi-currency-euro fs-6"></i>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($com > 0 && $com2 > 0):
                                $diff = $com / $com2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($com2, 2, ',', ' ') ?></div>
                </div>
                <?php endif; ?>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($mvts > 0 && $mvts2 > 0):
                                $diff = $mvts / $mvts2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($mvts2, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">ACCES. <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcs > 0 && $pcs2 > 0):
                                $diff = $pcs / $pcs2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($pcs2, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF CN <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcsNA > 0 && $pcs2NA > 0):
                                $diff = $pcsNA / $pcs2NA;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-end text-dark"><?php echo number_format($pcs2NA, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<p class="text-center mt-3 mb-0 details">
  <a class="btn btn-light btn-sm text-uppercase" data-toggle="collapse" href="#details<?php if(isset($annuel)): ?>Annee<?php else: ?>Periode<?php endif; ?>" role="button" aria-expanded="false">
    Voir le détail par produit fini <span class="bi bi-chevron-down"></span>
  </a>
</p>

<div class="collapse pt-3" id="details<?php if(isset($annuel)): ?>Annee<?php else: ?>Periode<?php endif; ?>">
  <div class="row">
      <div class="col-sm-4">
        <?php $itemsBloc1 = $activites->getDetailledPcs($devise, $clientId, $fournisseurId); ?>
        <div class="card border-info">
          <div class="card-header bg-info text-white"><h5>ACCES. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y') ?><?php else: ?>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
            <?php
              foreach(PieceCategories::getListe(true) as $id => $libelle) :
                if (!in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
            ?>
            <div class="list-group-item">
                <div class="col-8 text-dark small"><?php echo $libelle ?></div>
                <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0, 2, ',', ' ') ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="card border-info mt-2">
          <div class="card-header bg-info text-white"><h5>PF CN. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y') ?><?php else: ?>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
              <?php
                foreach(PieceCategories::getListe(true) as $id => $libelle) :
                  if (in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
              ?>
              <div class="list-group-item">
                  <div class="col-8 text-dark small"><?php if($libelle): ?><?php echo $libelle ?><?php else: ?><span class="text-muted">Sans catégorie</span><?php endif; ?></div>
                  <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0, 2, ',', ' ') ?></div>
              </div>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <?php $itemsBloc2 = $activites1->getDetailledPcs($devise, $clientId, $fournisseurId);  ?>
        <div class="card border-secondary">
          <div class="card-header bg-secondary text-white"><h5>ACCES. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y')-1 ?><?php else: ?><strong>N-1</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites1->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites1->to)->format('d/m/Y'); ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
              <?php
                foreach(PieceCategories::getListe(true) as $id => $libelle) :
                  if (!in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
              ?>
              <div class="list-group-item">
                  <div class="col-6 text-dark small"><?php if($libelle): ?><?php echo $libelle ?><?php else: ?><span class="text-muted">Sans catégorie</span><?php endif; ?></div>
                  <div class="col-2 small">
                    <?php
                        $val1 = (isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0;
                        $val2 = (isset($itemsBloc2[$id]) && $itemsBloc2[$id])? $itemsBloc2[$id] : 0;
                        if ($val1 > 0 && $val2 > 0):
                            $diff = $val1 / $val2;
                            if ($diff > 1):
                    ?>
                        <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                    <?php else: ?>
                        <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                    <?php endif; endif; ?>
                  </div>
                  <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc2[$id]) && $itemsBloc2[$id])? $itemsBloc2[$id] : 0, 2, ',', ' ') ?></div>
              </div>
              <?php endforeach; ?>
          </div>
        </div>
        <div class="card border-secondary mt-2">
          <div class="card-header bg-secondary text-white"><h5>PF CN. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y')-1 ?><?php else: ?><strong>N-1</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites1->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites1->to)->format('d/m/Y'); ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
              <?php
              foreach(PieceCategories::getListe(true) as $id => $libelle) :
                if (in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
              ?>
              <div class="list-group-item">
                  <div class="col-6 text-dark small"><?php if($libelle): ?><?php echo $libelle ?><?php else: ?><span class="text-muted">Sans catégorie</span><?php endif; ?></div>
                  <div class="col-2 small">
                    <?php
                        $val1 = (isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0;
                        $val2 = (isset($itemsBloc2[$id]) && $itemsBloc2[$id])? $itemsBloc2[$id] : 0;
                        if ($val1 > 0 && $val2 > 0):
                            $diff = $val1 / $val2;
                            if ($diff > 1):
                    ?>
                        <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                    <?php else: ?>
                        <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                    <?php endif; endif; ?>
                  </div>
                  <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc2[$id]) && $itemsBloc2[$id])? $itemsBloc2[$id] : 0, 2, ',', ' ') ?></div>
              </div>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <?php $itemsBloc3 = $activites2->getDetailledPcs($devise, $clientId, $fournisseurId); ?>
        <div class="card border-secondary">
          <div class="card-header bg-secondary text-white"><h5>ACCES. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y')-2 ?><?php else: ?><strong>N-2</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites2->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites2->to)->format('d/m/Y'); ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
              <?php
                foreach(PieceCategories::getListe(true) as $id => $libelle) :
                  if (!in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
              ?>
              <div class="list-group-item">
                  <div class="col-6 text-dark small"><?php echo $libelle ?></div>
                  <div class="col-2 small">
                    <?php
                        $val1 = (isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0;
                        $val3 = (isset($itemsBloc3[$id]) && $itemsBloc3[$id])? $itemsBloc3[$id] : 0;
                        if ($val1 > 0 && $val3 > 0):
                            $diff = $val1 / $val3;
                            if ($diff > 1):
                    ?>
                        <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                    <?php else: ?>
                        <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                    <?php endif; endif; ?>
                  </div>
                  <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc3[$id]) && $itemsBloc3[$id])? $itemsBloc3[$id] : 0, 2, ',', ' ') ?></div>
              </div>
              <?php endforeach; ?>
          </div>
        </div>
        <div class="card border-secondary mt-2">
          <div class="card-header bg-secondary text-white"><h5>PF CN. <small><?php if(isset($annuel)): ?><?php echo $from->format('Y')-2 ?><?php else: ?><strong>N-2</strong> du <?php echo DateTime::createFromFormat("Y-m-d", $activites2->from)->format('d/m/Y'); ?> au <?php echo DateTime::createFromFormat("Y-m-d", $activites2->to)->format('d/m/Y'); ?><?php endif; ?></small></h5></div>
          <div class="list-group list-group-flush">
              <?php
                foreach(PieceCategories::getListe(true) as $id => $libelle) :
                  if (in_array($id,Activite::$ACCESSOIRES_CATEGORIES)) continue;
              ?>
              <div class="list-group-item">
                  <div class="col-6 text-dark small"><?php if($libelle): ?><?php echo $libelle ?><?php else: ?><span class="text-muted">Sans catégorie</span><?php endif; ?></div>
                  <div class="col-2 small">
                    <?php
                        $val1 = (isset($itemsBloc1[$id]) && $itemsBloc1[$id])? $itemsBloc1[$id] : 0;
                        $val3 = (isset($itemsBloc3[$id]) && $itemsBloc3[$id])? $itemsBloc3[$id] : 0;
                        if ($val1 > 0 && $val3 > 0):
                            $diff = $val1 / $val3;
                            if ($diff > 1):
                    ?>
                        <small class="text-success font-italic fw-bold">+&nbsp;<?php echo number_format(($diff - 1) * 100, 0, ',', '&nbsp;') ?>%</small>
                    <?php else: ?>
                        <small class="text-danger font-italic fw-bold">-&nbsp;<?php echo number_format(($diff - 1) * -100, 0, ',', '&nbsp;') ?>%</small>
                    <?php endif; endif; ?>
                  </div>
                  <div class="col-4 text-end text-dark"><?php echo number_format((isset($itemsBloc3[$id]) && $itemsBloc3[$id])? $itemsBloc3[$id] : 0, 2, ',', ' ') ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
  </div>
</div>
