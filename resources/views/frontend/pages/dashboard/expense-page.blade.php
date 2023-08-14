@extends('frontend.layout.sidenav-layout')
@section('content')
    @include('frontend.components.expense.expense-list')
    @include('frontend.components.expense.expense-delete')
    @include('frontend.components.expense.expense-create')
    @include('frontend.components.expense.expense-update')
@endsection