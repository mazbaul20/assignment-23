@extends('frontend.layout.sidenav-layout')
@section('content')
    @include('frontend.components.income.income-list')
    @include('frontend.components.income.income-delete')
    @include('frontend.components.income.income-create')
    @include('frontend.components.income.income-update')
@endsection