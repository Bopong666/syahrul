@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header flex-wrap row text-start text-gray">
        <h3>Selamat Datang {{ Auth::user()->username }}</h3>
    </div>

</div>
@endsection