@extends('errors::minimal')

@section('title', __('Prohibido'))
@section('code', '403')
@section('message',
    __(
    $exception->getMessage() ?:
    '"Shh... Parece que esta historia no es para ti. No tienes permiso
    para acceder a este capítulo."',
    ))
