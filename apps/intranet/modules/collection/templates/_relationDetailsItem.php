<tr class="relation_item_form">
    <td>
        <img height="50" src="<?php echo CollectionDetailTable::getInstance()->getUploadPath(false).$form['image']->getValue() ?>" />
    </td>
    <td class="uploadFile">
        <?php echo $form['image']->render(array('class' => 'input')) ?>
        <?php echo $form['image']->renderError() ?>
    </td>
    <td>
        <?php echo $form['colori']->render(); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece']->render(); ?>
        <?php echo $form['piece']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['prix_achat']->render(array('class' => 'input-float')); ?>
        <?php echo $form['prix_achat']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['prix']->render(array('class' => 'input-float')); ?>
        <?php echo $form['prix']->renderError(); ?>
    </td>
    <td><span>10 $</span> / <span>9 €</span></td>
    <td><span>1.43</span> / <span>27.21 %</span></td>
    <td><span>1.43</span> / <span>27.21 %</span></td>
    <td class="px-1">
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
</tr>
