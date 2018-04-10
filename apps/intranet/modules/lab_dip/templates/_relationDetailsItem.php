<tr class="relation_item_form">
    <td>
        <?php echo $form['date']->render(array('class' => 'small')); ?><br />
        <?php echo $form['date']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['statut']->render(array('class' => 'small')); ?><br />
        <?php echo $form['statut']->renderError(); ?>
    </td>
    <td>
        <?php echo $form['reference']->render(array('class' => 'small')); ?><br />
        <?php echo $form['reference']->renderError(); ?>
    </td>
    <td><a class="lien_supprimer_ligne" href="#">X</a></td>
</tr>