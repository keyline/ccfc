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
                        @foreach($galleries->where("id","33") as $key => $gallery)
                        @foreach($gallery->images as $key => $media)
                        <div class="item">
                            <div class="about-img">
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        <!-- <div class="item">
                            <div class="about-img">
                                <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="about-img">
                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <!-- ********|| BANNER PART END ||******** -->
            <!-- ********|| HISTORY START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    1792 News Letter
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content_inner">
                                @foreach($contentPages->where("id","18") as $contentPage)
                                {!! $contentPage->page_text !!}
                                @endforeach
                                <!-- <p>In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.</p>
                                <p>The club also offers food from its different counters like charcoal-grilled kebabs,
                                    quick bites of wraps, burgers, pastas etc. There is also a pastry shop and
                                    specialized tea & coffee counters serving wide varieties of tea and coffee.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="inner_belowbox_wrapper">
                <div class="container">
                    <div class="row">
                        <?php
                        //echo '<pre>';print_r($contentBlocks);die;
                        if($contentBlocks) { foreach($contentBlocks as $contentBlock){
                           
                        ?>
                        <div class="col-lg-4 col-sm-6 col-md-12">
                            <div class="newslerterpdf_wholelink">
                                <a href="{{ asset('pdf/cc&fc-newsletter-first-edition.pdf') }}" target="_blank"></a>
                                <div class="newsletter_pdfdownload president_corner">
                                    <div class="newsletter_left">
                                        <img class="img-fluid" src="{{ asset('img//pdf_downloadicon.png') }}" alt="" />
                                    </div>
                                    <div class="newsletter_right">
                                        <!-- <h3>Download<br> News letter</h3> -->
                                        <h3><?=$contentBlock['heading']?></h3>
                                        <!-- <p>June 2021</p> -->
                                        <?=$contentBlock['body']?>
                                    </div>
                                    <?php
                                    $circular_image = $contentBlock['circularimage'];
                                    $fileURL = url('/').'/uploads/circularimg/'.$circular_image;
                                    ?>
                                    <a class="wholenewdivlink" href="<?=$fileURL?>" target="_blank"></a>
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                        {{-- <div class="col-lg-4 col-sm-6 col-md-12">
                            <div class="newsletter_pdfdownload">
                                <div class="newsletter_left">
                                    <a href="#" target="_blank"><img class="img-fluid"
                                            src="{{ asset('img//pdf_downloadicon.png') }}" alt="" /></a>
                    </div>
                    <div class="newsletter_right">
                        <h3><a href="#" target="_blank">Download<br> News letter</a></h3>
                        <p><a href="#" target="_blank">June 2021</a></p>
                    </div>
                </div>
        </div> --}}
    </div>
    </div>
    </section>
    <!-- ********|| HISTORY END ||******** -->
    @include('common.footer')
    <!-- ?php include 'assets/inc/footer.php';?> -->
    </body>
</html>