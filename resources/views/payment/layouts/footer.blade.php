<script type=''>
    $(function () {
        var overlay = $('<div id="overlay"></div>');
        overlay.show();
        overlay.appendTo(document.body);
        $('.popup').show();
        $('.btn').click(function () {
            var balance = $("input[name='balance']:checked").val();
            var quantity = $("input[name='quantity']").val();
            if(!balance){
                $(".error_balance").html('Please select the amount.');
            }else{
                if(balance == 0 && quantity == ''){
                    $(".error_balance").html('Invalid amount');
                }else{ 
                  

                    if(balance == 0){
                        var selected_amount = quantity;
                    }else{
                         var selected_amount = balance;
                    }

                    $(".selected_amount").html(selected_amount);
                    $('.popup').hide();
                    overlay.appendTo(document.body).remove();
                }
            }
            
            return false;
        });

        $('.x').click(function () {
            $('.popup').hide();
            overlay.appendTo(document.body).remove();
            return false;
        });
    });
</script>


