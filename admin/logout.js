$(function(){
    $('.logout').on('click', function(){
        $.post('logout.php', {logout: '1'}, function(){
           location.reload();
        });
    });
});
