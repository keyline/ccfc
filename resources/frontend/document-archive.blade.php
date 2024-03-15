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
            <section class="history-banner">
                <img class="img-fluid" src="{{ asset('img/history/history-banner.jpg') }}" alt="" />
            </section>
            <!-- ********|| BANNER PART END ||******** -->

            <!-- ********|| ADVISE START ||******** -->
            <section class="history-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="title-sec">
                                <div class="title">
                                    Tender Archive
                                </div>
                            </div>
                        </div>
						<div class="col-lg-6">
							<div class="tender_topachive_btn">
								<a href="{{ asset('tenders') }}">Latest</a>
							</div>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="tenterachive_section">
								<div class="accordion" id="accordionExample">
									@foreach($folders as $folder)
									<div class="card">
										<div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">     
											<span class="title">Year {{ $folder->cdo_name}}</span>
											<span class="accicon"><i class="zmdi zmdi-chevron-down"></i></span>
										</div>
										<div id="collapseOne" class="collapse show" data-parent="#accordionExample">
											<div class="card-body">
												<div class="investor_section_inner">
													@foreach($folder->documents as $document)
													<div class="tender_achive_innertitle"><h3>{{ $document->ctd_title }}</h3></div>
													<ul>
														
															@foreach($document->getFiles() as $file)
															<li style="margin-right:10px;"><a href="{{ route('download.tender', ['file' => $file->cfm_id] )}}" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <!--<h4>{{ $file->cfm_original_name }}</h4>--></a></li>
															@endforeach
														
												  </ul>
												  @endforeach
												</div>
											</div>
										</div>
									</div>
									@endforeach
									<!-- <div class="card">
										<div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">     
											<span class="title">Year 2020-2021</span>
											<span class="accicon"><i class="zmdi zmdi-chevron-down"></i></span>
										</div>
										<div id="collapseTwo" class="collapse" data-parent="#accordionExample">
											<div class="card-body">
												<div class="investor_section_inner">
													<ul>
													 <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 1 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 2 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 2 - Reschedule 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 3 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
												  </ul>
												</div>
											</div>
										</div>
									</div> -->
									<!-- <div class="card">
										<div class="card-header collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">
											<span class="title">Year 2019-2020</span>
											<span class="accicon"><i class="zmdi zmdi-chevron-down"></i></span>
										</div>
										<div id="collapseThree" class="collapse" data-parent="#accordionExample">
											<div class="card-body">
												<div class="investor_section_inner">
													<ul>
													 <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 1 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 2 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 2 - Reschedule 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 3 - 22-23</h4></a></li>
													  <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
													   <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
														 <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
														 <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
														 <li style="margin-right:5px;"><a href="#" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>Quarter 4 - 22-23</h4></a></li>
												  </ul>
												</div>
											</div>
										</div>
									</div> -->
								</div>
							</div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- ********|| ADVISE END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>