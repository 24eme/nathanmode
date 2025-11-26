<tr class="relation_item_form">
    <td style="text-align:left;">
        <?php echo $form['date']->render() ?>
        <?php echo $form['date']->renderError() ?>
    </td>
    <td class='read-only-livraison'>
        <?php echo $form['piece_categorie']->render(array('class' => 'chosen piece_categorie')); ?>
        <?php echo $form['piece_categorie_value']->render(array('class' => 'piece_categorie')); ?>
        <?php echo $form['piece_categorie']->renderError(); ?>
    </td>
    <td class='read-only-livraison'>
        <?php echo $form['qualite']->render(array('class' => 'form-control-sm reference')); ?>
        <?php echo $form['qualite']->renderError(); ?>
    </td>
    <td class='read-only-livraison'>
        <?php echo $form['colori']->render(array('class' => 'colori')) ?>
        <?php echo $form['colori']->renderError() ?>
    </td>
    <td>
        <?php echo $form['observation']->render(array('style' => 'height:30px;margin-bottom:5px; margin-top: 5px;', 'class' => 'txtArea')) ?>
        <?php echo $form['observation']->renderError() ?>
    </td>
    <td class="p-2">
      <a class="lien_supprimer_ligne fs-6 text-muted" href="#"><i class="bi bi-trash3"></i></a>
    </td>
</tr>
