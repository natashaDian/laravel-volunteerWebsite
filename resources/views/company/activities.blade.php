@extends('layouts.app')

@section('title', 'Find Activities')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Find Activities</h1>

        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Search activities..." />
            </div>
        </div>

        <!-- Activities List -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($activities as $activity)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset($activity->image_url) }}" class="card-img-top" alt="{{ $activity->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->title }}</h5>
                            <p class="card-text">{{ Str::limit($activity->description, 100) }}</p>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($activity->end_date)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $activities->links() }}
        </div>

        <!-- Add a purple button below -->
        <div class="text-center mt-4">
            <a href="{{ route('activities.index') }}" class="btn btn-primary btn-lg">Find Activities</a>
        </div>
    </div>
@endsection
