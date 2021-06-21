$(document).ready(function () {
  // toggle password visibility in index page
  $("#password_toggle i").click(function () {
    if ($("#password_toggle input").attr("type") == "text") {
      $("#password_toggle input").attr("type", "password");
      $("#password_toggle i").addClass("fa-eye-slash");
      $("#password_toggle i").removeClass("fa-eye");
    } else {
      $("#password_toggle input").attr("type", "text");
      $("#password_toggle i").addClass("fa-eye");
      $("#password_toggle i").removeClass("fa-eye-slash");
    }
  });
  // toggle password visibility in change password
  $("#password_toggle_new i").click(function () {
    if ($("#password_toggle_new input").attr("type") == "text") {
      $("#password_toggle_new input").attr("type", "password");
      $("#password_toggle_new i").addClass("fa-eye-slash");
      $("#password_toggle_new i").removeClass("fa-eye");
    } else {
      $("#password_toggle_new input").attr("type", "text");
      $("#password_toggle_new i").addClass("fa-eye");
      $("#password_toggle_new i").removeClass("fa-eye-slash");
    }
  });
  // toggle password visibility in change password confirmation
  $("#password_toggle_new_confirm i").click(function () {
    if ($("#password_toggle_new_confirm input").attr("type") == "text") {
      $("#password_toggle_new_confirm input").attr("type", "password");
      $("#password_toggle_new_confirm i").addClass("fa-eye-slash");
      $("#password_toggle_new_confirm i").removeClass("fa-eye");
    } else {
      $("#password_toggle_new_confirm input").attr("type", "text");
      $("#password_toggle_new_confirm i").addClass("fa-eye");
      $("#password_toggle_new_confirm i").removeClass("fa-eye-slash");
    }
  });

  // toggle password visibility in new user password
  $("#password_toggle_new_user i").click(function () {
    if ($("#password_toggle_new_user input").attr("type") == "text") {
      $("#password_toggle_new_user input").attr("type", "password");
      $("#password_toggle_new_user i").addClass("fa-eye-slash");
      $("#password_toggle_new_user i").removeClass("fa-eye");
    } else {
      $("#password_toggle_new_user input").attr("type", "text");
      $("#password_toggle_new_user i").addClass("fa-eye");
      $("#password_toggle_new_user i").removeClass("fa-eye-slash");
    }
  });
  // toggle password visibility in new user password confirmation
  $("#password_toggle_new_user_confirm i").click(function () {
    if ($("#password_toggle_new_user_confirm input").attr("type") == "text") {
      $("#password_toggle_new_user_confirm input").attr("type", "password");
      $("#password_toggle_new_user_confirm i").addClass("fa-eye-slash");
      $("#password_toggle_new_user_confirm i").removeClass("fa-eye");
    } else {
      $("#password_toggle_new_user_confirm input").attr("type", "text");
      $("#password_toggle_new_user_confirm i").addClass("fa-eye");
      $("#password_toggle_new_user_confirm i").removeClass("fa-eye-slash");
    }
  });

  // search in all events table
  $("#events_search").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#events_table_body tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  // search input placeholder for all events
  var placeHolder = [
    "Search for an event...",
    "Search for an organiser...",
    "Search for a day...",
    "Search for a month...",
    "Search for a year...",
  ];
  var n = 0;
  var loopLength = placeHolder.length;

  setInterval(function () {
    if (n < loopLength) {
      var newPlaceholder = placeHolder[n];
      n++;
      $("#events_search").attr("placeholder", newPlaceholder);
    } else {
      $("#events_search").attr("placeholder", placeHolder[0]);
      n = 0;
    }
  }, 2000);

  // search in organisers table
  $("#organisers_search").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#organisers_table_body tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  //  delete event confirmation
  $(".delete_event").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text:
        "All event data will be deleted including any generated certificates!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Delete Event",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  //  delete organiser confirmation
  $(".delete_organiser").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected organiser will be deleted",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Delete Organiser",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  //  delete user confirmation
  $(".delete_user").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected user will be deleted",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Delete User",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete single guest confirmation
  $(".btn-del-single-guest").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected guest will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete Guest",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete all guests confirmation
  $(".btn-del-all-guests").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "All guests will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete All Guests",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete all internal winners confirmation
  $(".btn-del-all-internal-winners").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "All internal winners will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete All Internal Winners",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete single internal winner confirmation
  $(".btn-del-single-internal-winner").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected internal winner will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete Internal Winner",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete all external winners confirmation
  $(".btn-del-all-external-winners").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "All external winners will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete All External Winners",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete single external winner confirmation
  $(".btn-del-single-external-winner").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected external winner will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete External Winner",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete all external participants confirmation
  $(".btn-del-all-external-participants").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "All external participants will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete All External Participants",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete single external participant confirmation
  $(".btn-del-single-external-participant").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected external participant will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete External Participant",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete all internal participants confirmation
  $(".btn-del-all-internal-participants").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "All internal participants will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete All Internal Participants",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // delete single internal participant confirmation
  $(".btn-del-single-internal-participant").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
      icon: "warning",
      title: "Are you sure?",
      text: "Selected internal participant will be deleted!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Delete Internal Participant",
    }).then((result) => {
      if (result.value) {
        $("#loading-loader").css("display", "block");
        document.location.href = href;
      }
    });
  });

  // loader on certificate generation
  $(".generate_btn").click(function () {
    $("#generating-certificate-loader").css("display", "block");
  });
  // loader on sending mails
  $(".send_mail_btn").click(function () {
    $("#sending-mail-loader").css("display", "block");
  });
  // loader on other button clicks
  $(".loading_btn").click(function () {
    $("#loading-loader").css("display", "block");
  });

  // capitalize input on keyup
  $(".capitalize").keyup(function () {
    $(this).val($(this).val().toUpperCase());
  });

  // lower case input on keyup
  $(".lowercase").keyup(function () {
    $(this).val($(this).val().toLowerCase());
  });
});
