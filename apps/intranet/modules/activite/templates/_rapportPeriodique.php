<div class="p-3 text-dark">
    <h4><?php echo $titre ?></h4>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white"><h5><?php if(isset($annuel)): ?><?php echo $from->format('Y') ?><?php else: ?>du <?php echo $from->format('d/m/Y') ?> au <?php echo $to->format('d/m/Y') ?><?php endif; ?><?php if(isset($detailsLink) && $detailsLink): ?><a href="#" class="float-right" data-toggle="modal" data-target="#<?php echo $detailsLink ?>Modal" data-url="<?php echo url_for('modal'.ucfirst($detailsLink), array('parameters' => array_merge($parameters->getRawValue(), array('from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d'), 'ofrom' => $from->format('Y-m-d'), 'oto' => $to->format('Y-m-d'))))) ?>"><span class="oi oi-zoom-in text-white" title="details" aria-hidden="true"></span></a><?php endif; ?></h5></div>
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="col-3 text-dark">CA <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($activites->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($activites->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($activites->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-9 text-right text-dark"><?php echo number_format($activites->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
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
                            if ($activites->getMontant($devise, $clientId, $fournisseurId) > 0 && $activites1->getMontant($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getMontant($devise, $clientId, $fournisseurId) / $activites1->getMontant($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites1->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getCom($devise, $clientId, $fournisseurId) > 0 && $activites1->getCom($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getCom($devise, $clientId, $fournisseurId) / $activites1->getCom($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites1->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getMts($devise, $clientId, $fournisseurId) > 0 && $activites1->getMts($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getMts($devise, $clientId, $fournisseurId) / $activites1->getMts($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites1->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getPcs($devise, $clientId, $fournisseurId) > 0 && $activites1->getPcs($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getPcs($devise, $clientId, $fournisseurId) / $activites1->getPcs($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites1->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
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
                            if ($activites->getMontant($devise, $clientId, $fournisseurId) > 0 && $activites2->getMontant($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getMontant($devise, $clientId, $fournisseurId) / $activites2->getMontant($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites2->getMontant($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">COM <span class="text-warning"><?php echo ($devise == 2)? '<small class="oi oi-dollar" title="dollar" aria-hidden="true"></small>' : '<small class="oi oi-euro" title="euro" aria-hidden="true"></small>'; ?></span></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getCom($devise, $clientId, $fournisseurId) > 0 && $activites2->getCom($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getCom($devise, $clientId, $fournisseurId) / $activites2->getCom($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites2->getCom($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">MTS <small class="text-muted">mts</small></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getMts($devise, $clientId, $fournisseurId) > 0 && $activites2->getMts($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getMts($devise, $clientId, $fournisseurId) / $activites2->getMts($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites2->getMts($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
                <div class="list-group-item">
                    <div class="col-3 text-dark">PF <small class="text-muted">pcs</small></div>
                    <div class="col-3">
                        <?php
                            if ($activites->getPcs($devise, $clientId, $fournisseurId) > 0 && $activites2->getPcs($devise, $clientId, $fournisseurId) > 0):
                                $diff = $activites->getPcs($devise, $clientId, $fournisseurId) / $activites2->getPcs($devise, $clientId, $fournisseurId);
                                if ($diff > 1):
                        ?>
                            <small class="text-success font-italic font-weight-bold">+ <?php echo number_format(($diff - 1) * 100, 0, ',', ' ') ?>%</small>
                        <?php else: ?>
                            <small class="text-danger font-italic font-weight-bold">- <?php echo number_format(($diff - 1) * -100, 0, ',', ' ') ?>%</small>
                        <?php endif; endif; ?>
                    </div>
                    <div class="col-6 text-right text-dark"><?php echo number_format($activites2->getPcs($devise, $clientId, $fournisseurId), 2, ',', ' ') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
