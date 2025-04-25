@php use Illuminate\Support\Facades\Session; @endphp

<style>
    .alert.alert-danger > ul {
        margin-bottom: 0;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('validate-errors', false))
    @php
        $errors = Session::get('validate-errors');
        Session::forget('validate-errors');
    @endphp

    @foreach ($errors->getMessages() as $error)
        <div class="alert alert-danger" role="alert">
            {!! implode('</br>', $error) !!}
        </div>
    @endforeach
@endif


@if(Session::get('success', false))
    @php
        $data = Session::get('success');
        Session::forget('success');
    @endphp

    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            {{ $data }}
        </div>
    @endif
@endif

@if(Session::get('status', false))
    @php
        $data = Session::get('status');
        Session::forget('status');
    @endphp

    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-danger" role="alert">
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
            {{ $data }}
        </div>
    @endif
@endif

@if(Session::get('error', false))
    @php
        $data = Session::get('error');
        Session::forget('error');
    @endphp

    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-danger" role="alert">
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" role="alert">
            {{ $data }}
        </div>
    @endif
@endif
