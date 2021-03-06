$(document).ready(function () {
  // alert("hello");

  $("input").attr("autocomplete", "off");
  //for take automatic in registration
  const registration = $("#student_id").val();
  $("#registration").val("No-" + registration);

  //for take name in Email
  $("#name").blur(function () {
    const name = $("#name").val().replace(/\s/g, "");
    let email = name + $("#id").val() + "@gmail.com";
    $("#email").val(email);
  });

  $("#datatable-responsive").DataTable({
    order: [[0, "desc"]],
  });
  $("input")
    .focus(function () {
      $(this).css("outline", "2px solid #f59b42");
    })
    .blur(function () {
      $(this).css("outline", "1px solid #ccc");
    });
  $("select")
    .focus(function () {
      $(this).css("outline", "2px solid #f59b42");
    })
    .blur(function () {
      $(this).css("outline", "1px solid #ccc");
    });
  $("#admission_date").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "1970:2025",
    // defaultDate: '10/21/2021',
    dateFormat: "dd-M-yy",
  });

  $("#birth_date").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "1999:2016",
    // defaultDate: '10/21/2021',
    dateFormat: "dd-M-yy",
  });

  $("#student_id").blur(function () {
    // alert("hello");
    const registration = $("#student_id").val();
    // let email = name + $("#id").val() + "@gmail.com";
    $("#registration").val("No-" + registration);
  });

  $("#student_name").blur(function () {
    $.ajax({
      //create an ajax request to display.php
      type: "GET",
      url: "/staff_website_return",
      // dataType: "html",   //expect html to be returned
      success: function (response) {
        console.log(response);
        // $("#responsecontainer").html(response);
        //alert(response);
        let name = $("#student_name").val();
        let id = $("#student_id").val();
        const nameCleaned = name.replace(/\s/g, "") + id;
        let email = nameCleaned + response;
        $("#email").val(email);
      },
    });
  });
});

function showSheat() {
  // alert("working");
  current_batch_time = document.getElementById("batch_time").value;
  // console.log(current_batch_time);
  $.ajax({
    type: "GET",
    url: "/admission_batch_time/" + btoa(current_batch_time),
    dataType: "json",
    success: function (data) {
      console.log(data);
      $('select[name="seat_no"]').empty();
      $.each(data, function (key, value) {
        $('select[name="seat_no"]').append(
          '<option value="' + value + '">' + value + "</option>"
        );
      });
    },
  });
}
