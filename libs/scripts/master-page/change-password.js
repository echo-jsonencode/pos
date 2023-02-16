$(document).ready(function () {
    $('.btn').click(function (event) {
        event.preventDefault()
    })
});

const ChangePassword = (() => {
    const thisChangePassword = {};
    
    
    thisChangePassword.confirm = () => {
        // const password = $('#txt_password').val();
        // const oldpassword = $('#txt_oldpassword').val();
        const password = $('#txt_password').val();
        const oldpass = $('#txt_oldpassword').val();
        const newpassword = $('#txt_newpassword').val();
        const confirm_password = $('#txt_confirm_password').val();

        
        
        if(oldpass == "" || confirm_password == ""|| newpassword=="") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillout all fields',
                showConfirmButton: true,
            })
        }
        else if(password != oldpass) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Old Password is incorrect',
                showConfirmButton: true,
            })
        }
        else if(newpassword == oldpass) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Old and new password is the same',
                showConfirmButton: true,
            })
        }  
        else if(newpassword != confirm_password) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Password Did not match',
                showConfirmButton: true,
            })
        }
        else {
            $.ajax({
                type: "POST",
                url: USER_CONTROLLER + '?action=changePassword',
                dataType: "json",
                data:{
                    password: newpassword
                },
                success: function (response) 
                {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Password successfully Changed',
                        showConfirmButton: true,
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location.href = `http://localhost/pos/views/master-page/home.php`;
                        }
                    });
                },
                error: function () {
    
                }
            });
        }
    }

    return thisChangePassword;
})();