<form method="post" action="" enctype="multipart/form-data">
    <div class="productName">
        <span>Nouvelles coupes</span>
        <div class="actions">
            <input type="submit" value="Valider"> <?php echo link_to('Retour à la liste', 'coupe'); ?>
        </div>
    </div>
    
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <datalist id="liste_qualite">
        <?php foreach(CollectionTable::getInstance()->getQualites() as $libelle): ?>
        <option value="<?php echo $libelle['qualite'] ?>">
        <?php endforeach; ?>
    </datalist>

    <div id="alertBox" class="bg-danger" style="float:left;width:100%; margin-top: -10px; margin-bottom: 10px; display:none;"></div>

    <table id="table_coupe_multiple">
        <thead>
            <tr>
                <th>Saison</th>
                <th>Commercial</th>
                <th>Date Commande</th>
                <th>Fournisseur</th>
                <th>Client</th>
                <th>Qualité</th>
                <th>Colori</th>
                <th>Quantité Type</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Date livraison</th>
                <th style="text-align: center;">Confirmation</th>
                <th>N° Facture</th>
                <th style="text-align: center;">PDF Facture</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($form['coupes'] as $key => $formItem): ?>
            <tr class="coupe_multiple_ligne" data-line-index="<?php echo $key ;?>" style="opacity: 0.5;">
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['saison_id']->render(array('style' => 'width: 100px;', 'class' => 'select-invisible required')); ?><?php echo $formItem['saison_id']->renderError(); ?></td>
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['commercial_id']->render(array('style' => 'width: 100px;', 'class' => 'select-invisible required')); ?><?php echo $formItem['commercial_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['date_commande']->render(array('class' => 'required')); ?><?php echo $formItem['date_commande']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fournisseur_id']->render(array('style' => 'width: 100px;', 'class' => 'select-invisible required')); ?><?php echo $formItem['fournisseur_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['client_id']->render(array('style' => 'width: 100px;', 'class' => 'select-invisible required')); ?><?php echo $formItem['client_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['qualite']->render(array('list' => 'liste_qualite', 'style' => 'width: 120px;', 'autocomplete' => 'off', 'class'=> 'required')); ?><?php echo $formItem['qualite']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['colori']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['colori']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['quantite_type']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['quantite_type']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['quantite']->render(array('style' => 'width: 60px;', 'class' => 'required input-float')); ?><?php echo $formItem['quantite']->renderError(); ?></td>
                <td style="padding: 4px; padding-right: 0;"><?php echo $formItem['prix']->render(array('style' => 'width: 60px;', 'class' => 'input-float')); ?><?php echo $formItem['prix']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['livre_le']->render(); ?><?php echo $formItem['livre_le']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fichier_confirmation']->render(array('style' => 'width: 140px;')); ?><?php echo $formItem['fichier_confirmation']->renderError(); ?></td>
                <td style="padding: 4px; padding-right: 0;"><?php echo $formItem['num_facture']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['num_facture']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fichier']->render(array('style' => 'width: 140px;')); ?><?php echo $formItem['fichier']->renderError(); ?></td>
                <td style="padding-left: 10px;"><a tabindex="-1" class="lien_supprimer_ligne_tr" href="#">X</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

<div class="actions">
    <a id="lien_ajouter_ligne" class="btPlus right" href="#">+</a>
</div>

