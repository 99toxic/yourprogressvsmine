$('document').ready(function () {
  showContainer();
  validForm();
  viewToday();
  chatBox();
});

function showContainer() {
  $('.proPic').click(function () {
    var linkPath = $(this).attr('href');
    var titleName = [];

    if (linkPath === '#userPic') {
        titleName = 'Upload Image';
      }

    $(linkPath).dialog({
      title: titleName,
      autoOpen: true,
      dialogClass: 'fixed-dialog',
      draggable: true,
      modal: true,
      resizable: false,
      width: 'auto'
    }); // end dialog
  }); // end click
} // end showContainer

function validForm() {
  $('#pickDate').datepicker({
    buttonImageOnly: true,
    changeYear: true,
    showOtherMonths: true,
    yearRange: '-50:+0'
  }); // end datepicker
} // end ValidForm

function viewToday() {

  /* Highlight The Day Of The Week */
  var now = new Date();
  var days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
  var today = '#'+days[now.getDay()];

  $(today).addClass('current_day');
  /* End Highlight The Day Of The Week */

} // end viewToday

function chatBox() {
  $('#btn').click(function (evt) {
    evt.preventDefault();
    var chat = $('.chat-form textarea').val();
    $.post('include/chat.php', {
      message: chat
    });
    $('.chatlogs').load('include/chat.php');
  });
} // end chatBox
