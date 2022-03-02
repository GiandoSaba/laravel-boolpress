@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h1>
                            Welcome {{ Auth::user()->name }}
                        </h1>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Go to Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
