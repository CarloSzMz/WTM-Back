@extends('layout.styles')

<div class="container mt-4">
    <div class="d-block mx-auto mb-2 mt-4">
        <h2> Página de {{ $user->name }} </h2>
        <h4>Email: {{ $user->email }}</h4>
        <h5>País: {{ $user->pais }}</h5>
        <h5>Provincia: {{ $user->provincia }}</h5>
        <h5>Calle: {{ $user->calle }}</h5>
        <button><a href="./">Volver</a></button>
    </div>
</div>
