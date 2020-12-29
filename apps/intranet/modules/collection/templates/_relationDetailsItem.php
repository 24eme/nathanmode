<tr class="relation_item_form">
    <td>
        <?php echo $form['colori']->render(array('class' => 'small')); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['metrage']->render(array('class' => 'small')); ?>
        <?php echo $form['metrage']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece_categorie']->render(array('class' => 'small', 'style' => 'width: 60px !important;')); ?>
        <?php echo $form['piece_categorie']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['piece']->render(array('class' => 'small', 'style' => 'width: 40px !important;')); ?>
        <?php echo $form['piece']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['prix']->render(array('class' => 'small', 'style' => 'width:50px;')); ?>
        <?php echo $form['prix']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['devise_id']->render(array('class' => 'small', 'style' => 'width:30px !important;')); ?>
        <?php echo $form['devise_id']->renderError(); ?>
    </td>
    <td>
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
</tr>
