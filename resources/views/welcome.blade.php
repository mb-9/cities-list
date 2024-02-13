@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center text-center" style="min-height: 40vh">
        <div class="box w-100 text-success ">
            <h1 class="title-white">Vyhľadať v databáze obcí</h1>
            <input type="text" name="term" class="fulltext-search__input" id="main_search" autocomplete="off" placeholder="Zadajte názov" value="">
        </div>
    </div>

@endsection
