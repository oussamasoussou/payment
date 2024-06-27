@extends('layouts.app')

@section('content')
    <h2>Create Payment</h2>
    <form action="/gocardless/payment" method="POST">
        @csrf
        <div class="form-group">
            <label for="mandate_id">Mandate ID</label>
            <input type="text" class="form-control" id="mandate_id" name="mandate_id" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount (in pence/cents)</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Payment</button>
    </form>
@endsection
