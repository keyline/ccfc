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
                        @foreach($galleries->where("id","21") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)

                        <div class="item">

                            <div class="about-img">

                                <!-- <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" /> -->
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />

                            </div>

                        </div>
                        @endforeach
                        @endforeach
                        <!-- <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

                            </div>

                        </div> -->

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| President Corner START ||******** -->
            <section class="inner_belowbanner text-justify">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    President's Corner
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-md-1">
                            <div class="activites_rightside mt-0 p-0">

                                @foreach($galleries->where("id","13") as $key => $gallery)

                                @foreach($gallery->images as $key => $media)
                                <div class="active_rightimg">
                                    <!-- <img class="img-fluid" src="{{ asset('img/deepankar-nandi.jpg') }}" alt="" /> -->
                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                                </div>
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-8">
                            @foreach($contentPages->where("id","14") as $contentPage)
                            {!! $contentPage->page_text !!}
                            @endforeach
                            <!-- <div class="content_inner">
                                <h4>Mr. Deepankar Nandi</h4>
                                <p>02.11.2021.</p>
                                <p>Dear Member,</p>
                                <p>HAPPY DIWALI.</p>
                                <p>On behalf of the General Committee, I would like to wish you and your families good
                                    health, happiness and prosperity.</p>
                                <p>COVID has ravaged the entire world. We remember with extreme sadness the passing away
                                    of so many Club members and our near ones. They will always be missed. It has been a
                                    tragedy of such immense proportion.</p>
                                <p>Over the last few months, we had slowly started the sporting activities in the Club.
                                    While we had a truncated Football and Rugby Season, members continue to enjoy
                                    Tennis, Gym, Swimming and Darts. Quite a number of members have shown interest in
                                    Basketball – hence the old shamiana site has been earmarked for their practice. Our
                                    Darts Section has organised an Inter Club Darts competition at our Club between 20th
                                    November and 5th December.</p>
                                <p>The ground is being prepared for the Cricket Season. Extensive work is being done
                                    there, including preparation of the pitches, deweeding, putting soil and fresh grass
                                    in patches and levelling. We hope that this exercise will be completed by this month
                                    end and Cricket Season will commence in early December. We are hopeful of a full
                                    season including the popular T10 and Corporate Tournaments. We are also in talks
                                    with CAB to host a few Ranji Trophy matches here.</p>
                            </div> -->
                            <div class="newsletter_pdfdownload president_corner">
                                <div class="newsletter_left">
                                    <img class="img-fluid"
                                            src="{{ asset('img//pdf_downloadicon.png') }}" alt="" />
                                </div>
                                <div class="newsletter_right">
                                    <h3>President's Letter</h3>
                                </div>
                                <a class="wholenewdivlink" href="{{ asset('pdf/Diwali-Greetings-to-members-2.11.21.pdf') }}" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ********|| President Corner END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>