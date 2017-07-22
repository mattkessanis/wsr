/*
* Ajax controller for handling the submission of teamForms and their return values
*
*
*/

$(document).ready(function(){

  var teamForm = "#team-contact";
  var teamFormInfo = "&form=team";
  var teamMessage = "#team-result";

  var engForm = "#eng-contact";
  var engFormInfo = "&form=eng";
  var engMessage = "#eng-result";

  var generalForm = "#general-contact";
  var generalFormInfo = "&form=general";
  var generalMessage = "#general-result";

  var sponserForm = "#sponser-contact";
  var sponserFormInfo = "&form=sponser";
  var sponserMessage = "#sponser-result";


  //** -------------------------- Team Contact form submission handler ---------------------------------- **//

  //   The following handles teamForm submission for the join team tab on the website join page, sends async
  //   request to the php listener and provides teamMessage to user.

  //** -------------------------------------------------------------------------------------------------- **//

  $(teamForm).submit(function(event) {

    // Stop the browser from submitting the teamForm.
    event.preventDefault();

    // Serialize the teamForm data and add the teamForm type data to the  array
    var teamFormData = $(teamForm).serialize();
    teamFormData = teamFormData.concat(teamFormInfo);

    // Submit the teamForm using AJAX.
    $.ajax({
        type: 'POST',
        url: $(teamForm).attr('action'),
        data: teamFormData
    })

    .done(function(response) {
      // Make sure that the teamMessage div has the 'success' class.
      $(teamMessage).css("color","Green");

      // Set the teamMessage text.
      $(teamMessage).text(response);

      // Clear the teamForm.
      $('#team-name').val('');
      $('#team-email').val('');
      $('#team-phone').val('');
      $('#team-message').val('');
    })

    .fail(function(data) {
      // Make sure that the teamMessage div has the 'error' class.
      $(teamMessage).css("color","red");

      // Set the teamMessage text.
      if (data.responseText !== '') {
          $(teamMessage).text(data.responseText);
      } else {
          $(teamMessage).text('Oops! An error occured and your message could not be sent.');
      }
    });
  }); // end team teamForm

  //** -------------------------- Engineering form submission handler ---------------------------------- **//

  //   The following handles engineering submission for the join tab on the website join page, sends async
  //   request to the php listener and provides message to user.

  //** -------------------------------------------------------------------------------------------------- **//

  $(engForm).submit(function(event) {

    // Stop the browser from submitting the engForm.
    event.preventDefault();

    // Serialize the engForm data and add the engForm type data to the  array
    var engFormData = $(engForm).serialize();
    engFormData = engFormData.concat(engFormInfo);

    // Submit the engForm using AJAX.
    $.ajax({
        type: 'POST',
        url: $(engForm).attr('action'),
        data: engFormData
    })

    .done(function(response) {
      // Make sure that the teamMessage div has the 'success' class.
      $(engMessage).css("color","Green");

      // Set the engMessage text.
      $(engMessage).text(response);

      // Clear the engForm.
      $('#eng-name').val('');
      $('#eng-email').val('');
      $('#eng-phone').val('');
      $('#eng-message').val('');
    })

    .fail(function(data) {
      // Make sure that the message div has the 'error' class.
      $(engMessage).css("color","red");

      // Set the engMessage text.
      if (data.responseText !== '') {
          $(engMessage).text(data.responseText);
      } else {
          $(engMessage).text('Oops! An error occured and your message could not be sent.');
      }
    });
  }); // end engineering form

  //** ------------------------- General inquires form submission handler ------------------------------- **//

  //   The following handles general submission for the general enquiry tab on the website contact page, sends
  //   request to the php listener and provides message to user.

  //** -------------------------------------------------------------------------------------------------- **//

  $(generalForm).submit(function(event) {

    // Stop the browser from submitting the engForm.
    event.preventDefault();

    // Serialize the engForm data and add the engForm type data to the  array
    var generalFormData = $(generalForm).serialize();
    generalFormData = generalFormData.concat(generalFormInfo);

    // Submit the engForm using AJAX.
    $.ajax({
        type: 'POST',
        url: $(generalForm).attr('action'),
        data: generalFormData
    })

    .done(function(response) {
      // Make sure that the teamMessage div has the 'success' class.
      $(generalMessage).css("color","Green");

      // Set the engMessage text.
      $(generalMessage).text(response);

      // Clear the engForm.
      $('#general-name').val('');
      $('#general-email').val('');
      $('#general-phone').val('');
      $('#general-message').val('');
    })

    .fail(function(data) {
      // Make sure that the message div has the 'error' class.
      $(generalMessage).css("color","red");

      // Set the engMessage text.
      if (data.responseText !== '') {
          $(generalMessage).text(data.responseText);
      } else {
          $(generalMessage).text('Oops! An error occured and your message could not be sent.');
      }
    });
  }); // end general enquires form

  //** ------------------------- General inquires form submission handler ------------------------------- **//

  //   The following handles general submission for the general enquiry tab on the website contact page, sends
  //   request to the php listener and provides message to user.

  //** -------------------------------------------------------------------------------------------------- **//

  $(sponserForm).submit(function(event) {

    // Stop the browser from submitting the engForm.
    event.preventDefault();

    // Serialize the sponser form data and add the engForm type data to the  array
    var sponserFormData = $(sponserForm).serialize();
    sponserFormData = sponserFormData.concat(sponserFormInfo);

    // Submit the engForm using AJAX.
    $.ajax({
        type: 'POST',
        url: $(sponserForm).attr('action'),
        data: sponserFormData
    })

    .done(function(response) {
      // Make sure that the teamMessage div has the 'success' class.
      $(sponserMessage).css("color","Green");

      // Set the engMessage text.
      $(sponserMessage).text(response);

      // Clear the engForm.
      $('#sponser-name').val('');
      $('#sponser-email').val('');
      $('#sponser-phone').val('');
      $('#sponser-message').val('');
    })

    .fail(function(data) {
      // Make sure that the message div has the 'error' class.
      $(teamMessage).css("color","red");

      // Set the engMessage text.
      if (data.responseText !== '') {
          $(sponserMessage).text(data.responseText);
      } else {
          $(sponserMessage).text('Oops! An error occured and your message could not be sent.');
      }
    });
  }); // end sponser enquires form
});
