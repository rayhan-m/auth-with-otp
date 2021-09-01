$("#phone_no").on("keyup", function() {
    console.log("yes");
    let phone_no = $("#phone_no").val();

    if (phone_no == "") {
        $(".phone-message").text("Please fill the mobile number");
        flag = 1;
    } else {
        if (phone_no.length != 11) {
            $(".phone-message").text("The mobile number must be 11 digits");
            flag = 1;
        } else {
            const phone = phone_no;
            const regex = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            const found = phone.match(regex);
            if (found == null) {
                $(".phone-message").text(
                    "Invalid phone number, Please follow this format 017xxxxxxxx"
                );
                flag = 1;
            } else {
                $(".phone-message").empty();
            }
        }
    }
});
$("#phone_no_edit").on("keyup", function() {
    console.log("yes");
    let phone_no = $("#phone_no").val();

    if (phone_no == "") {
        $(".phone-message_edit").text("Please fill the mobile number");
        flag = 1;
    } else {
        if (phone_no.length != 11) {
            $(".phone-message_edit").text(
                "The mobile number must be 11 digits"
            );
            flag = 1;
        } else {
            const phone = phone_no;
            const regex = /^(?:\+88|88)?(01[3-9]\d{8})$/;
            const found = phone.match(regex);
            if (found == null) {
                $(".phone-message_edit").text(
                    "Invalid phone number, Please follow this format 017xxxxxxxx"
                );
                flag = 1;
            } else {
                $(".phone-message_edit").empty();
            }
        }
    }
});