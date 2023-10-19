<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link href="{{ asset('/inspinia/plugins/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/inspinia/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('/inspinia/plugins/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('/inspinia/plugins/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ asset('/inspinia/plugins/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/inspinia/plugins/css/style.css') }}" rel="stylesheet">

    @stack('css')

</head>

<body>
   
    <div id="wrapper">
        {{-- sidebar --}}
        @includeIf('layouts.partials.sidebar')

        {{-- content --}}
        <div id="page-wrapper" class="gray-bg dashbard-1">
            {{-- header-balok-atas --}}
            @includeIf('layouts.partials.header')
        
            {{-- content-section-1 welcome amelia
            <div class="row  border-bottom white-bg dashboard-header">
                    <div class="col-md-3">
                        <h2>Welcome Amelia</h2>
                        <small>You have 42 messages and 6 notifications.</small>
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="pull-right">
                                    09:00 pm
                                </span>
                                <span class="label label-success">1</span> Please contact me
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    10:16 am
                                </span>
                                <span class="label label-info">2</span> Sign a contract
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    08:22 pm
                                </span>
                                <span class="label label-primary">3</span> Open new shop
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    11:06 pm
                                </span>
                                <span class="label label-default">4</span> Call back to Sylvia
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    12:00 am
                                </span>
                                <span class="label label-primary">5</span> Write a letter to Sandra
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="flot-chart dashboard-chart">
                            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                        </div>
                        <div class="row text-left">
                            <div class="col-xs-4">
                                <div class=" m-l-md">
                                <span class="h4 font-bold m-t block">$ 406,100</span>
                                <small class="text-muted m-b block">Sales marketing report</small>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <span class="h4 font-bold m-t block">$ 150,401</span>
                                <small class="text-muted m-b block">Annual sales revenue</small>
                            </div>
                            <div class="col-xs-4">
                                <span class="h4 font-bold m-t block">$ 16,822</span>
                                <small class="text-muted m-b block">Half-year revenue margin</small>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistic-box">
                        <h4>
                            Project Beta progress
                        </h4>
                        <p>
                            You have two project with not compleated task.
                        </p>
                            <div class="row text-center">
                                <div class="col-lg-6">
                                    <canvas id="doughnutChart2" width="80" height="80" style="margin: 18px auto 0"></canvas>
                                    <h5 >Kolter</h5>
                                </div>
                                <div class="col-lg-6">
                                    <canvas id="doughnutChart" width="80" height="80" style="margin: 18px auto 0"></canvas>
                                    <h5 >Maxtor</h5>
                                </div>
                            </div>
                            <div class="m-t">
                                <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                            </div>
                        </div>
                    </div>
            </div> --}}

            <section class="content">
                <div class="row">
                    @yield('content')
                    
                </div>
            </section>

            {{-- content-section-2 --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="row">                             
                            
                        </div>
                    </div>

                    {{-- footer --}}
                    @includeIf('layouts.partials.footer')
                    
                </div>
            </div>
        </div>

        {{-- bottom-right-messages-content --}}
        <div class="small-chat-box fadeInRight animated">
            <div class="heading" draggable="true">
                <small class="chat-date pull-right">
                    02.19.2015
                </small>
                Small chat
            </div>
            <div class="content">
                <div class="left">
                    <div class="author-name">
                        Monica Jackson <small class="chat-date">
                        10:02 am
                    </small>
                    </div>
                    <div class="chat-message active">
                        Lorem Ipsum is simply dummy text input.
                    </div>
                </div>
                <div class="right">
                    <div class="author-name">
                        Mick Smith
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        Lorem Ipsum is simpl.
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Alice Novak
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        Check this stock char.
                    </div>
                </div>
                <div class="right">
                    <div class="author-name">
                        Anna Lamson
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        The standard chunk of Lorem Ipsum
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Mick Lane
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        I belive that. Lorem Ipsum is simply dummy text.
                    </div>
                </div>
            </div>
            <div class="form-chat">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
                </button> </span></div>
            </div>
        </div>

        

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('/inspinia/plugins/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('/inspinia/plugins/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('/inspinia/plugins/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('/inspinia/plugins/js/inspinia.js') }}"></script>
    <script src="{{ asset('/inspinia/plugins/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('/inspinia/plugins/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('/inspinia/plugins/js/plugins/toastr/toastr.min.js') }}"></script>

{{-- flot --}}
    @stack('scripts')

</body>
</html>
