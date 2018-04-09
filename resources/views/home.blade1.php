@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

         @include('includes.nav')


        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    @include('includes.head')
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
