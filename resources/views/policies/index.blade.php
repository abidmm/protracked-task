@extends('layouts.layout')
@section('content')
<div class="container">
    <h1>Policies</h1>
    <form action="{{ route('policies.index') }}" method="GET">
        <div class="form-group">
            <label for="date">Select Date</label>
            <input type="date" name="filter_date" class="form-control" value="{{ request('filter_date') }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Total Policy Premium</th>
                <th>Total Commission</th>
                <th>Transaction Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($policies as $policy)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $policy->customer_name }}</td>
                <td>{{ number_format($policy->total_policy_premium) }}</td>
                <td>{{ number_format($policy->total_commission_received) }}</td>
                <td>{{ $policy->transaction_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $policies->links('pagination::bootstrap-5') }}
</div>
@endsection
