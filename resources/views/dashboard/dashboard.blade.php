@extends('layouts/dashboard-layout')
@section('title',"$title")
@section('content') 
<body onload="myDonut('myChart');myDonut('myChart1')">
    
    <div class="container-fluid">
        <canvas id="myChart" style="width:100%;max-width:512px;height:100%;max-height:512px"></canvas>
        {{-- <button class="btn btn-primary" onload="myDonut('myChart')">Klik</button> --}}
        <canvas id="myChart1" style="width:100%;max-width:512px;height:100%;max-height:512px"></canvas>
    </div>
</body>
@endsection