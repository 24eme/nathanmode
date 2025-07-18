<div class="relation_item_form">
    <table width="50%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1rem; border-bottom: 1px solid #E1E1E1;">
        <tr>
            <td width="150"><?php echo $form['colori']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['colori']->render() ?>
                <?php echo $form['colori']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['metrage']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['metrage']->render() ?>
                <?php echo $form['metrage']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['piece_categorie']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['piece_categorie']->render(array('class' => 'chosen')) ?>
                <?php echo $form['piece_categorie']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['piece']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['piece']->render() ?>
                <?php echo $form['piece']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['prix']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['prix']->render() ?>
                <?php echo $form['prix']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['devise_id']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['devise_id']->render(array('class' => 'chosen')) ?>
                <?php echo $form['devise_id']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['escompte']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['escompte']->render() ?>
                <?php echo $form['escompte']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['escompte_devise_id']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['escompte_devise_id']->render(array('class' => 'chosen')) ?>
                <?php echo $form['escompte_devise_id']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['adresse_livraison']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['adresse_livraison']->render() ?>
                <?php echo $form['adresse_livraison']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['date']->renderLabel() ?>&nbsp;:</td>
            <td style="text-align:left;">
                <?php echo $form['date']->render() ?>
                <?php echo $form['date']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['num_facture']->renderLabel() ?>&nbsp;:</td>
            <td>
                <?php echo $form['num_facture']->render() ?>
                <?php echo $form['num_facture']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;">
                <?php echo $form['fichier']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
            </td>
            <td class="uploadFile">
                <?php echo $form['fichier']->render(array('class' => 'input')) ?>
                <?php echo $form['fichier']->renderError() ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:top;">
                <?php echo $form['packing_list']->renderLabel() ?><img src="/css/img/pdf.gif" width="18" height="19" alt="" align="absbottom" />&nbsp;:
            </td>
            <td class="uploadFile">
                <?php echo $form['packing_list']->render(array('class' => 'input')) ?>
                <?php echo $form['packing_list']->renderError() ?>
            </td>
        </tr>
        <tr>
          <td colspan="2" align="right" style="padding-right: 8%;">
            <a class="lien_supprimer_ligne" href="#">supprimer</a>
          </td>
        </tr>
    </table>
</div>
