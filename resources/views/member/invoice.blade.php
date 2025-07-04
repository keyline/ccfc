<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ?php include 'assets/inc/header.php';?> -->

    <!-- header -->
    @include('common.home_header')
    <!-- ********|| RIGHT PART START ||******** -->

    <div class="col-lg-9 col-md-7 p-0">
        <div class="right-body">
            <!-- ********|| BANNER PART START ||******** -->
            <section class="banner">

                <div class="banner-box">

                    <div id="innerpage-banner" class="owl-carousel owl-theme">

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" />

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| HISTORY START ||******** -->
            <section class="inner_belowbanner invoice_section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">

                            <div class="row">
                                

                                <div class="col-lg-4 col-md-5">
                                    <!-- <div class="member_profileimg">
                                        <img class="img-fluid" src="{{ asset('img/demopic.png') }}" alt="" />
                                    </div> -->

                                    @if($userData->userCodeUserDetails[0]['member_image'] == '')


                                    <div class="member_profileimg">
                                        <img class="img-fluid ifnotpic" src="{{ asset('img/Profile-Icon-01.svg') }}"
                                            alt="" />
                                    </div>

                                    @else


                                    <div class="member_profileimg">
                                        <img class="img-fluid" src="data:image/png;base64,                          
                                        {{ $userData->userCodeUserDetails[0]->member_image}} " alt="" />
                                    </div>


                                    @endif


                                </div>
                                <div class="col-lg-8 col-md-7">
                                    <div class="member_profiletop">
                                        <h4>Welcome</h4>
                                        <h2>{{ $userData->name}}</h2>

                                        <p><strong>Ph No:</strong>{{ $userData->userCodeUserDetails[0]->mobile_no }}
                                        </p>
                                        <p><strong>Mail ID:</strong>{{ $userData->email}}
                                        </p>
                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="col-md-12 col-lg-6">
                            <div class="invoicepayment_section">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                                @foreach($userTransactions as $user)
                                
                                @if($loop->first)
                                <h3>Total current outstanding : INR. {{ $user['Balance'] }}</h3>
                                @endif
                                @endforeach
                                <p>(As of last usage 24 hours ago as updated from club servers)</p>
                                
                                <div class="invoice_outstading_payment">
									<form action="" method="POST" id="payment-form">                                        
                                        @csrf
										<div class="invoice_input_bank">
											<div class="invocie_paymentlogo">
												<ul>
													<li>
														<input class="form-check-input" type="radio" name="paymentGatewayOptions" id="exampleRadios1" value="{{ route('member.payment')}}">
														<label class="form-check-label" for="exampleRadios1">
															 <img class="img-fluid" src="{{ asset('img/invoice_payu_logo.png') }}" alt="" />
														</label>
													</li>
													<li>
														<input class="form-check-input" type="radio" name="paymentGatewayOptions" id="exampleRadios2" value="{{ route('member.paywithhdfc')}}">
														<label class="form-check-label" for="exampleRadio2">
															 <img class="img-fluid" src="{{ asset('img/invoice_hdfc_logo.jpg') }}" alt="" />
														</label>
													</li>
													<li>
														<input class="form-check-input" type="radio" name="paymentGatewayOptions" id="exampleRadios3" value="{{ route('member.axischeckout')}}">
														<label class="form-check-label" for="exampleRadios3">
															 <img class="img-fluid" src="{{ asset('img/invoice_axis_logo.jpg') }}" alt="" />
														</label>
													</li>
                                                    <li>
														<input class="form-check-input" type="radio" name="paymentGatewayOptions" id="exampleRadios4" onclick="razorpaySubmit(this);">
														<label class="form-check-label" for="exampleRadios4">
															 <img class="img-fluid" src="{{ asset('img/invoice_razorpay_logo.jpg') }}" alt="" />
														</label>
													</li>
												</ul>
											</div>
											<div class="invoice_input_feild">
												<input type="text" name="amount" placeholder="Enter amount being paid">
												<button type="submit" class="btn btn-primary">Pay Now</button>
											</div>
<!--
											<div class="invoice_btn_bank">
												<button type="submit" class="pg-btns" data-provider="payu" data-href="{{ route('member.payment') }}">Pay Now (PayU)</button>
												<button type="submit" class="pg-btns" data-provider="hdfc" data-href="{{ route('member.paywithhdfc') }}">Pay Now (HDFC)</button>
												<button type="submit" class="pg-btns" data-provider="axis" data-href="{{ route('member.axischeckout') }}">Pay Now (AxisPG)</button>
											</div>
-->	
                                        <pre id="log"></pre>
										</div>
									</form>
								</div>

        <script type="text/javascript">
     
    const form = document.getElementById("payment-form");
    const log = document.querySelector("#log");

    form.addEventListener(
        "submit",
        (event) => {
            debugger;
            event.preventDefault();
            let errorMsg = new Array();
            let messageHtml = "";
            const data = new FormData(form);
            let amountInput = data.get('amount');
            let route = getCheckedPG('paymentGatewayOptions');
            //console.log(typeof(route));
            if (route === null ) {
                errorMsg.push("Please check one of payment gateway before making payment");
            }
            //console.log(checkAmount(amountInput));
            if (! checkAmount(amountInput)) {
                errorMsg.push("Amount not valid!");
            }

            if(Array.isArray(errorMsg) && !errorMsg.length){
                form.action= route;
                form.submit();
            }

            errorMsg.forEach(function (message) {
                 messageHtml += "<li>" + message + "</li>";
            });

            log.innerHTML = messageHtml;
            
            
            
        },
        false
    );


function getCheckedPG(groupName) {
    
    var radios = document.getElementsByName(groupName);
    for (i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return radios[i].value;
        }
    }
    return null;
}

function checkAmount(amount) {
    
    //const amountRegex = /^(?!0)\d+$/;
    const amountRegex =/^\d+(\.\d{1,2})?$/;
    return amountRegex.test(amount);
}
            </script>                                                 
            </div>
            </div>
        </section>

        <section class="member_details_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pl-0">
                        <div class="table-responsive">

                            <!-- <pre><code>{{ json_encode($userTransactions, JSON_PRETTY_PRINT) }}</code></pre> -->


                            <table class="table table-hover table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Month</th>
                                        <th scope="col">Opening Balance</th>
                                        <th scope="col">Total of receipts & Adjustment</th>
                                        <th scope="col">Total of Invoice & Adjustment</th>
                                        <th scope="col">Closing Balance</th>
                                        <th scope="col">View Summarized bill</th>
                                        <th scope="col">View Detailed bill</th>
                                        <!-- <th scope="col">Status</th> -->
                                    </tr>
                                </thead>
                                @foreach($userTransactions as $user)
                                <tbody>
                                    <tr>
                                        <td>{{ $user['Month'] }}</td>
                                        <td>{{ $user['LastBalance'] }}</td>
                                        <td>{{ $user['paidamount'] }}</td>
                                        <td>{{ $user['debitamount'] }}</td>
                                        <td>{{ $user['Balance'] }}</td>
                                        <!-- summary -->
                                        <td>
                                            @if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ",
                                            $user['Month']))) &&
                                            !empty(SearchInvoicePdf::getSummaryBillLink($userData['user_code'],
                                            $user['Month'])))

                                            <a href="{{ SearchInvoicePdf::getSummaryBillLink($userData['user_code'],  $user['Month']) }}"
                                                target="_blank"><img class="img-fluid"
                                                    src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a>
                                            @else
                                            <span>&#8211;</span>
                                            @endif
                                        </td>
                                        <!-- Detail -->
                                        <td>
                                            @if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ",
                                            $user['Month']))) &&
                                            !empty(SearchInvoicePdf::getDetailBillLink($userData['user_code'],
                                            $user['Month'])))
                                            <a href="{{ SearchInvoicePdf::getDetailBillLink($userData['user_code'],  $user['Month']) }}"
                                                target="_blank"><img class="img-fluid"
                                                    src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a>
                                        </td>
                                        @else
                                        <span>&#8211;</span>
                                        @endif
                                        <!-- <td>Payment</td> -->
                                    </tr>
                                    <!-- <tr>
                                            <td>Jan 2022</td>
                                            <td>10773.82</td>
                                            <td>11827.59</td>
                                            <td>6106</td>
                                            <td>11826.96</td>
                                            <td><a href="#" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a></td>
                                            <td><a href="#" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a></td>
                                            <td>Payment</td>
                                        </tr>
                                        <tr>
                                            <td>Dec 2021</td>
                                            <td>7954.72</td>
                                            <td>11827.59</td>
                                            <td>6106</td>
                                            <td>11826.96</td>
                                            <td><a href="#" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a></td>
                                            <td><a href="#" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a></td>
                                            <td>Payment</td>
                                        </tr> -->
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>





            </div>
        </section>
        <!-- ********|| HISTORY END ||******** -->




        @include('common.footer')
        
        <!-- ?php include 'assets/inc/footer.php';?> -->


        </body>

</html>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "<?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>