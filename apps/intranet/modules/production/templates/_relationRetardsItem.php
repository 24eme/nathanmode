<tr class="relation_item_form">
    <td style="text-align:left;">
        <?php echo $form['date']->render() ?>
        <?php echo $form['date']->renderError() ?>
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
        <?php echo $form['observation']->render(array('style' => 'height:40px;margin-bottom:10px;', 'class' => 'txtArea')) ?>
        <?php echo $form['observation']->renderError() ?>
    </td>
    <td class="px-1">
        <a class="lien_supprimer_ligne" href="#"><i class="bi bi-trash3"></i></a>
    </td>
</tr>
