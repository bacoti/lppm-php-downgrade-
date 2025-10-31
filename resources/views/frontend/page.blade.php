@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4">
                    <h1 class="fw-bold">{{ $content->title }}</h1>
                    <div class="text-muted mb-3">&mdash; {{ date('d M Y', strtotime($content->created_at)) }}</div>
                </div>

                <div class="card p-4 shadow-sm">
                    <div class="content-body">
                        {!! $content->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
