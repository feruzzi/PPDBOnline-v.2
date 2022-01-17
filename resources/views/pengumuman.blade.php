@extends('layouts/main-layout')
@section('title',"$title")
@section('content')
<div class="container">
    <h1 class="text-center">
        Papan Pengumuman
    </h1>
    <div>   
        {!!$pengumuman[0]!!}
    </div>
</div>
@endsection