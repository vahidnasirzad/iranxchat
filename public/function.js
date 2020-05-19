// Code By Webdevtrick ( https://webdevtrick.com )
$('.button').click(function(){
    var $btn = $(this),
        $step = $btn.parents('.modal-body'),
        stepIndex = $step.index(),
        $pag = $('.header span').eq(stepIndex);


//narini toosh
    if(stepIndex === 0) {
        step1($step, $pag);
    }


    else if(stepIndex === 1){

         if(validate() == true){
             step1($step, $pag);
         }else{
            //alert(sss);
         }
    }

    else {
        step3($step, $pag);
    }

});
    $("#email").change(function(){
        let email = document.forms["myform"]["email"].value;
        $.get("http://127.0.0.1:8000/checkemail",{
            email
        },function(res){
            if (res == "notok"){
                    swal.fire({
                         icon: 'error',
                         title: 'This Email already used'
                     })
                document.querySelector('#email').value = "";
                return false;
            }
            else if (res == 'ok'){
                return true;
            }

        });
    });$("#username").change(function(){
        let username = document.forms["myform"]["username"].value;
        $.get("http://127.0.0.1:8000/checkusername",{
            username
        },function(res){
            if (res == "notok"){
                    swal.fire({
                         icon: 'error',
                         title: 'This USERNAME already Taken'
                     })
                document.querySelector('#username').value = "";
                return false;
            }
            else if (res == 'ok'){
                return true;
            }

        });
    });

function ValidateEmail(mail)
{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myform.email.value))
    {
        return (true);
    }
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'error',
        title: 'invalid Email'
    })
    return (false);
}


function validate() {
    var username = document.forms["myform"]["username"].value;
    var email = document.forms["myform"]["email"].value;
    var password = document.forms["myform"]["password"].value;
    var cpassword = document.forms["myform"]["cpassword"].value;
    var mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (username === "" || username === null || password === "" || email === "") {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'error',
            title: 'All Field Required!!!'
        });
        return false;}
    else if ( ValidateEmail() == false) {
        return false}
    else if ( password !== cpassword) {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'error',
            title: 'Password Not Match!!!'
        });
            return false;
    }else{
        //alert("salam gol");
        return true;
    }
}


function step1($step, $pag){
    //console.log('step1');
    // animate the step out
    $step.addClass('animate-out');

    // animate the step in
    setTimeout(function(){
        $step.removeClass('animate-out is-showing')
            .next().addClass('animate-in');
        $pag.removeClass('active')
            .next().addClass('active');
    }, 600);

    // after the animation, adjust the classes
    setTimeout(function(){
        $step.next().removeClass('animate-in')
            .addClass('is-showing');

    }, 1200);
}


function step3($step, $pag){
    //console.log('3');

    // animate the step out
    $step.parents('.container1').addClass('animate-out');
    $step.parents('.container1').fadeOut('6000');

    setTimeout(function(){
        $('.reStart').fadeIn('slow').css('display', 'inline-block');
    }, 500);
}




$('.reStart').click(function(){
    $('.container1').removeClass('animate-up')
        .find('.modal-body')
        .first().addClass('is-showing')
        .siblings().removeClass('is-showing');

    $('.header span').first().addClass('active')
        .siblings().removeClass('active');
    $(this).hide();
});
