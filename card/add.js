$(function(){
    var btn = $('.add');
    $(btn).on('click', function(){
        var id = parseInt($(this).val());                         //we take id of product
        var count = parseInt($('#add'+id).val());                 //and it's count
        if(isNaN(count)) return false;
        (count < 0) ? (count = 0) : true;
        $.ajax({
            url: 'card/addToCard.php',                  //send it
            type: 'POST',
            data: ({add: id, count: count}),
            dataType: 'html',
            success: success
        });
        function success(data){
            if(data = JSON.parse(data)) {                    //after success we parse json from php
                var oldCount = $('.count-of-products'), oldCost = $('.cost-of-products');   //take DOM of fields of our card
                var count = parseInt($(oldCount).html()), cost = parseInt($(oldCost).html());//we're parsing numbers from them
                $(oldCount).html(count + parseInt(data['count']));                          //add a new value
                $(oldCost).html(cost + parseInt(data['cost']));                             //  -//-
            }
        }
    });
});