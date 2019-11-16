@extends('layouts.admin.master')

@section('title', __('dashboard.products.create'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('dashboard.products.title') }}</a></li>
<li class="breadcrumb-item active">{{ __('dashboard.products.create') }}</li>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <section class="card">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">{{ __('dashboard.products.name') }}</label>
                            <input type="text" value="{{ old('name') }}" autofocus
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="buy_price">{{ __('dashboard.products.buy_price') }}</label>
                            <input type="number" min="1" value="{{ old('buy_price') }}"
                                class="form-control @error('buy_price') is-invalid @enderror" id="buy_price" name="buy_price">
                            @error('buy_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="sell_price">{{ __('dashboard.products.sell_price') }}</label>
                            <input type="number" min="1" value="{{ old('sell_price') }}"
                                class="form-control @error('sell_price') is-invalid @enderror" id="sell_price" name="sell_price">
                            @error('sell_price')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="user_id">{{ __('dashboard.products.owner') }}</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">{{ __('dashboard.products.select_owner') }}</option>
                                @foreach ($users as $user)
                                <option {{ old('user_id') == $user->id? 'selected':'' }} value="{{ $user->id }}">{{ $user->fullName() }}</option>
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
                                <option {{ old('category_id') == $cat->id? 'selected':'' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="description">{{ __('dashboard.products.description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
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
                    <div class="image text-center">
                        <img class="img-fluid" id="preview" src="{{ asset('admin/images/product.jpg') }}">
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
                        <input type="number" value="{{ old('weight') }}"
                            class="form-control @error('weight') is-invalid @enderror" min="1" id="weight" name="weight">
                        @error('weight')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</form>
@endsection