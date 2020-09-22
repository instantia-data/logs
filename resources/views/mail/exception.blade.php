@extends(config('view.themes.email'))

@section('content')
<div style="padding: 0; color: #333 !important;">
    <h1>Exception from {{ env('APP_NAME') }}</h1>
    <h2>Environment {{ env('APP_ENV') }} @ {{ env('APP_URL') }}</h2>
    <p>IP: {{$ip}} - url: {{$url}}</p>
    <p>
        <b>File:</b> {!! $error_file !!}
        <br />
        <b>Line:</b> {!! $error_line !!}
        <br />
        <b>Class:</b> {!! $error_class !!}
        <br />
        <b>Message:</b> {!! $error_message !!}
        <br />
        <b>Url:</b> {!! $url !!}
    </p>
    @if(user() != null)
    <h2>Action</h2>
    <p>
        <b>Controller:</b> {!! request()->route()->getAction()['controller'] !!}
        <br />
        <b>Prefix:</b> {!! request()->route()->getAction()['prefix'] !!}
    </p>
    <h3>Middlewares</h3>
    {!! implode('<br />', request()->route()->middleware()) !!}
    <hr />
    @endif
    
    @if(user() != null)
    <h2>User {{user()->id}} {{user()->username}}</h2>
    <p>{{user()->email}}</p>
    @endif
</div>
{!! $content !!}

@endsection