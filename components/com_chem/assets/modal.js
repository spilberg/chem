/**
 * Created by Tan on 17.02.2016.
 */

$(document).ready(function(){

    $('#btnSndReq').on('click',function(e){
        //alert("The paragraph was clicked.");
       $('.wrapper').css('display','block');
       $('.form-action').css('display','block');
        e.preventDefault();
    });

    $('.close').on('click',function(e){
        $('.wrapper').css('display','none');
        $('.form-action').css('display','none');
        e.preventDefault();
    });

    $('#btnSubmit').on('click', function(e){

        if(checkForm()){

            $.ajax({
                type: 'POST',
                url: "/?option=com_chem&task=sendrequest",
                data: $('#reqform').serialize(),
                success: function(result){
                    $('#res').html(result);
                    $('.close').click();
                    $('#reqform').trigger('reset');
                    //$('.form-action').hide('slow');
                    //$('.wrapper').hide('slow');
                }
            });
        }

        e.preventDefault();
    });



});

function  checkForm(){
    var name = $('#name');
    var email = $('#email');
    var keystring = $('#keystring');
    var errormsg = $('#errormsg');

    if(name.val().length == 0){
        name.attr('class', 'border_red');
        errormsg.html('Please enter all required fields');
        return false;
    } else {
        name.attr('class', '');
        errormsg.html('&nbsp;');
    }

    if(email.val().length == 0){
        email.attr('class', 'border_red');
        errormsg.html('Please enter all required fields');
        return false;
    } else {
        email.attr('class', '');
        errormsg.html('&nbsp;');
    }

    if(keystring.val().length == 0){
        keystring.attr('class', 'border_red');
        errormsg.html('Please enter all required fields');
        return false;
    } else {
        keystring.attr('class', '');
        errormsg.html('&nbsp;');
    }

    return true;

}
