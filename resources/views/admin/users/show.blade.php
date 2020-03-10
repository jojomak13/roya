@extends('layouts.admin.master')

@section('title', __('dashboard.users.title'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('dashboard.users.title') }}</a></li>
    <li class="breadcrumb-item active">{{ $user->fullName() }}</li>
@endsection

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body text-center">
          <img class="img-fluid" src="{{ $user->profile_image }}" />
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              <span>الأسم</span>
              : {{ $user->fullName() }}
            </li>
            <li class="list-group-item">
              <span>العنوان</span>
              :
              {{ $user->address }}
            </li>
            <li class="list-group-item">
                <span>أجمالى الارباح</span>
                :
                @money($user->orders()->sum('total_price'))
                @lang('dashboard.currency')
            </li>
            <li class="list-group-item">
              <span>عدد الطلبات</span>
              :
              {{ $user->orders()->count() }}
            </li>
          </ul>
        </div>
      </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">@lang('dashboard.home.month_profit')</h5>
    </div>
    <div class="card-body">
        <div class="chart">
            <div id="monthChart" ></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">@lang('dashboard.home.profit')</h5>
    </div>
    <div class="card-body">
        <div class="chart">
            <div id="yearChart" ></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
// Start Year Profit
new Morris.Line({
    element: "yearChart",
    resize: true,
    data: [
        @foreach($yearProfit as $profit)
        { ym: "{{ $profit->year }}-{{ $profit->month }}", value: {{ $profit->total_price }} },
        @endforeach
    ],
    xkey: "ym",
    ykeys: ["value"],
    labels: ["Profit"],
    lineColors: ["#17a2b8"],
    pointFillColors: ['#28a745'],
    formatter: function(x) { return x.tolocaleString() }
});
// End Year Profit

// Start Month Profit
new Morris.Line({
    element: "monthChart",
    resize: true,
    data: [
        @foreach($monthProfit as $profit)
        { ym: "{{ $profit->year }}-{{ $profit->month }}-{{ $profit->day }}", value: {{ $profit->total_price }} },
        @endforeach
    ],
    xkey: "ym",
    ykeys: ["value"],
    labels: ["revenues"],
    lineColors: ["#17a2b8"],
    pointFillColors: ['#28a745'],
    formatter: function(x) { return x.tolocaleString() }
});
// End Month Profit
</script>
@endsection