// var timer;
// var idleTime = 0;
// idleTimer = null;
// idleWait = 1000000;
// idleState = false;
// $(document).ready(function () {
// //Increment the idle time counter every minute.
// var idleInterval = setInterval(timerIncrement, 90000); // 2000 is equals to 2 seconds

// //Zero the idle timer on mouse movement.
// $(this).mousemove(function (e) {
//     idleTime = 0;
// });
// $(this).keypress(function (e) {
//     idleTime = 0;
// });
// //Zero the idle timer on touch events.
// $(this).bind('touchstart', function(){
// idleTime = 0;
// });
// $(this).bind('touchmove', function(){
// idleTime = 0;
// });
// });

// // idleTimer = setTimeout(function () { 

// //     // Idle Event
// //     $("body").append("<p>You've been idle for " + idleWait/1000 + " seconds.</p>");

//     // idleState = false; }, idleWait);

// function timerIncrement() {
// idleTime = idleTime + 1;
// if (idleTime > 1) { 
//     Swal.fire({
//         position: 'center',
//         title: 'SESSION IS OVER',
//         text: 'You will be logout',
//         icon: 'warning',
//         showConfirmButton: false,
//         // timer: 2000
//     }).then(function() {
//         window.location.href = "../../views/master-page/login.php";
//     });
// }
// }