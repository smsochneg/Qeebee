$(function(){
    var btn = $('.delete');
    $(btn).on('click', function(){
        var value = parseInt($(this).val());
        $('.window').css({visibility: 'visible'});
        $('.yes').on('click', function(){
            $.ajax({
             url: 'delete.php',                  //send it
             type: 'POST',
             data: ({id: value}),
             dataType: 'html',
             success: success
             });
        });
        $('.no').on('click', function(){
            $('.window').css({visibility: 'hidden'});
        });

        function success(){
            $('.window').css({visibility: 'hidden'});
            location.reload();
        };

    });

});
