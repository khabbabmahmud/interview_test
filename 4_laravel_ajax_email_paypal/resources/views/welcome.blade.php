<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <body>

  <div class="container">
        <div class="row">
            <div class="col-md-12 my-4 col-md-4">
                <h2>Laravel Send Money via <i>PayPal</i> </h2>

                    <div class="form-group col-md-4 my-3">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" name="name" id="name" >
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" >
                    </div>

                    <div class="form-group col-md-4 my-3">
                        <label for="amount">Amount to pay (in USD)</label>
                        <input type="text" class="form-control" name="amount" id="amount" >
                    </div>
                    
                    <div id="paypal-button-container" class="col-md-4"></div>
            </div>
        </div>
    </div>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYWUOPStiFyjtfR67aURpJzNB5896TM4Ucqhj6L9hMqON6jaN61uQ6EtxiINkGFbNOATg3reCw1cFJQy&currency=USD"></script>

    <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {

return actions.order.create({

  intent: 'CAPTURE',

  purchase_units: [{

    amount: {

      currency_code: 'USD',

      value: '220.00'

    },

    payee: {

      email_address: 'receiveraccount@emaildomain.com'

    }

  }]

});

},

        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {

            // Successful capture! For dev/demo purposes:

            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            const transaction = orderData.purchase_units[0].payments.captures[0];

            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

            // When ready to go live, remove the alert and show a success message within this page. For example:

            // element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');

          });
        }
      }).render('#paypal-button-container');

    </script>
  </body>
</html>
