<form method="post" action="">
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
                <th>Métrage</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($form['coupes'] as $key => $formItem): ?>
            <tr class="coupe_multiple_ligne" data-line-index="<?php echo $key ;?>">
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['saison_id']->render(); ?><?php echo $formItem['saison_id']->renderError(); ?></td>
                <td style="padding: 4px; padding-left: 0;"><?php echo $formItem['commercial_id']->render(); ?><?php echo $formItem['commercial_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['date_demande']->render(); ?><?php echo $formItem['date_demande']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['commande']->render(array('style' => 'width: 100px;')); ?><?php echo $formItem['commande']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['fournisseur_id']->render(); ?><?php echo $formItem['fournisseur_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['client_id']->render(); ?><?php echo $formItem['client_id']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['qualite']->render(array('style' => 'width: 140px;')); ?><?php echo $formItem['qualite']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['colori']->render(array('style' => 'width: 140px;')); ?><?php echo $formItem['colori']->renderError(); ?></td>
                <td style="padding: 4px;"><?php echo $formItem['metrage']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['metrage']->renderError(); ?></td>
                <td style="padding: 4px; padding-right: 0;"><?php echo $formItem['prix']->render(array('style' => 'width: 60px;')); ?><?php echo $formItem['prix']->renderError(); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

