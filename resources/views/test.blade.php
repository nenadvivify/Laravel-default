@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test page</div>

                <div class="card-body">
                    Hello {{ Auth::user()->first_name ?? "user"}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
