
// thanh toan paypal 
    


     
     paypal.Button.render({
         
    // Configure environment
    env: 'sandbox',
    client: {
    sandbox: 'AR0-W4Erl8qG5RQLDy4y3PUxpzCAj2gTdpJLKb2EEC5LBmXYITh0vzavQvxxRLSYWKZpYDzY05uaOE7Q',
    production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
    size: 'small',
    color: 'gold',
    shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {

      if (!validateForm()) {
        // Show an error message
        alert('Please fill in all required fields before proceeding with the payment.');
        return false; // Prevent the payment creation
      }
        // lấy total price để thanh toán paypal
        var shippingFee = $('#shippingFee').val();
        var total = $('#getsubtotal').val();
        var usd = (parseFloat(shippingFee) + parseFloat(total)) / 1;
    
  //   var usd = document.getElementById("vn_to_usd").value;    
    return actions.payment.create({
        transactions: [{
        amount: {
          total: usd.toFixed(2),
            currency: 'USD'
        }
        }]
    });
    },

    // Execute the payment
    onAuthorize: function(data, actions) {
    return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      //   auto confirm order after finish payment
      document.getElementById("confirm-button").click();// Auto-submit the form
    });
  }       
}, '#paypal-button');



function validateForm() {
  // Perform your form validation checks here
  // Return true if the form is valid, false otherwise
  var isFormValid = true;
  
  // Example validation check for a radio button
  if (!$('input[name="shipping"]').is(':checked')) {
    isFormValid = false;
  }
  
  return isFormValid;
}

