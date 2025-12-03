<?php echo link_to(__('Commandes Soldées', array(), 'messages'), 'productiondetails/CommandesSoldees', array()) ?>
<?php echo link_to(__('CSV', array(), 'messages'), 'productiondetails/ListCsv', array()) ?>
<?php echo link_to(__('Nouveau', array()), 'collection_production_new', array()) ?>


<script>
document.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll('.sf_admin_list_td_commande_soldee img').forEach(function(item) {
  console.log(item)
    item.closest('tr').style.opacity = '0.5';
  });
})
</script>
