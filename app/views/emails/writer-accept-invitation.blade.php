<h3>Hi Manager</h3>
Writer <?php echo ' ' . $writer . ' has accepted the order #' . $orderId?>
<p>You can check order here <a href="<?php echo URL::route('DetailsOrders', array('id' => $orderId))?>"
                               title="View Order">View
        Invitation</a></p>