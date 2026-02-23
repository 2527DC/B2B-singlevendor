@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Driver</h3>

    <form method="POST" action="{{ route('drivers.store') }}">
        @csrf

        <input class="form-control mb-2" name="name" placeholder="Name" required>
        <input class="form-control mb-2" name="phone" placeholder="Phone" required>
        <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
        <textarea class="form-control mb-2" name="address" placeholder="Address"></textarea>
        <input class="form-control mb-2" name="order_pick_location" placeholder="Pickup Location">

        <button class="btn btn-success">Save</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
