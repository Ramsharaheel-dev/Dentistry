@extends ('layouts.cms_layout')

@section('head')
    <title>CMS CONTENT UPLOAD &#8211; DIAN</title>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> --}}
@endsection

<style>
    .dropzone {
        border: 2px dashed #D6A858;
        padding: 20px;
        cursor: pointer;
        min-height: 250px;
        border-style: dashed;
        /* margin: 2rem 0; */
        border-radius: 20px;
    }

    button:hover {
        cursor: pointer;
    }

    .d-files {
        color: #FFF;
        /* font-family: "Anek Telugu"; */
        font-size: 25px;
        text-align: center;
        font-weight: 600;
        line-height: 40px;
        text-transform: capitalize;
    }

    .preview-container {
        margin-top: 20px;
    }

    .preview {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .preview img {
        max-width: 100px;
        max-height: 100px;
    }

    .preview .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: transparent;
        color: black;
        border: none;
        border-radius: 50%;
        cursor: pointer;
    }

    .custom-badge {
        font-size: 16px;
        color: wheat;
        margin-right: 10px;
        padding: 6px 32px;

    }

    .m-10 {
        margin: 10px 11px 0px 10px;
    }

    .white {
        color: white !important;
        font-weight: bold !important;
    }

    .white2 {
        color: white !important;
        font-weight: bold !important;
        font-size: 18px;
    }

    .your_perso1 {
        font-size: 32px !important;
    }

    .heading-color {
        font-size: 26px;
        font-weight: 600;
    }

    .name-div {
        display: none;
    }

    table {
        color: white
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: white !important;
        font-weight: bold;
    }

    [data-theme-version="dark"] .paging_simple_numbers.dataTables_paginate {
        background: #182237;
        display: none;
    }

    h3.custom-h3 {
        text-align: center;
        font-size: 26px;
        font-weight: bold;
        text-transform: uppercase;
    }

    h4.custom-h4 {
        font-size: 26px;
        text-transform: capitalize;
        text-align: center;
    }

    .tab-bg {
        background-color: #091A29;
        padding: 40px;
        border-radius: 20px;
    }
</style>

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card-header border-0 pb-0 flex-wrap">
                <div class="products mb-3 anek-telugu">
                    <div>
                        <p class="your_perso1">Analytics</p>
                    </div>
                </div>
            </div>

            <div class="tab-container">
                <div class="tabs">
                    <button class="tab active" data-tab="all_subscriptions">All Subscriptions</button>
                    <button class="tab " data-tab="starter">Starter</button>
                    <button class="tab" data-tab="student">Student</button>
                    <button class="tab" data-tab="premium">Premium</button>
                    <button class="tab" data-tab="dentistryOwner">Dentistry Owner</button>
                </div>

                <div class="tab-content" id="all_subscriptions">
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="subscriptionsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="starter" style="display: none;">
                    <h3 class="custom-h3">Starter Plan Users</h3>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Starter Monthly (Total:
                            {{ $totalsByPlan['starter'] }})</h4>

                        <table id="starterTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['starter'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Starter Yearly (Total:
                            {{ $totalsByPlan['starterYearly'] }})</h4>
                        <table id="starterYearlyTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['starterYearly'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Repeat similar blocks for Student, Premium, Dentistry Owner plans -->


                <div class="tab-content" id="student" style="display: none;">
                    <h3 class="custom-h3">Student Plan Users</h3>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Student Monthly (Total:
                            {{ $totalsByPlan['student'] }})</h4>

                        <table id="studentTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['student'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Student Yearly (Total:
                            {{ $totalsByPlan['studentYearly'] }})</h4>
                        <table id="studentYearlyTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['studentYearly'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-content" id="premium" style="display: none;">
                    <h3 class="custom-h3">Premium Plan Users</h3>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Premium Monthly (Total:
                            {{ $totalsByPlan['premium'] }})</h4>

                        <table id="premiumTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['premium'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Premium Yearly (Total:
                            {{ $totalsByPlan['premiumYearly'] }})</h4>
                        <table id="premiumYearlyTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['premiumYearly'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-content" id="dentistryOwner" style="display: none;">
                    <h3 class="custom-h3">Dentistry Owner Plan Users</h3>
                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Dentistry Owner Monthly (Total:
                            {{ $totalsByPlan['dentistryOwner'] }})</h4>

                        <table id="dentistryOwnerTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['dentistryOwner'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-bg py-4 mt-4">
                        <h4 class="custom-h4" style="color: #D6A858;">Dentistry Owner Yearly (Total:
                            {{ $totalsByPlan['dentistryOwnerYearly'] }})</h4>
                        <table id="dentistryOwnerYearlyTable" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersByPlan['dentistryOwnerYearly'] ?? [] as $user)
                                    <tr>
                                        <td>
                                            @if (!empty($user->firstName) || !empty($user->lastName))
                                                {{ $user->firstName ?? '' }} {{ $user->lastName ?? '' }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->startDate) || ($user->startDate == '-'))
                                                {{ \Carbon\Carbon::createFromTimestamp($user->startDate)->format('d M Y h:i A') }}
                                            @else
                                                Not Available
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('customjs')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const target = tab.getAttribute('data-tab');

                    contents.forEach(content => {
                        if (content.id === target) {
                            content.style.display = 'block';
                        } else {
                            content.style.display = 'none';
                        }
                    });
                });
            });

            // Initialize DataTables for each table
            $('#starterTable').DataTable();
            $('#starterYearlyTable').DataTable();
            $('#studentTable').DataTable();
            $('#studentYearlyTable').DataTable();
            $('#premiumTable').DataTable();
            $('#premiumYearlyTable').DataTable();
            $('#dentistryOwnerTable').DataTable();
            $('#dentistryOwnerYearlyTable').DataTable();

            // Render the chart
            const ctx = document.getElementById('subscriptionsChart').getContext('2d');
            const subscriptionsData = @json($subscriptions);
            const chartData = {
                labels: subscriptionsData.map(subscription => subscription.name),
                datasets: [{
                    label: 'Subscription Percentages',
                    data: subscriptionsData.map(subscription => subscription.percentage),
                    backgroundColor: [
                        '#091A29',
                        '#ffffff',
                        '#091A29',
                        '#ffffff'
                    ],
                    borderWidth: 1
                }]
            };

            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Percentage (%)',
                                color: '#FFFFFF' // Color for Y-axis title
                            },
                            ticks: {
                                color: '#FFFFFF' // Color for Y-axis labels
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Subscription Plans',
                                color: '#FFFFFF' // Color for X-axis title
                            },
                            ticks: {
                                color: '#FFFFFF' // Color for X-axis labels (titles)
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#FFFFFF' // Color for legend labels
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
