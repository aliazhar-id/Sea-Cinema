@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-auto min-h-screen flex flex-col">
    {{-- Header Section --}}
    @include('movies.partials.header')

    {{-- Top Up Section --}}
    <div class="mx-auto min-w-max mt-16 mb-5 font-quicksand text-gray-800">
      <div class="text-3xl font-bold">Top Up</div>
      <div class="mt-1">Current Balance: Rp{{ number_format(auth()->user()->balance, 0, '.') }}</div>

      <div class="mt-2 text-gray-400">Please Transfer your money only to:</div>
      <div class="mb-2 text-gray-400">Bank Jago - 10121189 - a/n Ali Azhar</div>

      <div class="mb-1 text-red-500 text-xs">*Minimum is Rp10.000, Otherwise will be DECLINED!</div>

      @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2" role="alert">
          <p class="font-bold">Error</p>
          <p>{{ session('error') }}</p>
        </div>
      @elseif(session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-900 p-4 mb-2" role="alert">
          <p class="font-bold">Success</p>
          <p>{{ session('success') }}</p>
        </div>
      @endif

      <div class="mt-3">
        <form class="max-w-sm mx-auto w-96" action="{{ route('main.topup.store') }}" method="POST"
          enctype="multipart/form-data">
          @csrf

          <div class="mb-5">
            <label for="amount" class="block mb-2 text-sm font-semibold text-gray-900">Amount</label>
            <input type="number" id="amount" name="amount"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="Top Up Amount: ex: 10000" required />

            @error('amount')
              <span class="text-sm text-red-600"> *{{ $message }} </span>
            @enderror
          </div>
          <div class="mb-5">
            <label for="amount" class="block mb-2 text-sm font-semibold text-gray-900">Proof of Payment <span
                class="text-xs font-normal text-gray-400">(Max. 2MB)</span></label>

            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
              name="proof_image" type="file" required>
            <div class="mt-1 text-sm text-gray-500">A picture for proof of your payment</div>

            @error('proof_image')
              <span class="text-sm text-red-600"> *{{ $message }} </span>
            @enderror
          </div>

          <div class="text-center">
            <button type="submit"
              class="text-white bg-movieapp-500 hover:bg-movieapp-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Top Up History Section --}}
    <div class="mx-auto min-w-max mt-16 mb-28 font-quicksand text-gray-800">
      <div class="text-3xl font-bold">Top Up History</div>
      @if ($history)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Id Top Up
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

              @foreach ($history as $topup)
                <tr class="bg-white border-b">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $topup->id_topup }}
                  </th>
                  <td class="px-6 py-4">
                    Rp{{ number_format($topup->amount, 0, '.') }}
                  </td>
                  <td class="px-6 py-4">
                    <a href="{{ asset('storage/' . $topup->proof_image) }}" target="_blank">
                      <img class="w-8" src="{{ asset('storage/' . $topup->proof_image) }}" alt="Proof Top Up Image">
                    </a>
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
