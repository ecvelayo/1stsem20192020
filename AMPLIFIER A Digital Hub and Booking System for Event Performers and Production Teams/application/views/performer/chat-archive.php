<?php// $title="Service Chat: AMPLIFIER";?>
<?php// include '../inc/header.php'; ?>

<div class="container py-3">
    <div class="row"> 
        <div class="col-sm-4"> <!-- {{-- START OF LVL 1--}} -->
            <p class="font-weight-bold text-center red-brown h5">Messages</p>
            <hr>
            <!-- {{-- <div class="row">
                    {{-- lvl 1 
                <div class="col-sm">
                    {{-- lvl 1.1 
                    <h2 class="text-primary">Recent</h2>
                </div>  
                <div class="col-sm">
                    {{-- lvl 1.2 
                    <input type="text" placeholder="search">
                </div>
            </div> --}} -->
            <div class="inbox-chat">
                <div id="chat-2">
                    <a href="chat.php" class="btn btn-outline-chat">
                        <div class="row text-chat">
                           <!--  {{-- lvl 1.2 --}} -->
                            <div class="col-sm-2">
                                <!-- {{-- lvl 1.2.1 --}} -->
                                <img src="<?php echo base_url(); ?>assets/img/pp.png " alt="" class="avatar-img rounded-circle">
                            </div>
                            <div class="col-sm-10">
                               <!--  {{-- lvl 1.2.2 --}} -->
                                <div class="row">
                                    <div class="col-sm-7 ">
                                        <p class="">Nike Marti Caballes</p>
                                    </div>
                                    <div class="col-sm-5 ">
                                        <p class="h6 ">11:01 PM</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                       <!--  {{-- lvl 1.2.2.1 --}} -->
                                        <p class="">You: Test, which is a new appr..</p>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </a>
                </div>
                <div class="py-1"></div>

                <?php for($x=0; $x<10; $x++){ ?>
                    <div id="chat-2">
                        <a href="" class="btn btn-outline-chat">                            
                            <div class="row text-chat">
                               <!--  {{-- lvl 1.2 --}} -->
                                <div class="col-sm-2">
                                    <!-- {{-- lvl 1.2.1 --}} -->
                                    <img src="<?php echo base_url(); ?>assets/img/pp.png " alt="" class="avatar-img rounded-circle">
                                </div>
                                <div class="col-sm-10">
                                   <!--  {{-- lvl 1.2.2 --}} -->
                                    <div class="row">
                                        <div class="col-sm-7 ">
                                            <p class=" ">Nike Marti Caballes</p>
                                        </div>
                                        <div class="col-sm-5 ">
                                            <p class=" h6">11:01 PM</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                           <!--  {{-- lvl 1.2.2.1 --}} -->
                                            <p class="">You: Test, which is a new appr..</p>
                                        </div>
                                    </div>
                                </div>                    
                            </div>
                        </a>
                    </div>
                    <div class="py-1"></div>
                <?php } ?>

            </div>

        </div>  <!-- {{-- END OF lvl 1--}} -->

        <div class="col-sm-8">
            <p class="h5 font-weight-bold red-brown d-flex justify-content-center">Nike Marti Caballes</p>
            <hr class="">
            <!-- {{-- Incoming Msg --}} -->
            <div class="inbox-convo">
                <div class="row">
                    <div class="col-sm-1">
                        <img src="<?php echo base_url(); ?>assets/img/okarin.png " class="msg-img rounded-circle" alt="">
                    </div>
                    <div class="col-sm-6">
                        <p class="inbox-padding inbox-bg-incoming float-left">Test work directly with our designers and suppliers, and sell direct to you, which means quality, exclusiv </p>
                        <p class="text-muted msg-time clear-left">5:56 PM</p>
                    </div>
                    <div class="col-sm-4 ">
                        <!-- {{-- 2.3 --}} -->
                    </div>
                </div>

                <!-- {{-- Outgoing Msg --}} -->
                <div class="row ">
                    <div class="col-sm-4 ">
                        <!-- {{-- 3.1 --}} -->
                    </div>
                    <div class="col-sm-6 ">
                        <p class="float-right inbox-padding inbox-bg-yellow-brown text-white">Test Test work directly with our designers and suppliers, and sell direct to you, which means quality, exclusiv </p>
                        <p class="d-flex msg-time text-muted justify-content-end clear-right">6:44 PM</p>
                    </div>
                    <div class="col-sm-1">
                        <img src="<?php echo base_url(); ?>assets/img/okarin.png" class="msg-img rounded-circle align-items-center" alt="">
                    </div>
                </div>
                <!-- {{-- end of outgoing msg --}} -->

                    <?php for($x=0; $x<10; $x++){ ?>
                    <!-- {{-- Incoming Msg --}} -->
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="<?php echo base_url(); ?>assets/img/okarin.png " class="msg-img rounded-circle" alt="">
                            </div>
                            <div class="col-sm-6">
                                <p class="inbox-padding inbox-bg-incoming float-left">Test work directly with our designers and suppliers, and sell direct to you, which means quality, exclusiv </p>
                                <p class="text-muted msg-time clear-left">5:56 PM</p>
                            </div>
                            <div class="col-sm-4 ">
                                <!-- {{-- 2.3 --}} -->
                            </div>
                        </div>
        
                        <!-- {{-- Outgoing Msg --}} -->
                        <div class="row ">
                            <div class="col-sm-4 ">
                                <!-- {{-- 3.1 --}} -->
                            </div>
                            <div class="col-sm-6 ">
                                <p class="float-right inbox-padding inbox-bg-yellow-brown text-white">Test Test work directly with our designers and suppliers, and sell direct to you, which means quality, exclusiv </p>
                                <p class="d-flex msg-time text-muted justify-content-end clear-right">6:44 PM</p>
                            </div>
                            <div class="col-sm-1">
                                <img src="<?php echo base_url(); ?>assets/img/okarin.png  " class="msg-img rounded-circle align-items-center" alt="">
                            </div>
                        </div>
                        <!-- {{-- end of outgoing msg --}} -->
                    <?php } ?>
            </div>
            <div class="c-hr"></div>
            <div class="row ">
                <div class="col-sm-11">
                    <!-- <input type="text" placeholder="Type a message..." class="form-group form-control"> -->
                    <textarea name="" id="" class="form-group form-control" rows="1"></textarea>
                </div>
                <div class="col-sm-1">
                    <a href="#">send icon</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php// include '../inc/footer.php'; ?>