<!DOCTYPE html>
<html>

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cool.css') }}">

</head>

<body>

@include('layouts/navbar')

@include('layouts/blog_masthead')

@yield('content')

<hr/>
@include('layouts/footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
{{--Script für Navbar--}}
<script src="{{ asset('js/clean-blog.min.js') }}"></script>
{{--CKEditor--}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('summary-ckeditor');
</script>
{{--Script für mastheader--}}
<script src="{{asset('js/masthead.js')}}"></script>
{{--Ajax Comment löschen--}}
<script src="{{asset('js/deleteComment.js')}}"></script>

</body>

</html>
