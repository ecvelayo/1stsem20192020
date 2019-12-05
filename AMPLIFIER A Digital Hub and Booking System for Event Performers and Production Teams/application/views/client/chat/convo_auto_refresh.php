<?php 
    $chats['incoming_message'] = $this->C_chat_model->get_latest_user_message(); 
    echo '<pre>';
     print_r($chats['incoming_message']);
     $this->C_chat_model->get_user_info($id);

?>                    
                    
                    <?php foreach($chats['incoming_message'] as $ch): ?>
                        <?php if($ch['incoming_id'] == $this->session->userdata('user_id')): ?>
                        <!-- {{-- Incoming Msg --}} -->
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="<?php echo base_url(); echo $user_info['photo']?>" class="msg-img rounded-circle" alt="">
                                </div>
                                <div class="col-md-6">
                                    <p class="inbox-padding inbox-bg-incoming float-left"> <?php echo $ch['message'] ?> </p>
                                    <p class="text-muted msg-time clear-left"><?php echo date('h:i a m/d/y', strtotime($ch['c_created_at'])) ?></p>
                                </div>
                                <div class="col-md-4 ">
                                    <!-- {{-- 2.3 --}} -->
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($ch['outgoing_id'] == $this->session->userdata('user_id')): ?>
            
                            <!-- {{-- Outgoing Msg --}} -->
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <!-- {{-- 3.1 --}} -->
                                </div>
                                <div class="col-md-6 ">
                                    <p class="float-right inbox-padding inbox-bg-yellow-brown text-white"><?php echo $ch['message'] ?></p>
                                    <p class="d-flex msg-time text-muted justify-content-end clear-right"><?php echo date('h:i a m/d/y', strtotime($ch['c_created_at'])); ?> </p>
                                </div>
                                <div class="col-md-1">
                                    <img src="<?php echo base_url(); echo $this->session->userdata('photo') ?>" class="msg-img rounded-circle align-items-center" alt="">
                                </div>
                            </div>
                        <?php endif; ?>
                            <!-- {{-- end of outgoing msg --}} -->
                    <?php endforeach; ?>