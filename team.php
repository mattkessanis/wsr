<?php $page_title = 'Western Sydney Racing: Team'; include 'includes/header.php'; ?>
<?php $page_name = "team"; include 'includes/navbar.php'; ?>
  <div class="container-fluid team-container text-center">
      
        
        <div id="team-2017" class="team-div">
          <div class="sub-headings team-heading">
            <span class="glyphicon glyphicon-circle-arrow-left year-glyph" onclick="showyear(2016,'team')"></span><h4 class="sub-headings-text text-center">2017 TEAM</h4>
          </div>
          <div class="team-wrapper" >
            <img class="team-img" src="assets/images/team/team1.jpg" />
            <div class="team-caption-wrapper lead-caption-wrapper">
              <p class="team-img-caption  white-caption">John Doe</p>
              <p class="team-designation  white-caption">Team Lead<p>
            </div>
          </div>
          
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>

        </div>
        <div id="team-2016" class="team-div hidden">
          <div class="sub-headings team-heading">
            <span class="glyphicon glyphicon-circle-arrow-left year-glyph" onclick="showyear(2015,'team')"></span><h4 class="sub-headings-text text-center">2016 TEAM</h4><span class="glyphicon glyphicon-circle-arrow-right year-glyph" onclick="showyear(2017,'team')"></span>
          </div>
          <div class="team-wrapper" >
            <img class="team-img" src="assets/images/team/team1.jpg" />
            <div class="team-caption-wrapper lead-caption-wrapper">
              <p class="team-img-caption  white-caption">John Doe</p>
              <p class="team-designation  white-caption">Team Lead<p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
        </div>
        <div id="team-2015" class="team-div hidden">
          <div class="sub-headings team-heading">
            <h4 class="sub-headings-text text-center">2015 TEAM</h4><span class="glyphicon glyphicon-circle-arrow-right year-glyph" onclick="showyear(2016,'team')"></span>
          </div>
          <div class="team-wrapper" >
            <img class="team-img" src="assets/images/team/team1.jpg" />
            <div class="team-caption-wrapper lead-caption-wrapper">
              <p class="team-img-caption  white-caption">John Doe</p>
              <p class="team-designation  white-caption">Team Lead<p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
          <div class="team-wrapper" data-toggle="modal" data-target="#myModal">
            <img class="team-img " src="assets/images/team/team2.jpg" />
            <div class="team-caption-wrapper">
              <p class="team-img-caption">Jane Doe</p>
              <p class="team-designation">Design Engineer</p>
            </div>
          </div>
        </div>
        

        

  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" data-dismiss="modal">
          <div class="close" ></div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="modal-left">
              <img class="modal-img" src="assets/images/team/team2.jpg" />
            </div>
            <div class="modal-right">
              <h4 class="modal-title">Jane Doe</h4>
              <h5 class="team-designation">Design Engineer</h5>
              <p>
                Duties:
              </p>
              <ul class="modal-roles">
                <li>Role 1</li>
                <li>Role 2</li>
                <li>Role 3</li>
              </ul>
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="modal-about">
              <p>
                 But the third Emir, now seeing himself all alone on the quarter-deck, seems to feel relieved from some curious restraint; for, tipping all sorts of knowing winks in all sorts of directions, and kicking off his shoes, he strikes into a sharp but noiseless squall of a hornpipe right over the Grand Turk's head; and then, by a dexterous sleight, pitching his cap up into the mizentop for a shelf, he goes down rollicking so far at least as he remains visible from the deck, reversing all other processions, by bringing up the rear with music. 
              </p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default modal-close">Contact</button>
        </div>
      </div>

    </div>
  </div>


<?php include 'includes/footer.php' ?>
