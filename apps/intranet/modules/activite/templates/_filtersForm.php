<form method="get" action="<?php echo url_for($sf_request->getParameter('module').ucfirst($sf_request->getParameter('action')), $parameters->getRawValue()) ?>">
    <?php foreach ($parameters as $key => $value): ?>
    <?php if (!in_array($key, array('from', 'to', 'saison')) && $value): ?>
    <input type="hidden" name="<?php echo $key?>" value="<?php echo $value ?>" />
    <?php endif; ?>
    <?php endforeach; ?>
    <div class="activity_date activity_content">
        <span class="activity_title"></span>
        <div class="activity_date_input">
            Saison&nbsp;
            <select id="activite_filters_saison_id" name="saison">
                <option value=""<?php if (!$saison): ?> selected="selected"<?php endif; ?>></option>
                <?php foreach (SaisonTable::getInstance()->findAll() as $s): ?>
                <option value="<?php echo $s->getId() ?>"<?php if ($s->getId() == $saison): ?> selected="selected"<?php endif; ?>><?php echo $s ?></option>
                <?php endforeach; ?>
            </select>
            Commercial&nbsp;
            <?php if (!$comFiltered): ?>
            <select id="activite_filters_commercial_id" name="commercial">
                <option value=""<?php if (!$commercialId): ?> selected="selected"<?php endif; ?>></option>
                <?php foreach (CommercialTable::getInstance()->findAll() as $c): ?>
                <option value="<?php echo $c->getId() ?>"<?php if ($c->getId() == $commercialId): ?> selected="selected"<?php endif; ?>><?php echo $c ?></option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
            <span style="font-weight: normal"><?php echo $comFiltered ?></span>
            <?php endif; ?>
            Produit&nbsp;
            <select id="activite_filters_produit" name="produit">
                <option value=""<?php if (!$produit): ?> selected="selected"<?php endif; ?>>Tout</option>
                <option value="mts"<?php if ($produit == 'mts'): ?> selected="selected"<?php endif; ?>>MTS</option>
                <option value="pcs"<?php if ($produit == 'pcs'): ?> selected="selected"<?php endif; ?>>PCS</option>
            </select>
            &nbsp;Période du&nbsp;
            <input type="text" class="dp" name="from" value="<?php echo $from->format('d/m/Y') ?>" />
            &nbsp;au&nbsp;
            <input type="text" class="dp" name="to" value="<?php echo $to->format('d/m/Y') ?>" />
            &nbsp;<input type="submit" value="OK" class="activity_date_bt" />
        </div>
    </div>
</form>
