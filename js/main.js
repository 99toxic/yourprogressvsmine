$('document').ready(function () {
  showContainer();
  validForm();
  viewToday();
  chatBox();
//  schedule();
});

function showContainer() {
  $('.forgotPassword, .proPic, .schedule a').click(function () {
    var linkPath = $(this).attr('href');
    var titleName = [];

    if (linkPath === '#userPic') {
      titleName = 'Upload Image';
    } else if (linkPath === '#reset') {
      titleName = 'Reset Password';
    } else if (linkPath === '#add') {
      titleName = 'Create Workout';
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


  $('.view_day').draggable();

  $('#add_tab').tabs();
} // end showContainer

function validForm() {
  $('#dob').datepicker({
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
  var today = '#' + days[now.getDay()];

  $(today).addClass('current_day');
  /* End Highlight The Day Of The Week */

} // end viewToday

function chatBox() {

  $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight);

  $('#btn').click(function (evt) {
    evt.preventDefault();
    $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight);
    var chat = $('.chat-form textarea').val();
    $.post('include/chat-add.php', {
      message: chat
    });
    $('.chatlogs').load('include/chat.php');
  });

  setInterval(function() {
    $('.users').load('include/user-online.php');
    $('.chatlogs').load('include/chat.php').scrollTop($('.chatlogs')[0].scrollHeight);
  }, 5000);
} // end chatBox

function schedule() {

  var weekDay = $('.schedule').children();

  $(weekDay).click(function () {

    var weekChild = $(this).children().attr('class');

    if (weekChild == 'view_day') {
      alert('the day is full');
    } else if (weekChild == 'add_day') {
      alert('make day');
    }
  })

} // end schedule
