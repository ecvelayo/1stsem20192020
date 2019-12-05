
<?php echo form_open('c_chat_send_search_message/'.$this->uri->segment(2)); ?>

<?php
    // userinfo
    // incoming_message
    // left panel
?>

<?php if($this->uri->segment(2) == $this->session->userdata('user_id') ): ?>


<div class="container py-3">
    <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="form-group row">
                    <label for="" class="col-md-1 col-form-label"></label>
                    <div class="col-md-10">
                        <input type="hidden" id="userID" name="userID" value="<?php echo isset($userID) ? $userID : '' ?>">
                        <input type="text" id="userName" name="userName" class="form-control <?php echo form_error('userID') ? 'is-invalid' : '' ?> <?php echo $this->session->flashdata('user_not_found') ? 'is-invalid' : '' ?>"  placeholder="<?php echo form_error('userID') ? $this->session->flashdata('user_not_found') ? $this->session->flashdata('user_not_found') : form_error('userID') : 'Type a name of a person' ?>   ">
                    </div>
                    <button type="submit" name="search" value="search" class="col-md-1 col-form-label unstyled-button red-brown " ><i class="fas fa-search fa-lg"> </i></button>

                    <!-- <div class="col-md-1 col-form-label"><a href="" type="submit" class="red-brown"><i class="fas fa-search fa-lg"></i></a></div>\ -->
                </div>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-4"> <!-- {{-- START OF LVL 1--}} -->
                <p class="font-weight-bold text-center red-brown h5">Messages</p>
                <hr>
                <div class="inbox-chat">

                    <div class="py-1"></div>
                </div>
            </div>  <!-- {{-- END OF lvl 1--}} -->

            <div class="col-md-8">
                <p class="h5 font-weight-bold red-brown d-flex justify-content-center"><?php echo $this->session->userdata('fname') ?> <?php echo $this->session->userdata('lname') ?></p>
                <hr class="">
                <!-- {{-- Incoming Msg --}} -->
                <div class="inbox-convo">

                </div>
                <div class="c-hr"></div>
                <div class="row pr-3">
                    <div class="col-md-11 ">
                        <p class="form-group form-control">Type a message...</p>
                    </div>
                    <div class="col-md-1 ">
                        <p class="unstyled-button red-brown"><i class="far fa-paper-plane fa-2x"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

<input type="hidden" value="<?php echo $this->uri->segment(2); ?>" name="id">

    <div class="container py-3">
    <?php 
        
                // echo '<pre>';
                // print_r($chats);
                // echo '</pre>';
                // die();
    ?>
    <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="form-group row">
                    <label for="" class="col-md-1 col-form-label"></label>
                    <div class="col-md-10">
                        <input type="hidden" id="userID" name="userID" value="<?php echo isset($userID) ? $userID : '' ?>">
                        <input type="text" id="userName" name="userName" class="form-control <?php echo form_error('userID') ? 'is-invalid' : '' ?> <?php echo $this->session->flashdata('user_not_found') ? 'is-invalid' : '' ?>"  placeholder="<?php echo form_error('userID') ? $this->session->flashdata('user_not_found') ? $this->session->flashdata('user_not_found') : form_error('userID') : 'Type a name of a person' ?>   ">
                    </div>
                    <button type="submit" name="search" value="search" class="col-md-1 col-form-label unstyled-button red-brown " ><i class="fas fa-search fa-lg"> </i></button>

                    <!-- <div class="col-md-1 col-form-label"><a href="" type="submit" class="red-brown"><i class="fas fa-search fa-lg"></i></a></div>\ -->
                </div>
            </div>
        </div>

        <div class="row"> 
            <div class="col-md-4"> <!-- {{-- START OF LVL 1--}} -->
                <p class="font-weight-bold text-center red-brown h5">Messages</p>
                <hr>
                <div class="inbox-chat">

                    <?php if($chats['left_panel']): ?>
                        <?php foreach($chats['left_panel'] as $c): ?>
                            <div id="chat-2">
                                <a href="<?php echo base_url(); echo 'c_chat/'; echo $c['user_id']?>" class="btn btn-outline-chat col-md-12">
                                    <div class="row text-chat">
                                    <!--  {{-- lvl 1.2 --}} -->
                                        <div class="col-md-2">
                                            <!-- {{-- lvl 1.2.1 --}} -->
                                            <img src="<?php echo base_url(); echo $c['photo'] ?>" alt="" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="col-md-10 ">
                                        <!--  {{-- lvl 1.2.2 --}} -->
                                            <div class="row ">
                                                <div class="col-md-8 ">
                                                    <p class="text-capitalize"><?php echo $c['fname'] ?> <?php echo $c['lname'] ?></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <small><?php echo date('h:i a m/d/y', strtotime($c[0]['created_at'])) ?></small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <!--  {{-- lvl 1.2.2.1 --}} -->
                                                <p class="d-flex justify-content-start ml-4" > <?php echo $c[0]['outgoing_id'] == $this->session->userdata('user_id') ? 'You: '.$c[0]['message'] : $c[0]['message']  ?></p>
                                                </div>
                                            </div>
                                        </div>                    
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif;?>
                    <div class="py-1"></div>
                </div>
            </div>  <!-- {{-- END OF lvl 1--}} -->

            <div class="col-md-8">
                <p class="h5 font-weight-bold red-brown d-flex justify-content-center"><?php echo $user_info['fname'] ?> <?php echo $user_info['lname'] ?></p>
                <hr class="">
                <!-- {{-- Incoming Msg --}} -->
                <div class="inbox-convo" id="convo_auto_refresh">

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

                </div>
                <div class="c-hr"></div>
                <div class="row pr-3">
                    <div class="col-md-11 ">
                        <input type="text" name="message" class="form-group form-control <?php echo form_error('message') ? 'is-invalid' : '' ?>" placeholder="<?php echo form_error('message') ? form_error('message') : 'Type a message...' ?>">
                    </div>
                    <div class="col-md-1 ">
                        <button type="submit" name="send_message" value="send_message" class="unstyled-button red-brown"><i class="far fa-paper-plane fa-2x"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php form_close(); ?>

<script type='text/javascript'>
	var tmp = <?php echo json_encode($users) ?>;
	// console.log(tmp);
	var users = [];
	for (var i = 0; i < tmp.length; i++) {
		// alert(tmp[i].id);
		item = {};
		item["value"] = tmp[i].user_id;
		item['label'] = tmp[i].lname+", "+tmp[i].fname;
		// if (tmp[i].username == null) {
		// 	item["label"] = tmp[i].lname+", "+tmp[i].fname;
		// } else {
		// 	item["label"] = tmp[i].lname+", "+tmp[i].fname+" "+tmp[i].mname;
		// }
        users.push(item);
    }
    
        console.log(tmp);
</script>	