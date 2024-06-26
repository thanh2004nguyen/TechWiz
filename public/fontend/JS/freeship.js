$('input[name="shipping"]').change(function() {
    var shippingFee = parseFloat($('#shippingFee').val());
    var FreeShip = - shippingFee;
    var total = parseFloat($('#total').text()); 
    var discountValue = parseFloat($('#discountValue').text());
  
  
    if (this.value === 'Free_Ship') {
        // alert(discountValue);
        var subtotal =shippingFee + total+FreeShip +discountValue;
       
        $('#Freeshipping').text(FreeShip);
        if(subtotal<0)
        {
            $('#totalValue').text(0);
        }
        if(subtotal>0)
        {
             $('#totalValue').text(subtotal);
  
        }
       

    }
    else if(this.value === 'High_Speed_delivery'){
        $('#Freeshipping').text(0);
        var subtotal =shippingFee + total +discountValue;
        if(subtotal<0)
        {
            $('#totalValue').text(0);
        }
        if(subtotal>0)
        {
             $('#totalValue').text(subtotal);
  
        }
       

    }



});