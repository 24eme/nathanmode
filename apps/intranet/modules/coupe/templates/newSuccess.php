<form method="post" action="" enctype="multipart/form-data">
    <div class="productName">
        <span>Nouvelles coupes</span>
        <div class="actions">
            <input type="submit" value="Valider"> <?php echo link_to('Retour à la liste', 'collection'); ?>
        </div>
    </div>
    
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <datalist id="liste_qualite">
        <?php foreach(QualiteTable::getInstance()->getTabQualites() as $libelle): ?>
        <option value="<?php echo $libelle ?>">
        <?php endforeach; ?>
    </datalist>

    <table id="table_coupe_multiple">
        <thead>
            <tr>
                <th>Saison</th>
                <th>Commercial</th>
                <th>Date Demande</th>
                <th>Commande</th>
                <th>Fournisseur</th>
                <th>Client</th>
                <th>Qualité</th>
                <th>Colori</th>
                <th>Quantité Type</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>N° Facture</th>
                <th style="text-align: center;">PDF Facture</th>
                <th>Situation</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($form['coupes'] as $key => $formItem): ?>
            <tr class="coupe_multiple_ligne" data-line-index="<?php echo $key ;?>" style="opacity: 0.5;">
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['saison_id']->render(array('style' => 'width: 120px;')); ?><?php echo $formItem['saison_id']->renderError(); ?></td>
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['commercial_id']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['commercial_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['date_demande']->render(); ?><?php echo $formItem['date_demande']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['commande']->render(array('style' => 'width: 80px;')); ?><?php echo $formItem['commande']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fournisseur_id']->render(array('style' => 'width: 120px;')); ?><?php echo $formItem['fournisseur_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['client_id']->render(array('style' => 'width: 120px;')); ?><?php echo $formItem['client_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['qualite']->render(array('list' => 'liste_qualite', 'style' => 'width: 120px;', 'autocomplete' => 'off')); ?><?php echo $formItem['qualite']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['colori']->render(array('style' => 'width: 120px;')); ?><?php echo $formItem['colori']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['quantite_type']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['quantite_type']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['quantite']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['quantite']->renderError(); ?></td>
                <td style="padding: 4px; padding-right: 0;"><?php echo $formItem['prix']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['prix']->renderError(); ?></td>
                <td style="padding: 4px; padding-right: 0;"><?php echo $formItem['num_facture']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['num_facture']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fichier']->render(array('style' => 'width: 140px;')); ?><?php echo $formItem['fichier']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['situation']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['situation']->renderError(); ?></td>
                <td style="padding-left: 10px;"><a class="lien_supprimer_ligne" href="#">X</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

<div class="actions">
    <a id="lien_ajouter_ligne" class="btPlus right" href="#">+</a>
</div>

