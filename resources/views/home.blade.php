@extends('layouts.main')

@section('title')
<title>Laravel</title>
@endsection

@section('content')
@include('components.header')
<div id="app">
    <div class="">
        <create-task></create-task>
        <list-tasks></list-tasks>
    </div>
</div>
@endsection