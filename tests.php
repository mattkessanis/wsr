<style>
.image-wrapper {
  max-width: 200px;
  display: inline-block;
  position: relative;
  margin: 10px;
  overflow: hidden;
}

.image-wrapper:hover .lead-img {
  filter: grayscale(0%);
  transition: filter 500ms;
}

.image-wrapper:hover .img-caption {
  opacity: 1;
  top: 100px;
  transition: top 1s, opacity 1s linear ;

}

.lead-img {
  max-width: 200px;
  filter: grayscale(100%);
  transition: filter 500ms;
}

.small-lead-img {
  max-width: 100px;
}
.img-caption {
  position: absolute;
  top: 200px;
  padding: 5px;
  font-weight: 300;
  background-color: rgba(255,255,255, 0.7);
  width: 100%;
  opacity: 0;
  transition: top 1s;
  transition: opacity 2s linear;


}
</style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tests</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  </head>
  <body>
    <div class="container container-fluid">
      <div class="image-wrapper">
        <img class="lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Some Name Here</h4>
          <p>Some Description Here</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption" >
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption" >
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div><div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img small-lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Name</h4>
          <p>Description</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption">
          <h4>Some Name Here</h4>
          <p>Some Description Here</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption" >
          <h4>Some Name Here</h4>
          <p>Some Description Here</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption" >
          <h4>Some Name Here</h4>
          <p>Some Description Here</p>
        </div>
      </div>
      <div class="image-wrapper">
        <img class="lead-img" src="http://localhost/wsracing/assets/images/team/lead2@2x.jpg"  />
        <div class="img-caption" >
          <h4>Some Name Here</h4>
          <p>Some Description Here</p>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
