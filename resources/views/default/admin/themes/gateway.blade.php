<!DOCTYPE html>
<html>

<head>
    <title>Stripe Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (!empty($_SERVER['HTTPS']))
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-5 col-sm-12" style="margin-top: 10rem;">
                <button id="checkout-buttons" style="display: none;"></button>
                <div class="mb-3">
                    <img src="{{theme_url('/img/brand/logo.png')}}" class="header-brand-img desktop-lgo">
                </div>
                <div class="d-flex justify-content-center">
                    
                    
                    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                    </div>
                </div>                
                <br>
                <p style="margin: auto;" class="font-weight-bold fs-14">{{ __('Secure payment channel is being initiated, do not close the tab. . .') }}</p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe('pk_live_51PpWapLxxkFcPZh2Mb2WalpcI3173jsV0bUGG5rKRnPWlWzNi8nTLPOox2SIwPEZnCH2PrXZL50YDBCMDWaiBSN100C4pAlL6S');
        var checkoutButton = document.getElementById('checkout-buttons');

        checkoutButton.addEventListener('click', function() {
            // Create a new Checkout Session using the server-side endpoint you
            // created in step 3.
            fetch('{{ route('admin.payments.process') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(session) {
                    return stripe.redirectToCheckout({
                        sessionId: session.id
                    });
                })
                .then(function(result) {
                    console.log(result);
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using `error.message`.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });

        document.getElementById("checkout-buttons").click();
    </script>
</body>

</html>