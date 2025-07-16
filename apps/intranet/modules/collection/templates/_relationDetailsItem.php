<tr class="relation_item_form">

    <td class="uploadFile">
        <?php echo $form['image']->render(array('class' => 'input')) ?>
        <?php echo $form['image']->renderError() ?>
    </td>
    <td>
        <?php echo $form['colori']->render(); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece_categorie']->render(array('class' => 'chosen')); ?>
        <?php echo $form['piece_categorie']->renderError(); ?>
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
        <?php echo $form['devise_id']->render(array('class' => 'chosen')); ?>
        <?php echo $form['devise_id']->renderError(); ?>
    </td>
    <td>
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
</tr>
