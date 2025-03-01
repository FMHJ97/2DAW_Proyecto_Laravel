@extends('errors::minimal')

@section('title', __('Demasiadas Solicitudes'))
@section('code', '429')
@section('message',
    __('"¡Tranquilo, escritor incansable! Has hecho demasiadas peticiones en poco tiempo. Tómate un
    respiro y vuelve a intentarlo en un momento."'))
