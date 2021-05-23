@extends("layouts.plantilla")

@section("contenido")
@php
if (is_null($user->avatar)) $avatar = "";
else $avatar = $user->avatar;
@endphp

         <dashboard-component :user="{{ json_encode($user) }}" :avatar="{{ json_encode($avatar) }}"></dashboard-component>



@endsection
