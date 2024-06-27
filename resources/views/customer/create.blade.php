@extends('layouts.app')

@section('content')
    <h2>Create Customer</h2>
    <form action="/gocardless/customer" method="POST">
        @csrf
        <div class="form-group">
            <label for="given_name">Given Name</label>
            <input type="text" class="form-control" id="given_name" name="given_name" required>
        </div>
        <div class="form-group">
            <label for="family_name">Family Name</label>
            <input type="text" class="form-control" id="family_name" name="family_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="address_line1">Address Line 1</label>
            <input type="text" class="form-control" id="address_line1" name="address_line1" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
        </div>
        <div class="form-group">
            <label for="country_code">Country Code</label>
            <input type="text" class="form-control" id="country_code" name="country_code" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Customer</button>
    </form>
@endsection
