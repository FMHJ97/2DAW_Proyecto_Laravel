@extends('errors::minimal')

@section('title', __('Error Inteno del Servidor'))
@section('code', '500')
@section('message',
    __('"Parece que un duende travieso ha causado un problema en los engranajes de StoryHaven. Estamos
    trabajando para solucionarlo."'))
