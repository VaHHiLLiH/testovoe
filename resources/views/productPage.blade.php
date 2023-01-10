@extends('Layouts.userPanel')

@section('title', $product->slug)

@section('content')
    <div class="breadcrumb">
        @foreach($breadcrumbs as $crumb)
            <span>
                <a href="{{ $crumb['href'] }}">{{ $crumb['name'] }}</a>
            </span>
        @endforeach
    </div>
    <div class="product-page-container">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
        <h1>{{ $product->name }}</h1>
        <span class="manufacturer">Brand: {{ $product->brand }}</span>
        <div class="price">
            @if (!empty($product->old_price))
                <span class="oldPrice">{{ $product->old_price }} руб.</span><br/>
                <span class="discount">-{{ $product->discount_value }}%</span>
            @endif
            <span @if (!empty($product->old_price))class="newPrice"@endif>{{ $product->price }} руб.</span>
        </div>
        <div class="description">
            <p>{{ $product->description }}</p>
        </div>
    </div>
@endsection
