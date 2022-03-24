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
                                    
                                    @if($userProfile['MemberImage'] == '')


                                    <div class="member_profileimg">
                                        <img class="img-fluid" src="{{ asset('img/demopic.png') }}" alt="" />
                                    </div>


                                    @else

                                    <div class="member_profileimg">
                                        <img class="img-fluid" src="data:image/png;base64,                          
                                        {{ $userProfile['MemberImage'] }}" alt="" />
                                    </div>

                                    @endif



                                </div>
                                <div class="col-lg-8 col-md-7">
                                    <div class="member_profiletop">
                                        <h4>Welcome</h4>
                                        <h2>{{ $userProfile['MEMBER_NAME'] }}</h2>
                                        <p><strong>Ph No:</strong>{{ $userProfile['PHONE1'] }} </p>
                                        <p><strong>Mail ID:</strong>{{ $userProfile['EMAIL'] }} </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                            <div class="invoicepayment_section">
                                @foreach($userTransactions as $user)
                                @if($user['Month'] == 'Feb 2022')
                                <h3>Total current outstanding : INR. {{ $user['Balance'] }}</h3>
                                @endif
                                @endforeach
                                <p>(As of last usage 24 hours ago as updated from club servers)</p>
                                <form action="{{ route('member.payment')}}" method="POST">
                                        @csrf
                                <div class="invoicepayment_box">
                                    
                                    <div class="invoicepayment_input">

                                        <input type="text" name="amount" placeholder="Enter amount being paid">
                                    </div>
                                    <div class="invoicepayment_paybtn">
                                        <button type="submit">Pay Now</button>
                                    </div>
                                    </form>

                                </div>

                            </div>
                        </div>

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
                                            <th scope="col">Total of Invoice & Adjustment</th>
                                            <th scope="col">Total of receipts & Adjustment</th>
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
                                            @if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ", $user['Month']))))
                                                                                       
                                            <a href="{{ SearchInvoicePdf::getSummaryBillLink($userProfile['MEMBER_CODE'],  $user['Month']) }}" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a>
                                            @else
                                            <span>Not ready</span>
                                            @endif
                                            </td>
                                            <!-- Detail -->
                                            <td>
                                            @if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ", $user['Month']))))
                                                <a href="{{ SearchInvoicePdf::getDetailBillLink($userProfile['MEMBER_CODE'],  $user['Month']) }}" target="_blank"><img class="img-fluid"
                                                        src="{{ asset('img/invoice_pdficon.png') }}" alt="" /></a></td>
                                            @else
                                            <span>Not Ready</span>
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