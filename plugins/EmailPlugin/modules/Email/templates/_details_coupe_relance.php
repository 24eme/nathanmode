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
        <td align="center"><?php echo format_date($item->livre_le, 'dd/MM/yyyy') ?></td>
        <td><?php echo strtoupper($item->tissu) ?></td>
        <td>
          <ul>
          	<li><?php echo $item->getColori() ?> - <?php echo ($item->getMetrage())? $item->getMetrage().' MTS' : $item->getPiece().' PF'; ?> - <?php echo $item->getPrix() ?>&euro;</li>
          </ul>
        </td>
      </tr>
  <?php endforeach; ?>
  </tbody>
</table>
