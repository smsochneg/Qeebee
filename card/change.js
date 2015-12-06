$(function(){
    var btn = $('.add');
    $(btn).on('click', function(){
        var id = parseInt($(this).val());                         //we take id of product
        var count = parseInt($('#add'+id).val());                 //and it's count
        if(isNaN(count)) return false;
        (count < 0) ? (count = 0) : true;
        $.ajax({
            url: 'card/changeCard.php',                  //send it
            type: 'POST',
            data: ({add: id, count: count}),
            dataType: 'html',
            success: success
        });
        function success(data){
            if(data = JSON.parse(data)) {                    //after success we parse json from php
                var oldCount = $('.count-of-products'), oldCost = $('.cost-of-products');   //take DOM of fields of our card
                $(oldCount).html(parseInt(data['count']));                          //add a new value
                $(oldCost).html(parseInt(data['cost']));                             //  -//-
            }
        }
    });

    var del = $('.delete');
    $(del).on('click', function(){
        var id = parseInt($(this).val());                         //we take id of product
        $.post('card/deleteProduct.php', {id: id}, function(data){
            if(data = JSON.parse(data)){
                data = data['session'];
                $('.card-full #' + id).remove();
                var oldCount = $('.count-of-products'), oldCost = $('.cost-of-products');   //take DOM of fields of our card
                var count = parseInt($(oldCount).html()), cost = parseInt($(oldCost).html());//we're parsing numbers from them
                $(oldCount).html(parseInt(data['count']));                          //add a new value
                $(oldCost).html(parseInt(data['cost']));
                if(data['card'] == null) {
                    $('.card-full').html('You don\'t have products in your card!');
                }
            }

        });

    });
});