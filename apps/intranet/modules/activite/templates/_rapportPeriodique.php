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
<?php $pcs = $activites->getPcs($devise, $clientId, $fournisseurId); ?>
<?php $pcs1 = $activites1->getPcs($devise, $clientId, $fournisseurId); ?>
<?php $pcs2 = $activites2->getPcs($devise, $clientId, $fournisseurId); ?>

<div class="row">
    <div class="col-sm-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white"><h5><?php if(isset($annuel)): ?><?php echo $from->format('Y') ?><?php else: ?>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php endif; ?><?php if(isset($detailsLink) && $detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($montant, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($com, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($mvts, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($pcs, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-secondary">
            <div class="card-header bg-secondary text-white"><h5><?php if(isset($annuel)): ?>Année<?php else: ?>Période<?php endif; ?> <?php echo $from->format('Y')-1 ?><?php if(isset($detailsLink) && $detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-1).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-1).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($montant > 0 && $montant1 > 0):
                                $diff = $montant / $montant1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($montant1, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php

                            if ($com > 0 && $com1 > 0):
                                $diff = $com / $com1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($com1, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($mvts > 0 && $mvts1 > 0):
                                $diff = $mvts / $mvts1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($mvts1, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcs > 0 && $pcs1 > 0):
                                $diff = $pcs / $pcs1;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($pcs1, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-secondary">
            <div class="card-header bg-secondary text-white"><h5><?php if(isset($annuel)): ?>Année<?php else: ?>Période<?php endif; ?> <?php echo $from->format('Y')-2 ?><?php if(isset($detailsLink) && $detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => ($from->format('Y')-2).'-'.$from->format('m').'-'.$from->format('d'), 'to' => ($to->format('Y')-2).'-'.$to->format('m').'-'.$to->format('d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($montant > 0 && $montant2 > 0):
                                $diff = $montant / $montant2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($montant2, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($com > 0 && $com2 > 0):
                                $diff = $com / $com2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($com2, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($mvts > 0 && $mvts2 > 0):
                                $diff = $mvts / $mvts2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($mvts2, 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($pcs > 0 && $pcs2 > 0):
                                $diff = $pcs / $pcs2;
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($pcs2, 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
