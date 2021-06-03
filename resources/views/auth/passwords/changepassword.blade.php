@extends('layouts.app')

@section('content')
<changepassword-component :usuario="{{ json_encode($usuario) }}">
</changepassword-component>
@endsection