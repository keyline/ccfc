<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Forwarding to secure payment provider</title>
        <style>
            .text-center {
                text-align: center;
            }

            .mt-2 {
                margin-top: 2em;
            }

            .spinner {
                margin: 100px auto 0;
                width: 70px;
                text-align: center;
            }

            .spinner > div {
                width: 18px;
                height: 18px;
                background-color: #333;
                border-radius: 100%;
                display: inline-block;
                -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
                animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            }

            .spinner .bounce1 {
                -webkit-animation-delay: -0.32s;
                animation-delay: -0.32s;
            }

            .spinner .bounce2 {
                -webkit-animation-delay: -0.16s;
                animation-delay: -0.16s;
            }

            @-webkit-keyframes sk-bouncedelay {
                0%, 80%, 100% { -webkit-transform: scale(0) }
                40% { -webkit-transform: scale(1.0) }
            }

            @keyframes sk-bouncedelay {
                0%, 80%, 100% {
                    -webkit-transform: scale(0);
                    transform: scale(0);
                } 40% {
                      -webkit-transform: scale(1.0);
                      transform: scale(1.0);
                  }
            }
        </style>
    </head>
    <body onload="submitForm();">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <form class="text-center mt-2" method="POST" action="{{ route('member.axisstatus') }}">
        @csrf
            <p>Forwarding to secure payment provider.</p>
            <p>
                If you are not automatically redirected to the payment website with in
                <span id="countdown">10</span>
                seconds...
            </p>

            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="{{ $order->amount }}"
                data-currency="{{ $order->currency }}"
                data-order_id="{{ $order->id }}"
                data-buttontext="Pay Now"
                data-name="CALCUTTA CRICKET & FOOTBALL CLUB"
                data-description=""
                data-image="{{ asset('img/logo.png') }}"
                data-prefill.name="{{ $order->notes->name }}"
                data-prefill.email="{{ $order->notes->email }}"
                data-prefill.contact="{{ $order->notes->contact }}"
                data-theme.color="#F37254"
            ></script>
            

            <button type="submit" id="axis-pay">Click here</button>
        </form>
        <script>
            // Total seconds to wait
            var seconds = 100;

            function submitForm() {
                //document.forms[0].submit();
                document.getElementById("axis-pay").click();
            }

            function countdown() {
                seconds = seconds - 1;
                if (seconds <= 0) {
                    // submit the form
                    //submitForm();
                    document.getElementById("axis-pay").click();
                } else {
                    // Update remaining seconds
                    document.getElementById("countdown").innerHTML = seconds;
                    // Count down using javascript
                    window.setTimeout("countdown()", 1000);
                }
            }

            // Run countdown function
            countdown();
        </script>
    </body>
</html>