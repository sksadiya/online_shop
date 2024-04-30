@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item">Payment</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="login-form">
                <form role="form" action="{{ route('stripe.post') }}" method="post" id="payment-form">
                    @csrf
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label>
                            <input class='form-control' size='4' type='text' name="name_on_card">
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Card Number</label>
                            <div id="card-number" class="form-control"></div>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Exp Month</label>
                            <div id="card-expiry-month" class="form-control"></div>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Exp Year</label>
                            <div id="card-expiry-year" class="form-control"></div>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try again.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button id="card-button" class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        // Initialize Stripe.js
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-number` div
        card.mount('#card-number');

        // Add event listener to handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Disable the submit button to prevent multiple submissions
            document.getElementById('card-button').disabled = true;

            // Create payment method using the card Element
            stripe.createPaymentMethod({
                type: 'card',
                card: card,
                billing_details: {
                    name: document.querySelector('input[name=name_on_card]').value
                }
            }).then(function (result) {
                if (result.error) {
                    // Show error to the customer
                    showError(result.error.message);
                } else {
                    // Send paymentMethod.id to your server
                    stripeTokenHandler(result.paymentMethod.id);
                }
            });
        });

        // Function to handle the token and submit form to the server
        function stripeTokenHandler(paymentMethod) {
            // Add paymentMethod as hidden input to the form
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripePaymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

        // Function to display error message
        function showError(errorMsgText) {
            var errorDiv = document.createElement('div');
            errorDiv.classList.add('alert', 'alert-danger');
            errorDiv.textContent = errorMsgText;
            var errorContainer = document.querySelector('.error');
            errorContainer.appendChild(errorDiv);
            setTimeout(function () {
                errorContainer.removeChild(errorDiv);
            }, 5000);
            // Enable the submit button
            document.getElementById('card-button').disabled = false;
        }
    </script>
@endsection
