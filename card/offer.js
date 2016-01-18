$(function(){
    var button = $('.offer');
    $(button).on('click', function(){
        $.ajax({
            url: 'card/offer.php',                  //send it
            success: success
        });


        function success(data){
            data = JSON.parse(data);
            if(data['error'] == 'phone') {
                $('.phone').css({'display': 'block'});
                return;
            }
            $('.card-full').html('Дождитесь звонка! Спасибо, что пользуетесь QeeBee.ru!');
            var oldCount = $('.count-of-products'), oldCost = $('.cost-of-products');   //take DOM of fields of our card
            $(oldCount).html(0);                          //add a new value
            $(oldCost).html(0);
        }
    });
});