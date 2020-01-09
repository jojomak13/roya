@extends('layouts.admin.master')

@section('title', __('dashboard.products.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('dashboard.products.title') }}</a></li>
<li class="breadcrumb-item active">{{ __('dashboard.products.edit') }}</li>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.min.css') }}">
@endsection

@section('content')
<form autocomplete="off" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <section class="card">
                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name_en">{{ __('dashboard.products.name_en') }}</label>
                            <input type="text" value="{{ $product->name_en }}" autofocus
                                class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                name="name_en">
                            @error('name_en')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="name_ar">{{ __('dashboard.products.name_ar') }}</label>
                            <input type="text" value="{{ $product->name_ar }}"
                                class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar">
                            @error('name_ar')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="buy_price">{{ __('dashboard.products.buy_price') }}</label>
                            <input type="number" step="any" min="1" value="{{ $product->buy_price }}"
                                class="form-control @error('buy_price') is-invalid @enderror" id="buy_price" name="buy_price">
                            @error('buy_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="sell_price">{{ __('dashboard.products.sell_price') }}</label>
                            <input type="number" step="any" min="1" value="{{ $product->sell_price }}"
                                class="form-control @error('sell_price') is-invalid @enderror" id="sell_price" name="sell_price">
                            @error('sell_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="discount">{{ __('dashboard.products.discount') }}</label>
                            <input type="number" step="any" min="0" max="100" value="{{ $product->discount }}"
                                class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount">
                            @error('discount')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="offer_id">{{ __('dashboard.products.offer') }}</label>
                            <select class="form-control @error('offer_id') is-invalid @enderror" id="offer_id" name="offer_id">
                                <option value="">{{ __('dashboard.products.select_offer') }}</option>
                                @foreach ($offers as $offer)
                                <option {{ $product->offer_id == $offer->id? 'selected':'' }} value="{{ $offer->id }}">{{ $offer->{lang('name')} }}</option>
                                @endforeach
                            </select>
                            @error('offer_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="user_id">{{ __('dashboard.products.owner') }}</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">{{ __('dashboard.products.select_owner') }}</option>
                                @foreach ($users as $user)
                                <option {{ $product->user_id == $user->id? 'selected':'' }} value="{{ $user->id }}">{{ $user->fullName() }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="category_id">{{ __('dashboard.products.category') }}</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">{{ __('dashboard.products.select_category') }}</option>
                                @foreach ($categories as $cat)
                                <option {{ $product->category_id == $cat->id? 'selected':'' }} value="{{ $cat->id }}">{{ $cat->{lang('name')} }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="description_en">{{ __('dashboard.products.description_en') }}</label>
                            <textarea id="desc_en" class="form-control @error('description_en') is-invalid @enderror" id="description_en"
                                name="description_en">{{ $product->description_en }}</textarea>
                            @error('description_en')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="description_ar">{{ __('dashboard.products.description_ar') }}</label>
                            <textarea id="desc_ar" class="form-control @error('description_ar') is-invalid @enderror" id="description_ar"
                                name="description_ar">{{ $product->description_ar }}</textarea>
                            @error('description_ar')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="owl-carousel owl-theme">
                        @foreach($product->images as $image)
                        <div class="item product-box">
                            <button data-image="{{ $image->id }}" class="deleteImage btn btn-danger"><i class="fa fa-trash"></i></button>
                            <img src="{{ url('storage/'. $image->url) }}">
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group mt-2">
                        <label for="images">{{ __('dashboard.products.images') }}</label>
                        <input type="file" id="uploader" multiple
                            class="form-control @error('images') is-invalid @enderror" id="images" name="images[]">
                        @error('images')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">{{ __('dashboard.products.weight') }}</label>
                        <input type="number" step="any" value="{{ $product->weight }}"
                            class="form-control @error('weight') is-invalid @enderror" min="1" id="weight" name="weight">
                        @error('weight')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color">{{ __('dashboard.products.color') }}</label>
                        <select name="color" id="color" class="form-control @error('color') is-invalid @enderror">
                            @foreach(\App\Product::colors() as $color => $code)
                            <option {{ $product->color == $color? 'selected': '' }} value="{{ $color }}" style="background:{{ $code }}"></option>
                            @endforeach
                        </select>
                        @error('color')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('dashboard.products.status') }}</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">None</option>
                            @foreach(\App\Product::status() as $key => $value)
                            <option {{ $product->status == $key? 'selected':'' }} value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{ __('dashboard.products.quantity') }}</label>
                        <input type="number" value="{{ $product->stores->first()->pivot->quantity }}"
                            class="form-control @error('quantity') is-invalid @enderror" min="1" id="quantity" name="quantity">
                        @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stores">{{ __('dashboard.products.stores') }}</label>
                        <select name="stores" id="stores" class="form-control @error('stores') is-invalid @enderror">
                            @foreach($stores as $store)
                            <option {{ $product->stores->first()->id == $store->id? 'selected':'' }} value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        @error('stores')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</form>
@endsection

@section('script')
<script src="{{ asset('admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
<script>
CKEDITOR.replace(document.getElementById('desc_en'))
CKEDITOR.replace(document.getElementById('desc_ar'))
$(window).on('load',function() { 
    $('.owl-carousel').owlCarousel({
        items: 1,
        rtl: true
    })

    $('.deleteImage').on('click', function(e){
        e.preventDefault();
        let id = $(this).data('image');
        $.ajax({
            url: `{{ LaravelLocalization::localizeUrl('/dashboard/images') }}/`+id,
            method: 'POST',
            data: {
                '_method': 'DELETE',
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: () => location.reload()
        })
    })
})
</script>
@endsection