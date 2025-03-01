@extends('errors::minimal')

@section('title', __('Sesión Expirada'))
@section('code', '419')
@section('message',
    __('"El tiempo ha borrado tu sesión, como tinta desvaneciéndose en un viejo manuscrito. Por favor,
    vuelve a iniciar sesión."'))
