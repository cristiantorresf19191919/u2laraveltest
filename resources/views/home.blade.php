@extends('layouts.app')
@php

    $id = auth()->user()->id;
    setcookie("idusuariologueado", $id);
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5>autenticado con exito!</h5>
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <parent-component></parent-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

