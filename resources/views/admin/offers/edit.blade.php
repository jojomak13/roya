@extends('layouts.admin.master')

@section('title', __('dashboard.offers.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.offers.index') }}">{{ __('dashboard.offers.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.offers.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name_en">{{ __('dashboard.offers.name_en') }}</label>
                <input type="text" value="{{ $offer->name_en }}" autofocus
                    class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en">
                @error('name_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ar">{{ __('dashboard.offers.name_ar') }}</label>
                <input type="text" value="{{ $offer->name_ar }}"
                    class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" name="name_ar">
                @error('name_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('dashboard.offers.image') }}</label>
                <input type="file"
                    class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ url('storage/'.$offer->image) }}" class="img-thumbnail img-fluid">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
