<?php     
    $count = 0;
    $sum = 0;
    $five = 0;
    $four = 0;
    $three = 0; 
    $two = 0;
    $one = 0;
    foreach($list_rating as $row){
        $sum = $sum + $row['rate'];
        $count++;
        if($row['rate'] == 5.00){
            $five  = $five + 1;
        }
        if($row['rate'] == 4.00){
            $four  = $four + 1;
        }
        if($row['rate'] == 3.00){
            $three  = $three + 1;
        }
        if($row['rate'] == 2.00){
            $two  = $two + 1;
        }
        if($row['rate'] == 1.00){
            $one  = $one + 1;
        }
    }
    $users = $count;
    $average = $sum / $count;

?>

<div class="container mt-3">
    <p class="text-center h4 mb-3"> Package: <span class="font-weight-bold "><?php echo $list_rating[0]['package_name'] ?></span> Rating</p>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <p>Average Rating: <?php echo number_format($average, 1) ?></p>
                    <p>Number of users reviewed: <?php echo $count ?></p>

                    <p>5 star: <?php echo isset($five) ? $five : 'None' ?> </p>
                    <p>4 star: <?php echo isset($four) ? $four : 'None' ?> </p>
                    <p>3 star: <?php echo isset($three) ? $three : 'None' ?> </p>
                    <p>2 star: <?php echo isset($two) ? $two : 'None' ?> </p>
                    <p>1 star: <?php echo isset($one) ? $one : 'None' ?> </p>

                    <br>
                    <hr>
                    <?php if($this->session->userdata('previous_link')): ?>                        
                        <a href="<?php echo base_url() ?>booking" class="btn btn-primary">Back</a>
                    <?php else: ?>
                        <a href="<?php echo base_url() ?>booking_book_event/<?php echo $this->uri->segment(2) ?>" class="btn btn-primary">Back</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php foreach($list_rating as $row): ?>
                <p><?php echo $row['fname'] ?> <?php echo $row['lname'] ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Rating: <?php echo $row['rate'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><?php echo date('h:i:s a m/d/y', strtotime($row['created_at'])) ?></p>
                    </div>
                </div>
                <p><?php echo $row['review'] ?></p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>