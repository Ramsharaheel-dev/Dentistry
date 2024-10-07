@extends ('layouts.user_layout')

@section('head')
    <title>Billing &#8211; Dian</title>
@endsection

<style>
    /* img,
    svg {
        vertical-align: middle;
        width: 100% !important;
    } */
    tr,
    td {
        background-color: transparent !important;
    }

    tbody {
        background-color: transparent !important;
    }

    .table thead th {
        font-size: 26px !important;
    }
</style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <div class="products mb-3 anek-telugu">
                            @if ($user->profilePic != '-' && $user->profilePic != null)
                                <img class="profileImage" id="uploadPic"
                                    src="https://dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $user->profilePic }}"
                                    alt="Image">
                            @elseif ($user->profilePic == '-' || $user->profilePic == null)
                                <img class="profileImage" id="uploadPic" src="{{ asset('images/general/profile.png') }}">
                            @endif
                            <div>
                                <h6><a href="javascript:void(0)">{{ $user->name }} /Billing</a></h6>
                                <span>Set up your Dian Club presence and hiring needs</span>
                            </div>
                        </div>
                        <ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a href="{{ route('subscriptionPlans') }}">
                                    <button class="nav-link"> <span style="color: #b79150">Upgrade</span> your
                                        account</button></a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-md-12">
                        <div class="box">
                            <div class="text-center">
                                <p class="selected-videos">{{ strtoupper($packageName) ?? '' }} ACTIVE</p>
                                <span class="fs-16">{{ $startDate ?? '' }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($billingHistory->isnotEmpty())
                        @foreach ($billingHistory as $activeRecord)
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="text-center">
                                        <p class="selected-videos">{{ strtoupper($activeRecord->packageName) ?? '' }}
                                            @if ($activeRecord->status == 'active')
                                                Active
                                            @else
                                                Cancelled
                                            @endif
                                        </p>
                                        <span
                                            class="fs-16">{{ $activeRecord->status == 'active' ? \Carbon\Carbon::createFromTimestamp($activeRecord->startDate)->format('F jS, Y g:i A') : \Carbon\Carbon::parse($activeRecord->endDate)->format('F jS, Y g:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class=" py-4">
                    <div class="card bg-transparent border-0">
                        <p class="speech_to_ py-3 ">Order History</p>
                        <table id="user_table" class=" user_table table table-striped" style="width:100%">
                            <thead class="custom-bg">
                                <tr>
                                    <th>DATE</th>
                                    <th>TYPE</th>
                                    <th>RECEIPT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($billingHistory->isNotempty())
                                    @foreach ($billingHistory as $activeRecord)
                                        @if ($activeRecord->status == 'active')
                                            <tr>
                                                <td>{{ \Carbon\Carbon::createFromTimestamp($activeRecord->startDate)->format('F jS, Y') }}
                                                </td>
                                                <td>{{ strtoupper($activeRecord->packageName) }}</td>
                                                <td> <a target="_blank"
                                                        href="{{ route('invoice.html', ['startDate' => $activeRecord->startDate, 'packageName' => $activeRecord->packageName]) }}">HTML</a>
                                                    |
                                                    <a target="_blank"
                                                        href="{{ route('invoice.pdf', ['startDate' => $activeRecord->startDate, 'packageName' => $activeRecord->packageName]) }}">PDF</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="12" class="text-center">No record</th>
                                    </tr>
                                @endif

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
