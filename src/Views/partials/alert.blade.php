@if(Session::has('chatter_alert'))
    <div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
        <div class="container">
            <strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> @lang('chatter::alert.' . Session::get('chatter_alert_type') . '.title')</strong>
            {{ Session::get('chatter_alert') }}
            <i class="chatter-close"></i>
        </div>
    </div>
    <div class="chatter-alert-spacer"></div>
@endif

@if (count($errors) > 0)
    <div class="chatter-alert alert alert-danger">
        <div class="container">
            <p><strong><i class="chatter-alert-danger"></i> @lang('chatter::alert.danger.title')</strong> @lang('chatter::alert.danger.reason.errors')</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
