$(document).ready(function () {
    $('.btn').click(function (event) {
        event.preventDefault()
    })
});


const Admin = (() => {
    const thisAdmin = {};

    thisAdmin.clickDelete = () => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User Successfully Deleted',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }

    return thisAdmin;
})();