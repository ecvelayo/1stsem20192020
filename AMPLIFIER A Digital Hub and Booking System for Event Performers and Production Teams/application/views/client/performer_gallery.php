<div class="container py-3" style="background-image: url('<?php// echo base_url(); ?>assets/img/website/video_streaming.svg');">
    
    <p class="h3 yellow-brown text-center">Performer Band Videos</p>
    <div class="row">
        <div class="col-md-4">
            <div class="embed-responsive embed-responsive-16by9  border-black-3">
                <iframe class="embed-responsive-item video-frame" src="<?php echo base_url(); echo $galleries['video_1'] ?>" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-4">
            <div class="embed-responsive embed-responsive-16by9  border-black-3">
                <iframe class="embed-responsive-item video-frame" src="<?php echo base_url(); echo $galleries['video_2'] ?>" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-4">
            <div class="embed-responsive embed-responsive-16by9 border-black-3">
                <iframe class="embed-responsive-item video-frame" src="<?php echo base_url(); echo $galleries['video_3'] ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-6 text-center">
            <p class="text-center yellow-brown h3">Performer Band Photo</p>
            <img src="<?php echo base_url(); echo $galleries['band_photo'] ?>" class="border-black-3" width="100%" alt="">
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-end flex-column pb-5 mt-5" style="height:100%; position; background-position: bottom; background-image: url('<?php// echo base_url(); ?>assets/img/website/video_streaming.svg');">
                <div class="mb-auto bd-highlight"></div>
                <div class="bd-highlight">
                    <a href="<?php echo base_url(); ?>performer_profile_info/<?php echo $this->uri->segment(2) ?>" class="btn btn-primary mb-5"><span class="fas fa-arrow-left"></span> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>