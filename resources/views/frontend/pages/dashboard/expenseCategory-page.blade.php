@extends('frontend.layout.sidenav-layout')
@section('content')
    @include('frontend.components.expenseCategory.expenseCategory-list')
    @include('frontend.components.expenseCategory.expenseCategory-delete')
    @include('frontend.components.expenseCategory.expenseCategory-create')
    @include('frontend.components.expenseCategory.expenseCategory-update')
@endsection