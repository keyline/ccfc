<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>This is test mail</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        
        .emailheader_top h2 {
            font-size: 24px;
        }
        .emailheader_top p {
            margin-bottom: 2px;
            font-size: 16px;
            line-height: 1.25;
        }
        .emailheader_top a{
            color: #000;
            text-decoration: none;
        }
        .footer_section{background: #ddd; }
        .footer_section address{margin-bottom: 0px;}
        .footer_section{padding: 10px 0;}
    </style>
</head>
<body>
    <div style="margin: 0 auto; display:table;"><a href="{{ url()->current() }}"><img class="img-fluid" src="{{URL::to('/img/email-logo.png')}}" alt="" /></a></div>
    <div style="font-weight: 600; font-size:20px; text-align: center; font-family:Arial, Helvetica, sans-serif;">Calcutta Cricket & Football Club</div>
    <div style="height: 2px; background: #be1f24;"></div>
    <div style="margin: 0 auto; display:table;">
        <p style="text-align: center; font-family:Arial, Helvetica, sans-serif;">Please check attachment with this file.</p>
        <p style="font-size: 14px; color:#000; font-family:Arial, Helvetica, sans-serif; text-align: center;"> {{ strip_tags($body) }}</p>
    </div>

    
    <div style="padding-top:20px; width:100%; margin: 0 auto; display:table; text-align:center; font-family:Arial, Helvetica, sans-serif;">
        <div style="height: 2px; background: #000; "></div>
        <p style="margin: 10px 0 5px;">19/1, Gurusaday Road, Kolkata - 700 019</p>
        <p style="margin: 0 0 5px;"><strong>Phone:</strong> 2461-5060 , 2461-5204 &nbsp; <strong>Fax:</strong> 2461-5058</p>
        <p style="margin: 0 0 5px;"><strong>E-mail:</strong> <a style="color: #000; text-decoration:none;" href="mailto:ccfcsecretary@ccfc1792.com"> ccfcsecretary@ccfc1792.com</a>  <strong>Website:</strong> <a style="color: #000; text-decoration:none;" href="{{ url()->current() }}" target="_blank">www.ccfc1792.com</a></p>
        <p style="margin: 0 0 5px;"><strong>CIN :</strong> U92412WB2003GAP096325</p>
    </div>
    {{-- <div class="email_wrapper">
        <div class="header_part">
            <div class="container text-center">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ url()->current() }}"><img class="img-fluid" src="{{URL::to('/img/email-logo.png')}}" alt="" /></a>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="emailheader_top">
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="middle_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt-5 pb-5">
                        <div class="text-center">
                            <h1 class="lead mt-3"></h1>
                            <p class="lead">Please check attachment with this file.</p>
                            {{ strip_tags($body) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer_section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <address>Copyright © 2022 The CC&FC Club at Kolkata All Rights Reserved.</address>
                    </div>
                </div>
            </div>
        </div> 
    </div>--}}

    
</body>
</html>