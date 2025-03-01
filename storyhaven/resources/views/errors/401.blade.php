@extends('errors::minimal')

@section('title', __('No Autorizado'))
@section('code', '401')
@section('message',
    __('"Parece que necesitas iniciar sesión para acceder a esta historia. ¡Aventúrate con tu cuenta y
    descubre nuevos relatos!"'))
