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
            margin-bottom: 25px;
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
            transition: all 0.3s ease;
        }

        .chart-controls select:hover {
            border-color: #4e73df;
        }

        .chart-controls select:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
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

        <!-- Stats Cards -->
        <div class="stats-row mt-2">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total Users</h3>
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-label">All time</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Today's Signups</h3>
                    <div class="stat-number">{{ $todaySignups }}</div>
                    <div class="stat-label">{{ now()->format('M d, Y') }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>This Week</h3>
                    <div class="stat-number">{{ $weekSignups }}</div>
                    <div class="stat-label">{{ now()->startOfWeek()->format('M d') }} -
                        {{ now()->endOfWeek()->format('M d') }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>This Month</h3>
                    <div class="stat-number">{{ $monthSignups }}</div>
                    <div class="stat-label">{{ now()->format('F Y') }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-section">
            <div class="chart-header">
                <h3>
                    <i class="fas fa-chart-line"></i>
                    User Signups - <span id="timeframe-title">{{ $title }}</span>
                </h3>
                <div class="chart-controls">
                    <select id="chart-timeframe" onchange="changeTimeframe(this.value)">
                        <option value="monthly" {{ $timeframe == 'monthly' ? 'selected' : '' }}>Monthly View</option>
                        <option value="weekly" {{ $timeframe == 'weekly' ? 'selected' : '' }}>Weekly View (Last 7 Days)
                        </option>
                    </select>
                </div>
            </div>

            <div id="user-signup-chart"></div>

            <!-- Summary Cards -->
            <!-- Summary Cards -->
            {{-- <div class="summary-row">
                <div class="summary-card">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Total in Period</h4>
                    <div class="summary-value" id="total-in-period">{{ $counts->sum() }}</div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-arrow-up"></i>
                    <h4>Average per Day/Week</h4>
                    <div class="summary-value" id="average-value">
                        {{ $counts->isNotEmpty() ? round($counts->sum() / $counts->count(), 1) : 0 }}
                    </div>
                </div>
                <div class="summary-card">
                    <i class="fas fa-calendar-day"></i>
                    <h4>Peak Day</h4>
                    <div class="summary-value" id="peak-value">
                        {{ $counts->isNotEmpty() ? $counts->max() : 0 }}
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('plugins/vendors/d3/d3.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/c3-master/c3.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('plugins/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/morrisjs/morris.js') }}"></script>
    <script src="{{ asset('plugins/vendors/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script>
        let currentChart = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Get initial data
            var labels = @json($labels ?? []);
            var counts = @json($counts ?? []);

            // Create the chart
            createChart(labels, counts);

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

        function createChart(labels, counts) {
            if (!labels.length || !counts.length) {
                document.getElementById('user-signup-chart').innerHTML =
                    '<div class="no-data-message">' +
                    '<i class="fas fa-chart-pie"></i>' +
                    '<h4>No Data Available</h4>' +
                    '<p>There are no user signups to display for this period.</p>' +
                    '</div>';
                return;
            }

            // Calculate cumulative total
            var cumulative = [];
            var sum = 0;
            counts.forEach(function(count) {
                sum += count;
                cumulative.push(sum);
            });

            // Calculate max values
            var maxCount = Math.max(...counts);
            var maxCumulative = Math.max(...cumulative);

            // Destroy existing chart if it exists
            if (currentChart) {
                currentChart = currentChart.destroy();
            }

            // Create new chart
            currentChart = c3.generate({
                bindto: '#user-signup-chart',
                data: {
                    columns: [
                        ['Signups', ...counts],
                        ['Cumulative Users', ...cumulative]
                    ],
                    types: {
                        'Signups': 'bar',
                        'Cumulative Users': 'line'
                    },
                    axes: {
                        'Cumulative Users': 'y2'
                    },
                    names: {
                        'Signups': 'User Signups',
                        'Cumulative Users': 'Total Users'
                    },
                    colors: {
                        'Signups': '#4e73df',
                        'Cumulative Users': '#1cc88a'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        categories: labels,
                        tick: {
                            rotate: 0,
                            multiline: false,
                            culling: {
                                max: 8
                            }
                        },
                        label: {
                            text: document.getElementById('chart-timeframe').value === 'weekly' ? 'Days' : 'Months',
                            position: 'outer-center'
                        },
                        height: 50
                    },
                    y: {
                        label: {
                            text: 'User Signups',
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
                        show: true
                    }
                },
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    format: {
                        title: function(d) {
                            return labels[d];
                        },
                        value: function(value, ratio, id) {
                            return value + ' user' + (value !== 1 ? 's' : '');
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

            // Update summary cards
            updateSummaryCards(counts);
        }

        function updateSummaryCards(counts) {
            if (counts.length > 0) {
                var total = counts.reduce((a, b) => a + b, 0);
                var average = (total / counts.length).toFixed(1);
                var peak = Math.max(...counts);

                document.getElementById('total-in-period').textContent = total;
                document.getElementById('average-value').textContent = average;
                document.getElementById('peak-value').textContent = peak;
            }
        }

        function changeTimeframe(timeframe) {
            // Show loading state
            document.getElementById('user-signup-chart').innerHTML =
                '<div class="chart-loading">' +
                '<i class="fas fa-spinner fa-spin"></i>' +
                '<p>Loading data...</p>' +
                '</div>';

            // Make AJAX request
            $.ajax({
                url: '{{ route('admin.dashboard.data') }}',
                type: 'GET',
                data: {
                    timeframe: timeframe
                },
                success: function(response) {
                    // Update title
                    document.getElementById('timeframe-title').textContent =
                        timeframe === 'weekly' ? 'Last 7 Days' : 'Monthly';

                    // Create new chart with the response data
                    createChart(response.labels, response.counts);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    $.toast({
                        heading: 'Error',
                        text: 'Failed to load data. Please try again.',
                        position: 'top-right',
                        loaderBg: '#e74a3b',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 6
                    });
                }
            });
        }
    </script>
@endpush
