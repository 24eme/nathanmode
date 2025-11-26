<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="subTab">
            <tr>
                  <th style="width: 8%;"><label>Date retard</label></th>
                  <th style="width: 8%;"><label>Catégorie</label></th>
                  <th style="width: 10%;"><label>Référence</label></th>
                  <th style="width: 10%;"><label>Colori</label></th>
                  <th><label>Observation</label></th>
                  <th style="width: 0;"><label>&nbsp;</label></th>
              </tr>
              <tbody id="form_retards_container">
                  <?php foreach($form['retards'] as $item_form): ?>
                          <?php echo include_partial('production/relationRetardsItem', array('form' => $item_form)); ?>
                  <?php endforeach; ?>
              </tbody>
              <tr style="visibility: hidden;">
                  <td colspan="11" class="px-0">
                      <a id="ajouter_retard" class="btPlus right lien_ajouter_ligne" data-template="#template_retards" data-container="#form_retards_container" href="#">+</a>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
  </table>

<script id="template_retards" type="text/x-jquery-tmpl">
    <?php echo include_partial('production/relationRetardsItem', array('form' => $form->getTemplate('retards'))); ?>
</script>
