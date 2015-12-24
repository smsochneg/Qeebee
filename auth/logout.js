$(function(){
    var btn = $('.logout');
    $(btn).on('click', function(){
        $.get('./login.php', {action: 'logout'}, function(){ //clicking on button logouts us 
            location.reload();
        });
    });
});