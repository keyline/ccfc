@extends('layouts.admin')
@section('content')
@can('payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.payment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">
                            {{ trans('cruds.payment.fields.id') }}
                        </th>
                        
                        <th>
                            {{ trans('cruds.payment.fields.member') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.amount_paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.gateway_name') }}
                        </th>
                        <th class="notexport">
                            {{ trans('cruds.payment.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <th>Payment Datetime</th>
                        <th class="notexport">Status Update</th>
                        <th class="notexport">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $user)
                    @foreach($user as $payment)
                    @php $gateway= basename(parse_url($payment->destination, PHP_URL_PATH)); @endphp
                    @php $userDetails= \App\Models\User::select('*')->where('id', '=', $payment->paid_for_id)->first();@endphp
                    
                        <tr data-entry-id="{{ $payment->paid_for_id }}">
                            
                            <td>
                                {{ $payment->id ?? '' }}
                            </td>
                            
                            <td>
                                {{ $userDetails->name ?? ''}} {{ $userDetails->user_code ?? '' }}
                            </td>
                            <td>
                                {{ ($gateway == 'status') ? number_format($payment->response('amount'), 2, '.', '') : ($gateway == 'axisstatus' ? number_format($payment->response('amount')/100, 2, '.', '') : number_format($payment->response('txn_amount'), 2, '.', '')) }}
                            </td>
                            <td>
                                {{ ( $gateway == 'status') ? 'PayUMoney' : ($gateway == 'axisstatus' ? 'AXIS' : 'HDFC') }}
                                
                            </td>
                            <td>
                                {{ $payment->response('comment') ?? '' }}
                            </td>
                            <td>
                                {{ ( $gateway == 'status') ? $payment->response('status') : $payment->status }}
                            </td>
                            <td>{{ $payment->updated_at ?? '' }}</td>
                            <td>
                                <span style="display:none">{{ $payment->response('status') ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $payment->status ? 'checked' : '' }}>
                            </td>
                            <td></td>

                        </tr>
                    @endforeach
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
    $(function () {
        let today = new Date()
        today = today.toISOString().split('T')[0];
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    dom: 'Bfrtip',
        buttons: [
             {
      extend: 'excel',
      title: 'PayU Reports',
      exportOptions: {
            columns: ':visible:not(.notexport)'
        }
    },
        ]
  });
  let table = $('.datatable-Payment:not(.ajaxTable)').DataTable();
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection