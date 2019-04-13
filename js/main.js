$('document').ready(function () {
  autoFocus('#uid');
  autoClear();
  showContainer();
  validLogin();
  validSignup();
  viewToday();
  chatBox();
  viewExercise();
  search();
  mobileMenu();
  hide();
  setInterval('rotateAd()', 5000000);
}); // end ready

$(document).idle({
  onIdle: function () {
    var submitLogout = 'submitLogout';
    $.post('include/logout.php', {
      submitLogout: submitLogout
    });
    window.location.href = "index.php";
  },
  idle: 1200000
}); // end idle

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
  $('.forgotPassword, .proPic, #schedule a, .contact').click(function () {
    var linkPath = $(this).attr('href');
    var titleName = [];

    if (linkPath === '#userPic') {
      titleName = 'Upload Image';
    } else if (linkPath === '#reset') {
      titleName = 'Reset Password';
    } else if (linkPath === '#add') {
      titleName = 'Create Workout';
    } else if (linkPath === '#contact') {
      titleName = 'Contact';
    }
    $('#sunday').click(function () {
      $('.desc_submit').attr('name', 'sunday');
      var day = '1';
      var weekDay = 'Sunday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });

      //    if ($(window).width() < 690) {
      //      $('.view_content, .workout').css('display', 'block');
      //      $('.view').css('width', '100%');
      //      $('.profile_img').css('display', 'none');
      //    }

    });
    $('#monday').click(function () {
      $('.desc_submit').attr('name', 'monday');
      var day = '2';
      var weekDay = 'Monday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });
    $('#tuesday').click(function () {
      $('.desc_submit').attr('name', 'tuesday');
      var day = '3';
      var weekDay = 'Tuesday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });
    $('#wednesday').click(function () {
      $('.desc_submit').attr('name', 'wednesday');
      var day = '4';
      var weekDay = 'Wednesday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });
    $('#thursday').click(function () {
      $('.desc_submit').attr('name', 'thursday');
      var day = '5';
      var weekDay = 'Thursday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });
    $('#friday').click(function () {
      $('.desc_submit').attr('name', 'friday');
      var day = '6';
      var weekDay = 'Friday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });
    $('#saturday').click(function () {
      $('.desc_submit').attr('name', 'saturday');
      var day = '7';
      var weekDay = 'Saturday';
      $.post('include/view.php', {
        day: day,
        weekDay: weekDay
      }, function (data, status) {
        $('.view').html(data);
      });
    });

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

  $('#add_tab').tabs();
} // end showContainer

function validLogin() {
  /* Login Validation */
  $('.login form').submit(function (evt) {
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
        window.location.href = "profile.php";
      }
      if ($('.login .form-message p').text() === 'Please fill in all fields!' & $('#uid').val() == '') {
        $('#uid').addClass('error');
        $('#pwd').val('');
      }
      if ($('.login .form-message p').text() === 'Please fill in all fields!' & $('#pwd').val() == '') {
        $('#pwd').addClass('error');
        $('#pwd').val('');
      }
      if ($('.login .form-message p').text() === 'Wrong Username!') {
        $('#uid').addClass('error').val('');
        $('#pwd').val('');
      }
      if ($('.login .form-message p').text() === 'Wrong Password!') {
        $('#pwd').addClass('error').val('');
      }
    }); // end load



  }); // end submit
  /* End Login Validation */

  $('#dob').datepicker({
    buttonImageOnly: true,
    changeYear: true,
    showOtherMonths: true,
    yearRange: '-80:+0'
  }); // end datepicker
} // end ValidLogin

function validSignup() {
  $('#signup .form-message p').css('visibility', 'hidden');
  $('#signup form').submit(function (evt) {
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
    }, function () {
      $('#signup .form-message p').css('visibility', 'visible');

      if ($('#signup .form-message p').text() === 'Signup Success!') {
        window.location.href = "index.php";
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#uid').val() == '') {
        $('#uid').addClass('error');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#email').val() == 'JonJoe@email.com') {
        $('#email').addClass('error');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#dob').val() == '10/20/1950') {
        $('#dob').addClass('error');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#pwd').val() == '') {
        $('#pwd').addClass('error');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'Please fill in all fields!' & $('#pwd_two').val() == '') {
        $('#pwd_two').addClass('error');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid username and email!') {
        $('#uid, #email').addClass('error').val('');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid username!') {
        $('#uid').addClass('error').val('');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'That was an invalid email!') {
        $('#email').addClass('error').val('');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
      if ($('#signup .form-message p').text() === 'Password does not match!') {
        $('#pwd, #pwd_two').addClass('error').val('');
      }
      if ($('#signup .form-message p').text() === 'The username or email already exist!') {
        $('#uid, #email').addClass('error').val('');
        $('#pwd').val('');
        $('#pwd_two').val('');
      }
    }); // end load

  }); // end submit
} // end validSignup

function viewToday() {

  /* Highlight The Day Of The Week */
  var now = new Date();
  var days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
  var today = '#' + days[now.getDay()];
  var todayText = today.split('#')[1];

  if (todayText == 'sunday') {
    var todayNumber = 1;
  }
  if (todayText == 'monday') {
    var todayNumber = 2;
  }
  if (todayText == 'tuesday') {
    var todayNumber = 3;
  }
  if (todayText == 'wednesday') {
    var todayNumber = 4;
  }
  if (todayText == 'thursday') {
    var todayNumber = 5;
  }
  if (todayText == 'friday') {
    var todayNumber = 6;
  }
  if (todayText == 'saturday') {
    var todayNumber = 7;
  }

  $(today).addClass('current_day');

  if ($(today).hasClass('current_day')) {
    var day = todayNumber;
    var weekDay = todayText;
    $.post('include/view.php', {
      day: day,
      weekDay: weekDay
    }, function (data, status) {
      $('.view').html(data);
    });
  }


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

  $('#details_tab').hide();

  $('#desc_tab form').submit(function (evt) {
    evt.preventDefault();
    $('#desc_tab').hide();
    $('#details_tab').show();

    var name = $('#desc_tab .name input').val();
    var type = $('#desc_tab .add_top select').val();
    var sets = $('#desc_tab .sets input').val();
    var desc = $('#desc_tab .desc textarea').val();

    var sunday = $('#desc_tab input[name=sunday]').val();
    var monday = $('#desc_tab input[name=monday]').val();
    var tuesday = $('#desc_tab input[name=tuesday]').val();
    var wednesday = $('#desc_tab input[name=wednesday]').val();
    var thursday = $('#desc_tab input[name=thursday]').val();
    var friday = $('#desc_tab input[name=friday]').val();
    var saturday = $('#desc_tab input[name=saturday]').val();


    $.post('include/workout-desc.php', {
      name: name,
      type: type,
      sets: sets,
      desc: desc,
      sunday: sunday,
      monday: monday,
      tuesday: tuesday,
      wednesday: wednesday,
      thursday: thursday,
      friday: friday,
      saturday: saturday
    });

  });

  // To view exercises in add execerises section
  $('#details_tab form').submit(function (evt) {
    evt.preventDefault();
    var exeName = $('#details_tab .name input').val();
    var exeEquip = $('#details_tab .equipment input').val();
    var exeSets = $('#details_tab .sets_two input').val();
    var exeReps = $('#details_tab .reps input').val();
    var exeTime = $('#details_tab .time input').val();
    var submit = $('#details_tab .flex input[type=submit]').val();
    $.post('include/exe-details.php', {
      name: exeName,
      equip: exeEquip,
      sets: exeSets,
      reps: exeReps,
      time: exeTime,
      submit: submit
    });
    $('.exe').load('include/view-workout.php');
  });
  setInterval(function () {
    $('.exe').load('include/view-workout.php');
  }, 1000);

  $('.done').click(function () {
    location.reload();
  });

//  $('#details_tab .flex input[type=submit]').on('click', function () {
//      $('#details_tab form').find('input:text').val('');
//  });
} // end viewExercise

function search() {
  $('#find form').submit(function (evt) {
    evt.preventDefault();
    var searchExe = $('#find #search').val();
    var searchType = $('#find #type').val();
    var submit = $('#find form input[type=submit]').val();
    $.post('include/search.php', {
      search: searchExe,
      type: searchType,
      submit: submit
    }, function (data, status) {
      $('.search').html(data);

      $('.viewSearch').click(function (evt) {
        evt.preventDefault();
        var thePath = $(this).attr('href');
        var submit = thePath.split('#')[1];
        var wrkId = $(this).attr('id');

        $.post('include/view-exercise.php', {
          wrkid: wrkId,
          submit: submit
        });

        $(thePath).dialog({
          autoOpen: true,
          dialogClass: 'fixed-dialog',
          draggable: true,
          modal: true,
          resizable: false,
          width: 'auto'
        }); // end dialog

        $('#viewSearch').load('include/view-exercise.php');

      });

    });
  });

} // end search

function mobileMenu() {

  var width = $(window).width();

  if (width < 690) {
    $('#online_users, #updates, #find, #schedule').addClass('hidden');

    $('.nav-open').click(function () {
      $('.nav-container').removeClass('hidden');
    });

    $('.view_schedule').click(function () {
      $('#messenger, #updates, #online_users, #find').addClass('hidden');
      $('#schedule').removeClass('hidden');
      $('.nav-container').addClass('hidden');
    });

    $('.view_find').click(function () {
      $('#messenger, #updates, #online_users, #schedule').addClass('hidden');
      $('#find').removeClass('hidden');
      $('#workout').removeClass('hidden');
      $('.nav-container').addClass('hidden');
      $('.workout').show();
    });

    $('.view_update').click(function () {
      $('#messenger, #find, #online_users, #schedule').addClass('hidden');
      $('#updates').removeClass('hidden');
      $('.nav-container').addClass('hidden');
    });

    $('.view_online').click(function () {
      $('#messenger, #find, #updates, #schedule').addClass('hidden');
      $('#online_users').removeClass('hidden');
      $('.nav-container').addClass('hidden');
    });

    $('.view_chat').click(function () {
      $('#online_users, #updates, #find, #schedule').addClass('hidden');
      $('#messenger').removeClass('hidden');
      $('.nav-container').addClass('hidden');
    });
  }
}

function hide() {
  $('.advertise:first').addClass('current');
  $('.advertise:not(:first)').css({
    opacity: 0.0
  });
} // end hide

function rotateAd() {
  var currentPhoto = $('.advertise.current');
  var nextPhoto = currentPhoto.next();
  nextPhoto.addClass('nextPhoto');

  if (nextPhoto.length == 0) {
    nextPhoto = $('.advertise:first');
  }

  currentPhoto.css({
    opacity: 0.0
  }).removeClass('current');

  nextPhoto.css({
    opacity: 0.0
  }).addClass('current').animate({
    opacity: 1.0
  }, 2000); // end callback
} // end rotateAd
