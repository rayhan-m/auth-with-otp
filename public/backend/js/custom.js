$('#phone_no').on('keyup', function() {
    let phone_no = $('#phone_no').val();

    if (phone_no == "") {
        $('.phone_no').text('Please fill the mobile number');
        flag = 1;
    } else {
        if (phone_no.length != 11) {
            $('.phone_no').text('The mobile number must be 11 digits');
            flag = 1;
        } else {

            const phone = phone_no;
            const regex = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            const found = phone.match(regex);
            if (found == null) {
                $('.phone_no').text('Invalid phone number, Please follow this format 017xxxxxxxx');
                flag = 1;
            } else {
                $('.phone_no').empty();
            }

        }
    }
});