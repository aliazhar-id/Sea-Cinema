@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-auto min-h-screen flex flex-col">
    {{-- Header Section --}}
    @include('movies.partials.header')

    {{-- @dd($data) --}}
    {{-- Top Up Section --}}
    <div class="mx-auto min-w-max mt-16 mb-5 font-quicksand text-gray-800">
      <div class="text-3xl font-bold">Top Up</div>
      <div class="mt-1">Current Balance: Rp{{ number_format(auth()->user()->balance, 0, '.') }}</div>

      <div class="mt-2 text-gray-400">Please Transfer your money only to:</div>

      <div class="mb-1 text-red-500 text-xs">*Minimum is Rp10.000, Otherwise will be DECLINED!</div>
    </div>

    {{-- Top Up History Section --}}
    <div class="mx-auto min-w-max mt-16 mb-28 font-quicksand text-gray-800">
      <div class="text-3xl font-bold">Top Up History</div>
      @if ($data->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Ticket Code
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                  Amount
                </th>
                <th scope="col" class="px-auto py-3">
                  Proof Image
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                  Date
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                  Status
                </th>
              </tr>
            </thead>
            <tbody>

              @foreach ($data as $topup)
                <tr class="bg-white border-b">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $topup->ticket_code }}
                  </th>
                  <td class="px-6 py-4">
                    Rp{{ $topup->seats}}
                  </td>
                  <td class="px-6 py-4">
                    {{-- <a href="{{ asset('storage/' . $topup->proof_image) }}" target="_blank">
                      <img class="w-8" src="{{ asset('storage/' . $topup->proof_image) }}" alt="Proof Top Up Image">
                    </a> --}}
                  </td>
                  <td class="px-6 py-4">
                    {{ $topup->created_at }}
                  </td>
                  <td class="px-6 py-4">
                    @if ($topup->status == 'approved')
                      <span
                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-green-400">Approved</span>
                    @elseif ($topup->status == 'declined')
                      <span
                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-red-400">Declined</span>
                    @else
                      <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-yellow-300">Pending</span>
                    @endif
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      @else
        <div class="text-gray-500 mt-3">You don't have any top up history yet!</div>
      @endif
    </div>

    {{-- Footer Section --}}
    @include('movies.partials.footer')
  </div>
@endsection
