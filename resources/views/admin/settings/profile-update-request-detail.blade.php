@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Deleet Account Requests</h3>
    </div>
</div>
@endcan
@if (session('status'))
    <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
@if (session('error_message'))
    <h6 class="alert alert-danger">{{ session('error_message') }}</h6>
@endif
<div class="card">
  <div class="card-body">
    <div class="row">
      <!-- <div class="col-md-6">

      </div> -->
      <div class="col-md-12">
        <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
          <tr>
            <td colspan="2" style="text-align: center;" class="alert alert-info"><h5>Member</h5></td>
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Name :</a></td>
              <td valign="middle"><?=$profileRequestInfo->member_name?></td> 
          </tr>
           <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Email :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_email?></td> 
          </tr>
           <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 1 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->member_phone1?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 2 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->member_phone2?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 3 :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_phone3?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">DOB :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_dob?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Since :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_since?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Sex :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_sex?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Address :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_address?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">City :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_city?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">State :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_state?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Pincode :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->member_pin?></td> 
          </tr>

          <tr>
            <td colspan="2" style="text-align: center;" class="alert alert-info"><h5>Spouse</h5></td>
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Name :</a></td>
              <td valign="middle"><?=$profileRequestInfo->spouse_name?></td> 
          </tr>
           <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Email :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->spouse_email?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 1 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->spouse_phone1?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 2 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->spouse_phone2?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 3 :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->spouse_phone3?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">DOB :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->spouse_dob?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Sex :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->spouse_sex?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Profession :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->spouse_profession?></td> 
          </tr>

          <tr>
            <td colspan="2" style="text-align: center;" class="alert alert-info"><h5>Children 1</h5></td>
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Name :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children1_name?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 1 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children1_phone1?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">DOB :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children1_dob?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Sex :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children1_sex?></td> 
          </tr>

          <tr>
            <td colspan="2" style="text-align: center;" class="alert alert-info"><h5>Children 2</h5></td>
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Name :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children2_name?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 1 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children2_phone1?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">DOB :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children2_dob?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Sex :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children2_sex?></td> 
          </tr>

          <tr>
            <td colspan="2" style="text-align: center;" class="alert alert-info"><h5>Children 3</h5></td>
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Name :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children3_name?></td> 
          </tr>
          <tr>
              <td valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Phone 1 :</a></td>
              <td valign="middle"><?=$profileRequestInfo->children3_phone1?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">DOB :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children3_dob?></td> 
          </tr>
          <tr>
              <td  valign="middle"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Sex :</a></td>
              <td  valign="middle"><?=$profileRequestInfo->children3_sex?></td> 
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')

@endsection
