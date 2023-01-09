@extends('Layouts.userPanel')

@section('title', 'welcome to the club, body')

@section('content')
    <div class="breadcrumb">
        @foreach($breadcrumbs as $crumb)
            <span>
                <a href="{{ $crumb['href'] }}">{{ $crumb['name'] }}</a>
            </span>
        @endforeach
    </div>
    <div class="category-page-container">
        <div class="left-panel">
            @foreach($childCategories as $childCategory)
                <a href="{{ route('showCategory', $childCategory->slug) }}">{{ $childCategory->name }}</a>
            @endforeach
        </div>
        <div id="app" class="product-content">
            <h1>{{ $category->name }}</h1>
            <products :products="{{ json_encode($productsCategory) }}" :category="{{ json_encode($category) }}"></products>
        </div>
    </div>
@endsection
