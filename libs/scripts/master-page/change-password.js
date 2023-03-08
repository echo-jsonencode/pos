$(document).ready(function () {
    $('.btn').click(function (event) {
        event.preventDefault()
    })
});



const validation = () =>{
    const passPattern = /(?=^.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W_])(?=^.*[^\s].*$).*$/;



if (document.getElementById('txt_newpassword').value.match(passPattern)){
        document.getElementById('mess').innerHTML='Valid';
        document.getElementById('mess').style.color = 'green';
        document.getElementById('btn_save').disabled=false;
        // return validation;
        // return true;
        }
        else {
        document.getElementById('mess').innerHTML="Your password must contain at least six characters, an uppercase, lowercase, special character, and number";
        document.getElementById('mess').style.color = 'red';
        document.getElementById('btn_save').disabled=true;
        // return thisChangePassword.preventDefault();
        }

    }




const ChangePassword = (() => {
    const thisChangePassword = {};
    
    thisChangePassword.confirm = () => {
        const dboldpass = $('#old_password').val();
        const oldpass = $('#txt_oldpassword').val();
        const newpassword = $('#txt_newpassword').val();
        const confirm_password = $('#txt_confirm_password').val();
        console.log(dboldpass);



            
        if(oldpass == "" || confirm_password == ""|| newpassword=="") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please fillout all fields',
                showConfirmButton: true,
            })
        }
        else if(dboldpass != oldpass) {
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
                            window.location.href = `http://localhost/pos/views/master-page/login.php`;
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


