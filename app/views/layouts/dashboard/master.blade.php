<html>
<head>
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker3.css" />
    @if(Config::get('syntara::config.direction') === 'rtl')
    <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/bootstrap-rtl.min.css') }}"
          media="all">
    <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base-rtl.css') }}" media="all">
    @endif
    <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/toggle-switch.css') }}"/>

    <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base.css') }}" media="all">
    @if(Config::get('syntara::config.direction') === 'rtl')
    <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base-rtl.css') }}" media="all">
    @endif

    @if (!empty($favicon))
    <link rel="icon"
    {{ !empty($faviconType) ? 'type="' . $faviconType . '"' : '' }} href="{{ $favicon }}" />
    @endif

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/base.js') }}"></script>
    <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <title>{{ (!empty($siteName)) ? $siteName : "Syntara"}} - {{isset($title) ? $title : '' }}</title>
    <style>
        /*.btn-syntara{background: #b94a48; color:#fff;}*/
        .alert{margin: 20px 0 0 0;}
        .item-remove-form{display: inline-table;}
        .btn-margin{margin-right: 5px;}
    </style>
</head>
<body>
@include(Config::get('syntara::views.header'))
{{ isset($breadcrumb) ? Breadcrumbs::create($breadcrumb) : ''; }}

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- will be used to show any messages -->
                @if(Session::has('message'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('message') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    @yield('content')
</div>
</body>
</html>
