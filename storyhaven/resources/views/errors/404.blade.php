@extends('errors::minimal')

@section('title', __('No encontrado'))
@section('code', '404')
@section('message',
    __('"Oops... Esta página es como un pergamino perdido en el tiempo. No pudimos encontrar lo que
    buscabas."'))
