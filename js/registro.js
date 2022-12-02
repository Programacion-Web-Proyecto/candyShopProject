$(document).ready(function () {

  $("#password2").keyup(function () {
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();

    if (pass1 == pass2) {
      // alert('aaa');
      $("#error2").text("Coinciden!").css("color", "green");
	  $("#regis").show();
    } else {
      // alert('DDD');
      $("#error2").text("No coinciden!").css("color", "red");
	  $("#regis").hide();
    }

    if (pass2 == "") {
      $("#error2").text("No se puede dejar en blanco!").css("color", "red");
    }

	
  });

});
