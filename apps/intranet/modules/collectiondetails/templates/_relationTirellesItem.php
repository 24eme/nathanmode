<tr class="relation_item_form">
    <td>
        <?php echo $form['date_expedition']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['date_expedition']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['colori']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['colori']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['metrage']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['metrage']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['bain']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['bain']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['date_validation']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['date_validation']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['date_refusation']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['date_refusation']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['date_retraitement']->render(array('class' => 'input vSmall')); ?>
        <?php echo $form['date_retraitement']->renderError(); ?>
    </td>
    <td>
        <a class="lien_supprimer_ligne" href="#">X</a>
    </td>
</tr>