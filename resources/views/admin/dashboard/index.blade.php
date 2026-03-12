@extends('layouts.admin.app')

@push('before-css')
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('plugins/vendors/morrisjs/morris.css') }}" rel="stylesheet">
    <!--c3 CSS -->
    <link href="{{ asset('plugins/vendors/c3-master/c3.min.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('plugins/vendors/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{ asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

    <!-- Date picker plugins css -->
    <link href="{{ asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- page css -->
    <link href="{{ asset('assets/css/pages/google-vector-map.css') }}" rel="stylesheet">
    <style>
        /* Reset and Main Container */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container-fluid {
            max-width: 100%;
            padding: 15px;
            background: #f8f9fc;
            min-height: 100vh;
            overflow: hidden;
            /* Prevent scrolling */
        }

        /* Header Section */
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            color: white;
            text-align: center;
        }

        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-header h1 i {
            margin-right: 10px;
            color: #ffd700;
        }

        .dashboard-header img {
            height: 120px;
            width: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            background: white;
            padding: 10px;
        }

        /* Stats Cards */
        .stats-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background: white;
            border-radius: 15px;
            padding: 25px 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 5px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card:nth-child(1) {
            border-left-color: #4e73df;
        }

        .stat-card:nth-child(2) {
            border-left-color: #1cc88a;
        }

        .stat-card:nth-child(3) {
            border-left-color: #36b9cc;
        }

        .stat-card:nth-child(4) {
            border-left-color: #f6c23e;
        }

        .stat-info h3 {
            font-size: 1rem;
            color: #b7b9cc;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-info .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2e384d;
            margin-bottom: 5px;
        }

        .stat-info .stat-label {
            font-size: 0.85rem;
            color: #b7b9cc;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .stat-card:nth-child(1) .stat-icon {
            background: rgba(78, 115, 223, 0.1);
            color: #4e73df;
        }

        .stat-card:nth-child(2) .stat-icon {
            background: rgba(28, 200, 138, 0.1);
            color: #1cc88a;
        }

        .stat-card:nth-child(3) .stat-icon {
            background: rgba(54, 185, 204, 0.1);
            color: #36b9cc;
        }

        .stat-card:nth-child(4) .stat-icon {
            background: rgba(246, 194, 62, 0.1);
            color: #f6c23e;
        }

        /* Chart Section */
        .chart-section {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .chart-header h3 {
            font-size: 1.5rem;
            color: #2e384d;
            font-weight: 600;
        }

        .chart-header h3 i {
            color: #4e73df;
            margin-right: 10px;
        }

        .chart-controls {
            display: flex;
            gap: 10px;
        }

        .chart-controls select {
            padding: 8px 15px;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            color: #6e707e;
            font-size: 0.9rem;
            background: #f8f9fc;
            cursor: pointer;
        }

        /* Graph Container */
        #user-signup-chart {
            height: 400px;
            width: 100%;
            margin: 0 auto;
        }

        /* Loading State */
        .chart-loading {
            text-align: center;
            padding: 50px;
            color: #b7b9cc;
        }

        .chart-loading i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* No Data Message */
        .no-data-message {
            text-align: center;
            padding: 50px;
            color: #b7b9cc;
            background: #f8f9fc;
            border-radius: 10px;
        }

        .no-data-message i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #4e73df;
        }

        /* Summary Cards */
        .summary-row {
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .summary-card {
            flex: 1;
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .summary-card i {
            font-size: 2rem;
            color: #4e73df;
            margin-bottom: 10px;
        }

        .summary-card h4 {
            font-size: 0.95rem;
            color: #b7b9cc;
            margin-bottom: 10px;
        }

        .summary-card .summary-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e384d;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-header h1 {
                font-size: 2rem;
            }

            .stats-row {
                flex-direction: column;
                gap: 15px;
            }

            .stat-card {
                width: 100%;
            }

            .summary-row {
                flex-direction: column;
                gap: 15px;
            }

            #user-signup-chart {
                height: 350px;
            }
        }

        /* Custom Scrollbar (if needed, but we're preventing scroll) */
        ::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Welcome To {{ config('app.name') }}</h1>
                <img alt="Logo" style="height: 150px; display:inline-block;" class="img-responsive"
                    src="{{ asset(!empty($logo->img_path) ? $logo->img_path : '') }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <h3 class="text-center mb-3">Monthly User</h3>
                <div id="user-signup-chart"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get data from PHP
            var months = @json($months ?? []);
            var counts = @json($counts ?? []);

            // Calculate cumulative total
            var cumulative = [];
            var sum = 0;
            counts.forEach(function(count) {
                sum += count;
                cumulative.push(sum);
            });

            // Calculate max value for better y-axis scaling
            var maxCount = Math.max(...counts);
            var maxCumulative = Math.max(...cumulative);

            // Check if data exists
            if (months.length && counts.length) {
                // Create beautiful graph
                var chart = c3.generate({
                    bindto: '#user-signup-chart',
                    data: {
                        columns: [
                            ['Monthly Signups', ...counts],
                            ['Cumulative Users', ...cumulative]
                        ],
                        types: {
                            'Monthly Signups': 'bar',
                            'Cumulative Users': 'line'
                        },
                        axes: {
                            'Cumulative Users': 'y2'
                        },
                        names: {
                            'Monthly Signups': 'Monthly Signups',
                            'Cumulative Users': 'Total Users'
                        },
                        colors: {
                            'Monthly Signups': '#4e73df',
                            'Cumulative Users': '#1cc88a'
                        }
                    },
                    axis: {
                        x: {
                            type: 'category',
                            categories: months,
                            tick: {
                                rotate: 0,
                                multiline: false,
                                culling: {
                                    max: 8
                                }
                            },
                            label: {
                                text: 'Months',
                                position: 'outer-center'
                            },
                            height: 50
                        },
                        y: {
                            label: {
                                text: 'Monthly Signups',
                                position: 'outer-middle'
                            },
                            min: 0,
                            max: maxCount + Math.ceil(maxCount * 0.1),
                            padding: {
                                top: 10,
                                bottom: 0
                            }
                        },
                        y2: {
                            show: true,
                            label: {
                                text: 'Cumulative Users',
                                position: 'outer-middle'
                            },
                            min: 0,
                            max: maxCumulative + Math.ceil(maxCumulative * 0.1)
                        }
                    },
                    bar: {
                        width: {
                            ratio: 0.6
                        },
                        space: 0.2
                    },
                    line: {
                        connectNull: true
                    },
                    point: {
                        show: true,
                        r: 4,
                        focus: {
                            expand: {
                                r: 6
                            }
                        }
                    },
                    grid: {
                        y: {
                            show: true,
                            lines: [{
                                value: 0
                            }]
                        }
                    },
                    legend: {
                        position: 'bottom',
                        item: {
                            onclick: function(id) {
                                return false;
                            }
                        }
                    },
                    tooltip: {
                        grouped: true,
                        format: {
                            title: function(d) {
                                return months[d];
                            },
                            value: function(value, ratio, id) {
                                return value + ' users';
                            }
                        }
                    },
                    size: {
                        height: 400
                    },
                    padding: {
                        right: 30,
                        left: 30,
                        bottom: 20,
                        top: 20
                    }
                });

                // Timeframe change handler
                document.getElementById('chart-timeframe').addEventListener('change', function(e) {
                    var monthsCount = parseInt(e.target.value);
                    var totalMonths = months.length;

                    if (totalMonths > monthsCount) {
                        var startIdx = totalMonths - monthsCount;
                        var filteredMonths = months.slice(startIdx);
                        var filteredCounts = counts.slice(startIdx);
                        var filteredCumulative = cumulative.slice(startIdx);

                        // Recalculate cumulative for filtered data
                        var newCumulative = [];
                        var newSum = 0;
                        filteredCounts.forEach(function(count) {
                            newSum += count;
                            newCumulative.push(newSum);
                        });

                        chart.load({
                            columns: [
                                ['Monthly Signups', ...filteredCounts],
                                ['Cumulative Users', ...newCumulative]
                            ],
                            categories: filteredMonths
                        });

                        // Update axes
                        chart.axis.max({
                            y: Math.max(...filteredCounts) + Math.ceil(Math.max(...filteredCounts) *
                                0.1),
                            y2: Math.max(...newCumulative) + Math.ceil(Math.max(...newCumulative) *
                                0.1)
                        });
                    }
                });

            } else {
                // Show no data message
                document.getElementById('user-signup-chart').innerHTML =
                    '<div class="no-data-message">' +
                    '<i class="fas fa-chart-pie"></i>' +
                    '<h4>No Data Available</h4>' +
                    '<p>There are no user signups to display at this time.</p>' +
                    '</div>';
            }

            // Initialize datepicker
            jQuery('#datepicker-inline').datepicker({
                todayHighlight: true
            });

            // Show welcome toast
            $.toast({
                heading: 'Welcome',
                text: 'Dashboard loaded successfully!',
                position: 'top-right',
                loaderBg: '#4e73df',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });

        });
    </script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--c3 JavaScript -->
    <script src="{{ asset('plugins/vendors/d3/d3.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/c3-master/c3.min.js') }}"></script>
    <!--jquery knob -->
    <script src="{{ asset('plugins/vendors/knob/jquery.knob.js') }}"></script>
    <!--Sparkline JavaScript -->
    <script src="{{ asset('plugins/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('plugins/vendors/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/morrisjs/morris.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('plugins/vendors/toast-master/js/jquery.toast.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>


    <script>
        // MAterial Date picker    

        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
    </script>

    <!-- Vector map JavaScript -->
    <script src="{{ asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Dashboard JS -->
    <script src="{{ asset('assets/js/dashboard-shop-2.js') }}"></script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endpush
