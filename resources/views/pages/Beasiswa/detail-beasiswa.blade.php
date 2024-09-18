@extends('layouts.main')
@section('content')
    @include('component.navbar')
    <h2>Welcome to the Main Page</h2>
    <p>This is the content of the main page. It will be injected into the `@yield('content')` section of the layout.</p>
@endsection