@extends('dashboard.layouts.main')

@section('custom-head')
  <link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">

  <style>
    table.dataTable thead>tr>th {
      padding-left: 30px !important;
      padding-right: initial !important;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
      left: 8px !important;
      right: auto !important;
    }
  </style>
@endsection

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Top Up Validation</h1>
  </div>

  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @elseif(session('error'))
    <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  {{-- Table pending section --}}
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
    <h1 class="h3">Pending</h1>
  </div>
  <div class="table-responsive col-lg-12 mt-1">
    <table class="table table-striped table-sm border" id="tablePending">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Id Top Up</th>
          <th scope="col">Username</th>
          <th scope="col">Amount</th>
          <th scope="col">Proof</th>
          <th scope="col">Date</th>
          <th scope="col">Status</th>
          <th scope="col" data-orderable="false">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($pending->count())
          @foreach ($pending as $topup)
            @if ($topup->status == 'pending')
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $topup->id_topup }}</td>
                <td>{{ $topup->user->username }}</td>
                <td>Rp{{ number_format($topup->amount, 0, '.') }}</td>
                <td>
                  <a href="{{ asset('storage/' . $topup->proof_image) }}" target="_blank">
                    <img width="32" src="{{ asset('storage/' . $topup->proof_image) }}" alt="Proof Top Up Image">
                  </a>
                </td>
                <td>{{ $topup->created_at }}</td>
                <td>
                  @if ($topup->status == 'approved')
                    <span class="badge badge-success">Approved</span>
                  @elseif ($topup->status == 'declined')
                    <span class="badge badge-danger">Desclined</span>
                  @else
                    <span class="badge badge-warning">Pending</span>
                  @endif
                </td>
                <td>
                  <button class="badge bg-success border-0 text-white" data-toggle="modal" data-target="#approveModal"
                    data-username="{{ $topup->user->username }}" data-id_topup="{{ $topup->id_topup }}"
                    data-amount="{{ number_format($topup->amount, 0, '.') }}" data-date="{{ $topup->created_at }}">

                    <span data-feather="check-circle"></span>

                  </button>
                  <button class="badge bg-danger border-0 text-white" data-toggle="modal" data-target="#declineModal"
                    data-username="{{ $topup->user->username }}" data-id_topup="{{ $topup->id_topup }}"
                    data-amount="{{ number_format($topup->amount, 0, '.') }}" data-date="{{ $topup->created_at }}">

                    <span data-feather="x-circle"></span>

                  </button>
                </td>
              </tr>
            @endif
          @endforeach
        @endif
      </tbody>
    </table>
  </div>

  {{-- Table history validation section --}}
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5">
    <h1 class="h3">History</h1>
  </div>
  <div class="table-responsive col-lg-12 mt-1">
    <table class="table table-striped table-sm border" id="tableHistory">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Id Top Up</th>
          <th scope="col">Admin</th>
          <th scope="col">Username</th>
          <th scope="col">Amount</th>
          <th scope="col">Proof</th>
          <th scope="col">Validated Date</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @if ($history->count())
          @foreach ($history as $topup)
            @if ($topup->status !== 'pending')
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $topup->id_topup }}</td>
                <td>{{ $topup->admin->username }}</td>
                <td>{{ $topup->user->username }}</td>
                <td>Rp{{ number_format($topup->amount, 0, '.') }}</td>
                <td>
                  <a href="{{ asset('storage/' . $topup->proof_image) }}" target="_blank">
                    <img width="32" src="{{ asset('storage/' . $topup->proof_image) }}" alt="Proof Top Up Image">
                  </a>
                </td>
                <td>{{ $topup->updated_at }}</td>
                <td>
                  @if ($topup->status == 'declined')
                    <span class="badge badge-danger">Declined</span>
                  @else
                    <span class="badge badge-success">Approved</span>
                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        @endif
      </tbody>
    </table>
  </div>

  <!-- Approve Modal-->
  <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm to Approve</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Are sure want to approve this top up?
          <br><br>
          Username: <span id="approve-username"></span>
          <br>
          Amount: <span id="approve-amount"></span>
          <br>
          Date: <span id="approve-date"></span>
          <br>
          The balance will be added to user
          <br><br>
          This action cannot be undone!
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">
            <i class="far fa-times-circle"></i> Cancel
          </button>
          <form method="POST">
            @csrf
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="btn btn-success">
              <i class="far fa-check-circle"></i> CONFIRM
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Decline Modal-->
  <div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm to Decline</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Are sure want to decline this top up?
          <br><br>
          Username: <span id="decline-username"></span>
          <br>
          Amount: <span id="decline-amount"></span>
          <br>
          Date: <span id="decline-date"></span>
          <br><br>
          This action cannot be undone!
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <form method="POST">
            @csrf
            <input type="hidden" name="status" value="declined">
            <button type="submit" class="btn btn-danger">
              <i class="far fa-times-circle"></i> DECLINE
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    $('#approveModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const username = button.data('username');
      const amount = button.data('amount');
      const date = button.data('date');

      $('#approve-username').text(username);
      $('#approve-amount').text('Rp' + amount);
      $('#approve-date').text(date);

      const modal = $(this);
      const id_topup = button.data('id_topup');
      modal.find('form').attr('action', `{{ route('dashboard.topup.update', '') }}/${id_topup}`);
    })

    $('#declineModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const username = button.data('username');
      const amount = button.data('amount');
      const date = button.data('date');

      $('#decline-username').text(username);
      $('#decline-amount').text('Rp' + amount);
      $('#decline-date').text(date);

      const modal = $(this);
      const id_topup = button.data('id_topup');
      modal.find('form').attr('action', `{{ route('dashboard.topup.update', '') }}/${id_topup}`);
    })
  </script>

  <script src="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.js"></script>

  <script>
    $('#tablePending').dataTable({
      info: false,
      searching: false,
      preDrawCallback: function(settings) {
        const api = new $.fn.dataTable.Api(settings);
        const pagination = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_paginate');

        const entriesCount = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_length');

        pagination.toggle(api.page.info().pages > 1);
        entriesCount.toggle(api.page.info().pages > 1);
      }
    });

    $('#tableHistory').dataTable({
      info: false,
      searching: false,
      preDrawCallback: function(settings) {
        const api = new $.fn.dataTable.Api(settings);
        const pagination = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_paginate');

        const entriesCount = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_length');

        pagination.toggle(api.page.info().pages > 1);
        entriesCount.toggle(api.page.info().pages > 1);
      }
    });
  </script>
@endsection
