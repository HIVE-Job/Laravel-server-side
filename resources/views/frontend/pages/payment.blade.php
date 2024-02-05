@extends('frontend.layouts.master')

@section('title', 'Payment_test_bank')

@section('main-content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 style="margin-bottom: 0;">Payment Details</h2>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <strong>User:</strong> {{ $userName }}
                    </div>

                    <div class="mb-4">
                        <strong>Bank Amount:</strong> ${{ $bankDetails->amount }}
                    </div>

                    <div class="mb-4">
                        <strong>Total Price:</strong> ${{ $totalAmountToBePaid }}
                    </div>

                    <form action="{{ route('process.payment') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
