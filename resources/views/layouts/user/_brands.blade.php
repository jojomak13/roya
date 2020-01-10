<!-- Start brands -->
<section class="brands">
    <div class="container">
        <div id="brands" class="owl-carousel owl-theme">
            @foreach($brands as $brand)
            <div class="ietm brand">
                <img data-src="{{ url('storage/'.$brand->image) }}" class="owl-lazy" alt="{{ $brand->{lang('name')} }}" title="{{ $brand->{lang('name')} }}">
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End brands -->