$('document').ready(function () {
  autoFocus('#uid');
  autoClear();
  showContainer();
  validLogin();
  validSignup();
  viewToday();
  chatBox();
  viewExercise();
  //  schedule();
});

function autoFocus(focusField) {
  $(focusField).focus();
}

function autoClear() {
  var elements = $('input:text, textarea');
  elements.focus(function () {
    var defVal = $(this).prop('defaultValue');
    var curVal = $(this).val();
    if (defVal == curVal) {
      $(this).val('');
    } // end if
  }); // end focus anon function
  elements.blur(function () {
    var defVal = $(this).prop('defaultValue');
    if ($(this).val() == '') {
      $(this).val(defVal);
    } // end if
  }); // end blur anon function

}

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

function validLogin() {
  $('.login .form-message p').css('visibility', 'hidden');
  /* Login Validation */
  $('.login form').submit (function (evt) {
    evt.preventDefault();

    $('#uid, #pwd').removeClass('error');

    var uid = $('.login #uid').val();
    var pwd = $('.login #pwd').val();
    var submit = $('.login .submit input').val();

    $('.login .form-message').load('include/login.php', {
      uid: uid,
      pwd: pwd,
      submit: submit
    }, function () {
    $('.login .form-message p').css('visibility', 'visible');

      if ($('.login .form-message p').text() === 'Login success!') {
        window.location.href="profile.php";
      }
      if ($('.login .form-message p').text() === 'Please fill in all fields!' & $('#uid').val() == '') {
        $('#uid').addClass('error');
      }
      if ($('.login .form-message p').text() === 'Please fill in all fields!' & $('#pwd').val() == '') {
        $('#pwd').addClass('error');
      }
      if ($('.login .form-message p').text() === 'Wrong Username!') {
        $('#uid').addClass('error');
      }
      if ($('.login .form-message p').text() === 'Wrong Password!') {
        $('#pwd').addClass('error');
      }
    }); // end load



  }); // end submit
  /* End Login Validation */

  $('#dob').datepicker({
    buttonImageOnly: true,
    changeYear: true,
    showOtherMonths: true,
    yearRange: '-50:+0'
  }); // end datepicker
} // end ValidLogin

function validSignup() {
  $('#signup .form-message p').css('visibility', 'hidden');
  $('#signup form').submit (function (evt) {
    evt.preventDefault();

    $('#uid, #email, #dob, #pwd, #pwd_two').removeClass('error');

    var uid = $('#signup #uid').val();
    var email = $('#signup #email').val();
    var dob = $('#signup #dob').val();
    var goal = $('#signup #goal').val();
    var pwd_one = $('#signup #pwd').val();
    var pwd_two = $('#signup #pwd_two').val();
    var submit = $('#signup .submit input').val();

    $('#signup .form-message').load('include/signup.php', {
      uid: uid,
      email: email,
      dob: dob,
      goal: goal,
      pwd: pwd_one,
      pwd_two: pwd_two,
      submit: submit
    }, function() {
       $('#signup .form-message p').css('visibility', 'visible');

      if ($('#signup .form-message p').text() === 'Signup Success!') {
        window.location.href="../yourprogressvsmine.com";
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#uid').val() == '') {
        $('#uid').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#email').val() == 'JonJoe@email.com') {
        $('#email').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#dob').val() == '10/20/1950') {
        $('#dob').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#pwd').val() == '') {
        $('#pwd').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#pwd_two').val() == '') {
        $('#pwd_two').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid username and email!') {
        $('#uid, #email').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid username!') {
        $('#uid').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid email!') {
        $('#email').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'Password does not match!') {
        $('#pwd, #pwd_two').addClass('error');
      }
      if ($('#signup .form-message p').text() === 'The username or email already exist!') {
        $('#uid, #email').addClass('error');
      }
    }); // end load

  }); // end submit
} // end validSignup

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

  $('.chat-form').submit(function (evt) {
    evt.preventDefault();
    $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight);
    var chat = $('.chat-form textarea').val();
    $.post('include/chat-add.php', {
      message: chat
    });
    $('.chatlogs').load('include/chat.php');
  });

  setInterval(function () {
    $('.users').load('include/user-online.php');
    $('.chatlogs').load('include/chat.php').scrollTop($('.chatlogs')[0].scrollHeight);
  }, 1000);
} // end chatBox

function viewExercise() {
  // For view workout function!
  $('#details_tab form').submit(function (evt) {
    evt.preventDefault();
    var exeName = $('#details_tab .name input').val();
    var exeEquip = $('#details_tab .equipment input').val();
    var exeSets = $('#details_tab .sets_two input').val();
    var exeReps = $('#details_tab .reps input').val();
    var exeTime = $('#details_tab .time input').val();
    $.post('include/exe-details.php', {
      name: exeName,
      equip: exeEquip,
      sets: exeSets,
      reps: exeReps,
      time: exeTime
    });
  });
    $('.workout').load('include/view-workout.php');
}

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
