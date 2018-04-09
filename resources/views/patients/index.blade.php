@extends('layouts.app')

@section('content')
<div>
<a href="{{url('/home')}}" class="btn btn-info" align="left">Home </a> </div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Bio</td>
              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{$patient->id}}</td>
                <td>{{$patient->name}}</td>
                <td>{{$patient->bio}}</td>
                <td><a href="{{action('PatientController@edit',$patient->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('PatientController@destroy', $patient->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>
@endsection