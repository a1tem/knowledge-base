@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <knowledge-base-article-edit article-id="{{$id}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
