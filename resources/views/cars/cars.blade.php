@extends('layouts.index')

@section('content')
    <div class="container">
        <h2>List cars</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Seat</th>
                <th>Starting Price</th>
                <th>Due date</th>
                <th>Car year</th>
                <th>Model</th>
                <th>Body</th>
                <th>Start Bid Time</th>
                <th>Bid Duration</th>
                <th>Description</th>
                <th>Photo</th>
            </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td>Success</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
