@extends('layouts.master')
@section('content')
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Price per hour</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($fields as $field)
    <tr>
      <td>{{ $field->name }}</td>
      <td>{{ $field->type }}</td>
      <td>{{ $field->price_per_hour }}</td>
      <td>{{ $field->description }}</td>
    </tr> 
    @endforeach --}}
            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
                <td>test</td>
            </tr>
        </tbody>
    </table>
@endsection
