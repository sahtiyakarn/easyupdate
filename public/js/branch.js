
$(document).ready(function () {
    $('#branch_state').on('change', function () {
        var state_name = this.value;
        // console.log(state_name); return;
        $.ajax({
            type: 'GET',
            url: '/getdistrict/' + btoa(state_name),
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('select[name="branch_district"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="branch_district"]').append(
                        '<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });

    $(document).on('click', '#editBranch', function () {
        // console.log("edit work");
        var edit_id = $(this).val();
        // console.log(edit_id); return;
        $.ajax({
            type: "GET",
            url: "/branch_edit/" + edit_id,
            success: function (response) {
                // console.log(response);
                $('#edit_id').val(response.adminname.id);
                $('#branch_admin_name').val(response.adminname.name);
                $('#branch_email').val(response.adminname.email);
                $('#branch_name').val(response.adminname.branch_name);
                $('#branch_address').val(response.adminname.address);
                $('#branch_contact').val(response.adminname.contact);
                document.getElementById('branch_type').value = response.adminname.branch_type;
                document.getElementById('branch_state_edit').value = response.adminname.state;
                document.getElementById('branch_district_edit').value = response.adminname.district;
                // console.log(APP_URL + "/branch_profile_photo/" + response.adminname.profile_photo);
                document.getElementById('branch_profile_photo_show').src = APP_URL + "/admin_profile_photo/" + response.adminname.profile_photo;

            }
        });
    });

    $('#branch_state_edit').on('change', function () {
        var state_name = this.value;
        $.ajax({
            type: 'GET',
            url: '/getdistrict/' + btoa(state_name),
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('select[name="branch_district_edit"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="branch_district_edit"]').append(
                        '<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });
});