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
                                    Tender
                                </div>
                            </div>
                        </div>
						<div class="col-lg-6">
							<div class="tender_topachive_btn">
								<a href="{{ asset('archives') }}">Archive</a>
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
										@foreach($uploadedTenders as $key => $tender)
										<tr>
										  <th scope="row">{{ $tender->ctd_id }}</th>
										  <td class="w-resp_5">{{ $tender->ctd_title ?? '' }}</td>
										  <td class="w-resp_10">{{ $tender->ctd_description ?? '' }}</td>
										  <td class="w-resp_15">
												  <div class="tender_pdf">
													@if($tenderFiles= $tender->getfiles())
														<div class="tender_pdf">
															@foreach($tenderFiles AS $file)
															<a href="{{ route('download.tender', ['file' => $file->cfm_id]) }} "> <img src="{{ asset('img/pdf/quarterly_icon.png') }}" alt="{{ $file->cfm_original_name }}" /></a>
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
										@endforeach
										
									  </tbody>
									</table>
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