<div class="container mt-3">
    <div class="row">
        <div class="col-md-7">
            <p class="h4 text-center">Notifications</p>
            <table class="table table-bordered table-hover">
                <?php if($notifications):?>
                    <?php foreach($notifications as $n): ?>
                    <?php
                        $user_id = $this->session->userdata('user_id');
                        if($user_id == $n['user_id']){
                            $message = $n['notif_name'];
                            $links = $n['links'];
                        }else if($user_id == $n['target_user_id']){
                            $message = $n['target_notif_name'];
                            $links = $n['target_links'];
                        }else{
                            $message = '';
                            $links = '';
                        }
                    ?>     
                        <tr class="clickable-row <?php echo $n['status'] == 'notified'? 'bg-light' : '' ?>" data-toggle="tooltip" data-placement="right" title="<?php echo date('m/d/y h:i a', strtotime($n['created_at'])) ?>" data-href="<?php echo $links?>">
                            <td class="">
                                <p class="text-justify"><?php echo $message ?></p>
                            </td>
                        </tr>              
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
                <?php echo $this->pagination->create_links(); ?>
        </div>
        <div class="col-md-5 mt-3">
            <img src="<?php echo base_url() ?>assets/img/website/reminders.svg" width="100%" alt="">
        </div>
    </div>
</div>

<?php 
    if(isset($notifications)){
        $this->Notification_model->notified_to_seen($notifications);
    }else{

    }
?>