<!DOCTYPE html>
<html>
    <head>
        <mata charset="utf-8">
        <title>my routine</title>
        @include('style-sheet')
    </head>
    <body>
        @include('nav')
        <div class='container'>
        @yield('content')
        
        </div>
        <p>@extends('bottom')</p>
    </body>
</html>