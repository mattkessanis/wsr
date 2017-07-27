<?php $page_title = 'Western Sydney Racing'; include 'includes/header.php'; ?>
<?php $page_name = ""; include 'includes/navbar.php'; ?>


<div class="container">
    <form class="sign-form" action="get_sign.php" method="post">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Firstname Lastname">
        </div>
        <div class="form-group">
            <label for="designation">Designation:</label>
            <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="0400 000 000" >
        </div>
        <div class="form-group">
            <label for="mobile">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="name@domain.com" >
        </div>
        
        <button type="submit" class="btn btn-default sign-button center-block">Get my signature!</button>
    </form>
</div>


<?php include 'includes/footer.php' ?>