<?php $page_title = 'Western Sydney Racing: Contact'; include 'includes/header.php'; ?>
<?php $page_name = "join"; include 'includes/navbar.php'; ?>
<div class="container">
  <div class="headings">
    <h3 class="page-headings">JOIN</h3>
  </div>
  <div class="contact-wrapper">
    <h4></h4>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active form-tab"><a href="#join-team" aria-controls="general-enquiries" role="tab" data-toggle="tab">Join Team</a></li>
      <li role="presentation" class="form-tab"><a href="#engineering-project" aria-controls="sponsorship" role="tab" data-toggle="tab">Engineering Project</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="join-team">
        <div class="row form-padding">
          <div class="col-md-6">
            <p>
              Our Formula SAE team transforms students into skilled, experienced, professionals. We are always looking for new members!
            </p>
            <form>
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

              <button type="submit" class="btn btn-default button-custom">Send Request</button>
            </form>
          </div>
          <div class="col-md-6">
            <p>
              We want to help our members become amazing. We want the world to recognise WSU Students as high-calibre, talented, skilled, ambitious, quality professionals.
              Become a part of a team that cares about your future, and can teach you everything you need to establish your new career. Achieve something greater than just a degree.
              Inculcate the right mindset to pursue your unlimited potential.
            </p>
            <h4>Benefits:</h4>
            <ul>
              <li>Roles for all disciplines</li>
              <li>Exclusive job opportunities</li>
              <li>Represent the University</li>
              <li>Reference Letter from Project Lead</li>
              <li>Reference Letter from School</li>
              <li>Roles for all disciplines</li>
              <li>Exclusive training</li>
              <li>Access to restricted equipment</li>
              <li>Socialising with like-minded people</li>
              <li>Networking in industry</li>
              <li>Exclusive work experience offers</li>
              <li>Member-focused development</li>
              <li>Noteworthy resume/C.V. addition</li>
              <li>Awesome team events</li>
              <li><strong>START LOVING YOUR WORK!</strong></li>
            </ul>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="engineering-project">
        <div class="row form-padding">
          <div class="col-md-6">
            <p>
              Our Formula SAE team transforms students into skilled, experienced, professionals. We are always looking for new members!
            </p>
            <form action="/includes/backend/listener.php">
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

              <button type="submit" class="btn btn-default button-custom">Send Request</button>
            </form>
          </div>
          <div class="col-md-6">
            <p>
              Dummy content!
            </p>
            <h4>Dummy List</h4>
            <ul>
              <li>Dummy item</li>
              <li>Dummy item</li>
              <li>Dummy item</li>
              <li>Dummy item</li>
              <li>Dummy item</li>
            </ul>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
<script>


  function send() {
    var name = document.getElementById("general-name").innerHTML;
    var email = document.getElementById("general-email").innerHTML;
    var phone = document.getElementById("general-email").innerHTML;
    var message = document.getElementById("general-email").innerHTML;

    var data = [name,email,phone,message];
    alert(name, email, phone, message);

    /*var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

      }
    };
    file = file+logged;
    xhttp.open("GET", file, true);
    xhttp.send();*/
  }
</script>
<?php include 'includes/footer.php' ?>
