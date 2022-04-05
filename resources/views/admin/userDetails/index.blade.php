@extends('layouts.admin')
@section('content')
@can('user_detail_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.user-details.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.userDetail.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserDetail">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.user_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_type_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_since') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.sex') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.address_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.pin') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.mobile_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.current_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.represented_club_in') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.hobbies_interest') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_profession') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_address_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_city') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_state') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_pin') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.business_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_dob') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_sex') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_mobile_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.anniversary_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_profession') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_address_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_city') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_state') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_pin') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_business_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.member_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDetail.fields.spouse_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDetails as $key => $userDetail)
                    <tr data-entry-id="{{ $userDetail->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $userDetail->id ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->user_code->user_code ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->user_code->name ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->member_type_code ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->member_type ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->date_of_birth ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->member_since ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\UserDetail::SEX_RADIO[$userDetail->sex] ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->address_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->address_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->address_3 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->city ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->state ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->pin ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->phone_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->phone_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->mobile_no ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->email ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->current_status ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->represented_club_in ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->hobbies_interest ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_profession ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->category ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_address_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_address_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_address_3 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_city ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_state ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_pin ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_phone_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_phone_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->business_email ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_name ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_dob ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\UserDetail::SPOUSE_SEX_RADIO[$userDetail->spouse_sex] ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_phone_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_phone_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_mobile_no ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_email ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->anniversary_date ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_profession ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_category ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_address_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_address_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_address_3 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_city ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_state ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_pin ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_phone_1 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_phone_2 ?? '' }}
                        </td>
                        <td>
                            {{ $userDetail->spouse_business_email ?? '' }}
                        </td>
                        <td>
                            @if($userDetail->member_image)
                            <a href="{{ $userDetail['member_image'] }}" target="_blank" style="display: inline-block">
                                <img src="data:image/png;base64,                          
                                        {{ $userDetail['member_image'] }}" height="90" width="100" alt="" />
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($userDetail->spouse_image)
                            <a href="{{ $userDetail['spouse_image'] }}" target="_blank" style="display: inline-block">
                                <img src="data:image/png;base64,                          
                                        {{ $userDetail['spouse_image'] }}" height="90" width="100" alt="" />
                            </a>
                            @endif
                        </td>
                        <td>
                            @can('user_detail_show')
                            <!-- <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.user-details.show', $userDetail->id) }}">
                                {{ trans('global.view') }}
                            </a> -->
                            @endcan

                            <!-- @can('user_detail_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.user-details.edit', $userDetail->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan -->


                            @can('user_detail_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.user-details.edit', $userDetail->id) }}">
                                {{ trans('global.updatedetails') }}
                            </a>
                            @endcan

                            <!-- @can('user_detail_delete')
                            <form action="{{ route('admin.user-details.destroy', $userDetail->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan -->




                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('user_detail_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.user-details.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('
                    global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('
                    global.areYouSure ') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 100,
    });
    let table = $('.datatable-UserDetail:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection