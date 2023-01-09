@extends('Layouts.userPanel')

@section('title', 'welcome to the club, body')

@section('content')
    <div class="content">
        @foreach($categories as $category)
            <div class="category">
                <a href="{{ route('showCategory', $category->slug) }}">
                    <h2>{{ $category->name }}</h2>
                </a>
            </div>
        @endforeach
    </div>
@endsection

