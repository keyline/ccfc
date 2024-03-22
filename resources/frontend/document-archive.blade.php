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
							<div class="document_pdfview">
								<div class="table-responsive">
									<table class="table table-bordered">
									  <thead>
										<tr>
										  <th scope="col">#</th>
										  <th scope="col">{{ trans('cruds.tenderupload.fields.tender_title') }}</th>
										  <th scope="col">{{ trans('cruds.tenderupload.fields.tender_description') }}</th>
										  <th scope="col">{{ trans('cruds.tenderupload.fields.tender_download') }}</th>
										</tr>
									  </thead>
									  <tbody>
										@php $counter = 1 @endphp
										@foreach($folders as $folder)
										@if(count($folder->documents) > 0)
										@foreach($folder->documents as $document)
										<tr>
										  <th scope="row">{{ $counter }}</th>
										  <td class="w-resp_5">{{ $document->ctd_title ?? '' }}</td>
										  <td class="w-resp_10">{{ $document->ctd_description ?? '' }}</td>
										  <td class="w-resp_15">
												  <div class="tender_pdf">
													@if($tenderFiles= $document->getfiles())
														<div class="tender_pdf">
															@foreach($tenderFiles AS $file)
															<a href="{{ route('download.tender', ['file' => $file->cfm_id]) }} " target="_blank"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="{{ $file->cfm_original_name }}" /></a>
															@endforeach
														</div>
													@endif
													
													<!-- <a href="#"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="" /></a>
													<a href="#"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="" /></a>
													<a href="#"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="" /></a>
													<a href="#"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="" /></a>
													<a href="#"> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="" /></a> -->
												  </div>
											</td>
										</tr>
										@php $counter++ @endphp
										@endforeach
										@endif
										@endforeach
									  </tbody>
									</table>
								</div>
							</div>
							<!-- <div class="tenterachive_section">
								<div class="accordion" id="accordionExample">
									@foreach($folders as $folder)
									@if(count($folder->documents) > 0)
									<div class="card">
										<div class="card-header" data-toggle="collapse" data-target="#collapse{{ $folder->cdo_id }}" aria-expanded="{{ ($loop->first) ? 'true' : 'false'}}">     
											<span class="title">Year {{ $folder->cdo_name}}</span>
											<span class="accicon"><i class="zmdi zmdi-chevron-down"></i></span>
										</div>
										<div id="collapse{{ $folder->cdo_id }}" class="collapse{{ ($loop->first) ? ' show' : '' }}" data-parent="#accordionExample">
											<div class="card-body">
												<div class="investor_section_inner">
													@foreach($folder->documents as $document)
													<div class="tender_achive_innertitle"><h3>{{ $document->ctd_title }}</h3></div>
													<ul>
														
															@foreach($document->getFiles() as $file)
															<li style="margin-right:10px;"><a href="{{ route('download.tender', ['file' => $file->cfm_id] )}}" target="_blank"><img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="pdf" /> <h4>{{ $file->cfm_original_name }}</h4></a></li>
															@endforeach
														
												  </ul>
												  @endforeach
												</div>
											</div>
										</div>
									</div>
									@endif
									@endforeach
									
								</div>
							</div> -->
                        </div>

                    </div>
                </div>
            </section>
            <!-- ********|| ADVISE END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>