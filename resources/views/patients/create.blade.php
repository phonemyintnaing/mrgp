@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
<div><a href="{{url('/home')}}" class="btn btn-info" align="left">Home </a> </div>
    <div class="row">
    <div class= col-lg-4 col-sm-8 left-column>
    <form method="post" action="{{url('/create/patient')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea cols="3" rows="3" class="form-control" name="bio"></textarea>
        </div>
        <!--
        <div class="dropdown">
            <button type="button"    class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sex</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" name="sex" value="male">Male</a>
                <a class="dropdown-item" name="sex" value="female">Female</a>  
            </div>
        </div>
        -->
        <div class="dropdown"> Sex: 
            <select class="bootstrap-select" name="sex">
                <option value="M" selected="selected">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <div class="form-group"> </div>
        <div class="form-group">
           <label for="phone">Phone:</label>
            <input type="text" class=form-control  name="phone"/>
        </div>

        <div class="form-group">
           <label for="address">Address:</label>
            <input type="text" class=form-control  name="address"/>
        </div>
         
        <div class="form-group">
           <label for="age">Age:</label>
            <input type="text" class=form-control  name="age"/>
        </div>


          <div class="form-group"> </div>
        <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    </div>
</div>
@endsection