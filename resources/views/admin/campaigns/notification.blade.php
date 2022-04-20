<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>This is test mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .footer_section{background: #ddd;}
        .footer_section address{margin-bottom: 0px;}
        .footer_section{padding: 10px 0;}
    </style>
</head>
<body>
    <div class="email_wrapper">
        <div class="header_part">
            <div class="container text-center">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="https://ccfc1792.com/"><img class="img-fluid" src="{{ asset('img/email-logo.png') }}" alt="" /></a>
                    </div>
                    <div class="col-md-6">
                        <div class="emailheader_top">
                            <h2>Calcutta Cricket & Football Club</h2>
                            <p>19/1, Gurusaday Road, Kolkata - 700 019</p>
                            <p><strong>Phone:</strong> 2461-5060 , 2461-5204</p>
                            <p><strong>Fax:</strong> 2461-5058</p>
                            <p><strong>E-mail:</strong> <a href="mailto:ccfcsecretary@ccfc1792.com"> ccfcsecretary@ccfc1792.com</a></p>
                            <p><strong>Website:</strong> <a href="https://ccfc1792.com/" target="_blank">www.ccfc1792.com</a></p>
                            <p><strong>CIN :</strong> U92412WB2003GAP096325</p>
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
                            <h1 class="lead mt-3">Send mail using attachment</h1>
                            <p class="lead">Please check attachment with this file.</p>
                            {{ $body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="footer_section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <address>Copyright © 2022 The CC&FC Club at Kolkata All Rights Reserved.</address>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    
</body>
</html>