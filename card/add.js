$(function(){
    var btn = $('.add');
    $(btn).on('click', function(){
        var id = $(this).val();                         //we take id of product
        var count = $('#add'+id).val();                 //and it's count
        $.ajax({
            url: 'card/addToCard.php',                  //send it
            type: 'POST',
            data: ({add: id, count: count}),
            dataType: 'html',
            success: success
        });
        function success(data){
            data = JSON.parse(data);                    //after success we parse json from php
            var oldCount = $('.count-of-products'), oldCost = $('.cost-of-products');   //take DOM of fields of our card
            var count = parseInt($(oldCount).html()), cost = parseInt($(oldCost).html());//we're parsing numbers from them
            $(oldCount).html(count + parseInt(data['count']));                          //add a new value
            $(oldCost).html(cost + parseInt(data['cost']));                             //  -//-
        }
    });
});