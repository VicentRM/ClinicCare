@extends("layouts.plantilla")

@section("contenido")
@php
        if ($user->avatar=='') $avatar = "/storage/avatars/avatarDefecto.jpg";
        else $avatar = $user->avatar;
@endphp

         <dashboard-component :user="{{ json_encode($user) }}" :avatar="{{ json_encode($avatar) }}"></dashboard-component>



@endsection
