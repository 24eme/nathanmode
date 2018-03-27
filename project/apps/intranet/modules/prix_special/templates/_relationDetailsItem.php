<tr class="relation_item_form">
    <td>
        <?php echo $form['prix']->render(array('class' => 'small')); ?>
        <?php echo $form['devise_id']->render(array('class' => 'small', 'style' => 'width:40px;')); ?>
        <br />
        <?php echo $form['prix']->renderError(); ?>
        <?php echo $form['devise_id']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['quantite']->render(array('class' => 'small')); ?><br />
        <?php echo $form['quantite']->renderError(); ?>
    </td>
    <td><a class="lien_supprimer_ligne" href="#">X</a></td>
</tr>