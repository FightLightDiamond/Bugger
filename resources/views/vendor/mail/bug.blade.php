{!! $content !!}

<div>
  <p>
    URL: {{ url()->current() }}
  </p>
  <p>
    Action: {{ \Illuminate\Support\Facades\Route::currentRouteAction() }}
  </p>
  <p>
    Route Name: {{ \Illuminate\Support\Facades\Route::currentRouteName() }}
  </p>
</div>