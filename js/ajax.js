 var formData = $(".login form").serialize();
    formData += "&submit";

    console.log(formData);
//
    $.ajax({
      url: "include/login.php",
      method: "POST",
      data: formData,
      complete: function(response) {
//        $("html").html(response.data);

        $('.login .form-message p').text(response);
      }
    });
