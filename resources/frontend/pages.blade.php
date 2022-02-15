<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('common.home_header')
    <!-- ********|| RIGHT PART START ||******** -->

    <div class="col-lg-9 col-md-9 p-0">
        <div class="right-body">
            <!-- ********|| BANNER PART START ||******** -->
            <section class="cricket-banner">
                <div class="img-box">
                    <img class="img-fluid" src="{{ asset('img/sports-banner.jpg') }}" alt="" />
                </div>

                <div class="cricket-title">

                    <?php
echo "Sports name is :" . $sport_name;
echo "<br>";
?>

                </div>
            </section>


            @foreach($members as $key => $member)

            @if ($member->select_sport->sport_name == $sport_name)
            <div class="card" style="border: 4px solid #c03437;border-radius: 10px;min-height: 175px;">
                <div class="card-body">
                    <div class="container-fluid text-center" style="padding: 5%;">
                        <div><span
                                style="color: #222831; font-weight: bold;">{{ $member->select_title->titles ?? '' }}</span>
                        </div>
                        <div><span
                                style="color: #222831; font-weight: bold;">{{ $member->select_member->name ?? '' }}</span>
                        </div>
                        <!-- <div><span style=""><a href="tel:+91 7044066268">+91 7044066268</a></span></div> -->
                        <div><span style=""><a
                                    href="mail:mainak8717@gmail.com">{{ $member->select_member->email ?? '' }}</a></span>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
            @else

            @endif



            @endforeach

            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| CONTACT END ||******** -->
            @include('common.footer')


            </body>

</html>