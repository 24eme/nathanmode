<tr class="relation_item_form">

    <td class="uploadFile">
        <?php echo $form['image']->render(array('class' => 'input production-images')) ?>
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
        <?php echo $form['prix']->render(array('class' => 'input-float')); ?>
        <?php echo $form['prix']->renderError(); ?>
    </td>
    <td>
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
</tr>
