//.......................staff details.............................

$(document).ready(function () {
    $('#staff_state').on('change', function () {
        var state_name = this.value;
        // console.log(state_name); return;
        $.ajax({
            type: 'GET',
            url: '/getdistrict/' + btoa(state_name),
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('select[name="staff_district"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="staff_district"]').append(
                        '<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });

    $(document).on('click', '#editStaff', function () {
        console.log("edit Staff");
        var edit_id = $(this).val();
        // console.log(edit_id); return;
        $.ajax({
            type: "GET",
            url: "/staff_edit/" + edit_id,
            success: function (response) {
                console.log(response);
                $('#edit_id').val(response.adminname.id);
                $('#staff_admin_name1').val(response.adminname.name);
                $('#staff_email1').val(response.adminname.email);
                $('#staff_address').val(response.adminname.address);
                $('#staff_contact').val(response.adminname.contact);
                document.getElementById('staff_state_edit').value = response.adminname.state;
                document.getElementById('staff_district_edit').value = response.adminname.district;
                document.getElementById('staff_profile_photo_show').src = APP_URL + "/admin_profile_photo/" + response.adminname.profile_photo;

            }
        });
    });

    $('#staff_state_edit').on('change', function () {
        var state_name = this.value;
        $.ajax({
            type: 'GET',
            url: '/getdistrict/' + btoa(state_name),
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('select[name="staff_district_edit"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="staff_district_edit"]').append(
                        '<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });

    $("#staff_admin_name").blur(function () {
        $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "/staff_website_return",
            // dataType: "html",   //expect html to be returned                
            success: function (response) {
                // console.log(response);
                // $("#responsecontainer").html(response);
                //alert(response);
                let name = $("#staff_admin_name").val()
                const nameCleaned = name.replace(/\s/g, '')
                let email = nameCleaned + "@" + response;
                $("#staff_email").val(email);
            }

        });

    });
});