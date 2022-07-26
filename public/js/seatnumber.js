$(document).ready(function () {
  $(document).on("click", "#getDataFromSeatNumber", function () {
    $("#records_table").empty();
    // console.log("edit Staff");return;
    var edit_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "/seatnumber_edit/" + edit_id,
      success: function (response) {
        var trHTML = "";
        var cls = "";
        $.each(response.data, function (i, item) {
          // if (item.active == 0) {
          if (item.user_id == 0) {
            cls = "";
          } else {
            cls = "background-color:red";
          }
          trHTML += `<tr style="${cls}"><td>
            ${item.id}
            </td><td>${item.seat_no}</td><td>${item.batch_time}</td><td>${item.active}</td><td>
            ${item.user_id}
            </td><td><button id='deactive_data' value='${item.id}'>Edit</button></td></tr>`;
          // }
        });
        $("#records_table").append(trHTML);
      },
    });
  });

  $(document).on("click", "#deactive_data", function () {
    // console.log("edit Staff");    return;
    var edit_id = $(this).val();
    // console.log(edit_id);    return;
    $.ajax({
      type: "GET",
      url: "/seatnumber_deactive/" + edit_id,
      success: function (response) {},
    });
  });
});
