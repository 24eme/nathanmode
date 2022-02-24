<?php use_helper('Date'); ?>
<br /><br />
<table border="1" cellpadding="5">
  <thead>
    <tr>
      <th>Customer</th>
      <th>Order number</th>
      <th>Delivery date</th>
      <th>Material</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($items as $item): ?>
      <tr>
        <td><?php echo $item->getClient() ?></td>
        <td align="center"><?php echo $item->num_commande ?></td>
        <td align="center"><?php echo format_date($item->date_livraison, 'dd/MM/yyyy') ?></td>
        <td><?php echo strtoupper($item->qualite) ?></td>
        <td>
          <ul>
          <?php foreach ($item->getCollectionDetails() as $detail): ?>
          	<li><?php echo $detail->getColori() ?> - <?php echo ($detail->getMetrage())? $detail->getMetrage().' MTS' : $detail->getPiece().' PF'; ?> - <?php echo $detail->getPrix() ?>&euro;</li>
          <?php endforeach;?>
          </ul>
        </td>
      </tr>
  <?php endforeach; ?>
  </tbody>
</table>
