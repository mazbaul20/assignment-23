@extends('frontend.layout.sidenav-layout')
@section('content')
    @include('frontend.components.incomeCategory.incomeCategory-list')
    @include('frontend.components.incomeCategory.incomeCategory-delete')
    @include('frontend.components.incomeCategory.incomeCategory-create')
    @include('frontend.components.incomeCategory.incomeCategory-update')
@endsection