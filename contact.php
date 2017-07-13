<?php
  $prefix = "includes/backend/";
  include "includes/protected/config.php";
?>
<?php $page_title = 'Western Sydney Racing: Contact'; include 'includes/header.php'; ?>
<?php $page_name = "contact"; include 'includes/navbar.php'; ?>
<div class="container">
  <div class="headings">
    <h3 class="page-headings">CONTACT</h3>
  </div>
  <div class="contact-wrapper">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active form-tab"><a href="#general-enquiries" aria-controls="general-enquiries" role="tab" data-toggle="tab">General Enquiries</a></li>
      <li role="presentation" class="form-tab"><a href="#sponsorship" aria-controls="sponsorship" role="tab" data-toggle="tab">Sponsorship</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="general-enquiries">
        <div class="row form-padding">
          <div class="col-md-6">
            <div>
              <form id="general-contact" method="post" action="<?php echo LISTENER?>">
                <div class="form-group">
                  <input type="name" class="form-control" id="general-name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="general-email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="general-phone" name="phone" placeholder="Phone">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows=6 id="general-message" name="message" placeholder="Message"></textarea>
                </div>
                <button type="submit" id="general-button" class="btn btn-default button-custom">Send Enquiry</button>
              </form>
              <div class="form-group" >
                <p id="general-result"></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-6">
                <p> <span class="glyphicon glyphicon-map-marker glyph-red" aria-hidden="true"></span>
                  Western Sydney University, <br />
                  Penrith, NSW - 2751.
                </p>
            </div>
            <div class="col-md-6">
              <p> <span class="glyphicon glyphicon-envelope glyph-red" aria-hidden="true"></span>
                name@domain.com
              </p>
              <p> <span class="glyphicon glyphicon-earphone glyph-red" aria-hidden="true"></span>
                0401234567
              </p>
            </div>
            <div class="clearfix"></div>
            <div id="map"></div>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="sponsorship">
        <div class="row form-padding">
          <div class="col-md-6">
            <div>
              <form id="sponser-contact" method="post" action="<?php echo LISTENER?>">
                <div class="form-group">
                  <input type="name" class="form-control" id="sponser-name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="sponser-email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="sponser-phone" name="phone" placeholder="Phone">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows=6 id="sponser-message" name="message" placeholder="Message"></textarea>
                </div>
                <button type="submit" id="sponser-button" class="btn btn-default button-custom">Send Enquiry</button>
              </form>
              <div class="form-group" >
                <p id="sponser-result"></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            Some information for sponsors here!
          </div>
        </div>
  </div>
</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWngbHYTCp1TadbViXnirszehqnoI7X8M&callback=initMap"></script>
<?php include 'includes/footer.php' ?>
