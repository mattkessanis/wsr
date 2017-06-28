<?php $page_title = 'Western Sydney Racing: Contact'; include 'includes/header.php'; ?>
<?php $page_name = "contact"; include 'includes/navbar.php'; ?>

<div class="container">
  <div class="headings">
    <h3 class="page-headings">CONTACT</h3>
  </div>

  <div class="contact-wrapper">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active form-tab"><a href="#general-enquiries" aria-controls="general-enquiries" role="tab" data-toggle="tab">General Enquiries</a></li>
      <li role="presentation" class="form-tab"><a href="#sponsorship" aria-controls="sponsorship" role="tab" data-toggle="tab">Sponsorship</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="general-enquiries">
        <div class="row form-padding">
          <div class="col-md-6">
            <div>
              <form action="contact.php">
                <div class="form-group">
                  <input type="name" class="form-control" id="general-name" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="general-email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="general-phone" placeholder="Phone">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows=6 id="general-message" placeholder="Message"></textarea>
                </div>

                <button type="submit" class="btn btn-default button-custom">Send Enquiry</button>
              </form>
            </div>

          </div>
          <div class="col-md-6">
            <div class="col-md-6">
                <p> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                  Western Sydney University, <br />
                  Penrith, NSW - 2751.
                </p>
                <p> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                  name@domain.com
                </p>
                <p> <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                  0401234567
                </p>
            </div>
            <div class="col-md-6">
              <div id="map"></div>
              <!-- Replace the value of the key parameter with your own API key. -->
              <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWngbHYTCp1TadbViXnirszehqnoI7X8M&callback=initMap">


              </script>
            </div>
            <div class="clearfix"></div>
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            Etiam ultrices ligula et quam vulputate, et ornare ligula fermentum. Vivamus mi massa, vulputate eu luctus quis, vehicula id odio. Duis id leo in mi accumsan pretium. Morbi volutpat facilisis lectus, at eleifend urna facilisis in. Sed aliquam lorem ligula, id ullamcorper urna blandit in. Donec maximus arcu eu nisi imperdiet volutpat. Morbi in augue laoreet, porttitor dolor ut, sollicitudin sapien. Suspendisse condimentum luctus suscipit. Sed nec ligula enim. In hac habitasse platea dictumst. Cras iaculis magna ac viverra placerat. Sed blandit fringilla justo a gravida. Aliquam sed viverra massa, non vehicula elit. Sed sodales nec turpis vitae vehicula.
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="sponsorship">
        <p class="text-left">
          ****** COMING SOON *******
        </p>
      </div>
  </div>
</div>
</div>

<?php include 'includes/footer.php' ?>
