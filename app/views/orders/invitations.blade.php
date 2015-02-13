<?php if($order->invitations->count()):?>
<table id="orders-invitation" class="table table-condensed table-responsive table-bordered">
    <tbody>
    <tr>
        <td><label>Name</label></td>
        <td><label>User Type</label></td>
        <td><label>Status</label></td>
        <td><label>Accepted / Rejected Date</label></td>
        <td><label>Invitation Date</label></td>
        <td><label>Action</label></td>
    </tr>
    <?php foreach($order->invitations as $invitation):?>
    <tr>
        <td><?php echo $invitation->user->first_name . ' ' . $invitation->user->last_name?></td>
        <td><?php echo $invitation->getUserType();?></td>
        <td><?php echo $invitation->getStatus();?></td>
        <td><?php echo ($invitation->status) ? $invitation->updated_at : '';?></td>
        <td><?php echo $invitation->created_at;?></td>
        <td>
            <a class="btn btn-danger" id="del-invitation"
               href="<?php echo URL::route('deleteInvitaion', array('id' => $order->id, 'invitaion_id' => $invitation->id))?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<?php else: ?>
<p>No Invitation send yet</p>
<?php endif; ?>

