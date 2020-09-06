@extends('layouts.layout')

@section('title')
Galería
@endsection

@section('content')
<div class="row mb-4">
    @foreach($images as $image)
        <div class="col-sm-4">
            <div class="card my-2">
                <a href="{{$image->getDownload()}}">
                    <img src="data:image/jpeg;base64,{{ base64_encode($image->getThumb()) }}" class="img-fluid">
                </a>
                    {{$image->getDay()}}-
                    {{$image->getMonth()}}-
                    {{$image->getYear()}} {{$image->getHours()}}:
                    {{$image->getMinutes()}}:{{$image->getSeconds()}}
            </div>
        </div>
    @endforeach
</div>
@include('layouts.pagination')
@endsection
