@component('mail::message')
<div style="direction:{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    {{-- Start logo --}}
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid" src="{{ asset('user/images/logo.png') }}">
            </div>
        </div>
    </div>
    {{-- End logo --}}

    <h3>فاتورة شراء</h3>
    <p>تمت عملية الشراء بنجاح, شكرا لتعاملك مع مكتبة رؤية</p>

    <strong>@lang('dashboard.orders.code')</strong>
    :
    {{ $order->barcode }}

    @component('mail::table')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('dashboard.orders.product')</th>
                <th>@lang('dashboard.orders.quantity')</th>
                <th>@lang('dashboard.orders.price')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->{lang('name')} }}</td>
                <td>{{ $product->quantity }}</td>
                <td>@money($product->price)</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">@lang('dashboard.orders.total_price')</td>
                <td>@money($order->total_price) @lang('dashboard.currency')</td>
            </tr>
        </tbody>
    </table>
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
</div>
@endcomponent
