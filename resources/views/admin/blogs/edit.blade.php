@extends('layouts.admin.master')

@section('title', __('dashboard.blogs.edit'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">{{ __('dashboard.blogs.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.blogs.edit') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title_en">{{ __('dashboard.blogs.title_en') }}</label>
                <input type="text" value="{{ $blog->title_en }}" autofocus
                    class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en">
                @error('title_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title_ar">{{ __('dashboard.blogs.title_ar') }}</label>
                <input type="text" value="{{ $blog->title_ar }}"
                    class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" name="title_ar">
                @error('title_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="user_id">{{ __('dashboard.blogs.author') }}</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="">{{ __('dashboard.blogs.select_author') }}</option>
                    @foreach ($users as $user)
                    <option {{ $blog->user_id == $user->id? 'selected':'' }} value="{{ $user->id }}">{{ $user->fullName() }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">{{ __('dashboard.blogs.image') }}</label>
                <input type="file"
                    class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ url('storage/'.$blog->image) }}" class="img-thumbnail img-fluid">
            </div>
            <div class="form-group col-12">
                <label for="content">{{ __('dashboard.blogs.content_en') }}</label>
                <textarea id="content_en" class="form-control @error('content_en') is-invalid @enderror" id="content_en"
                    name="content_en">{{ $blog->content_en }}</textarea>
                @error('content_en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="content">{{ __('dashboard.blogs.content_ar') }}</label>
                <textarea id="content_ar" class="form-control @error('content_ar') is-invalid @enderror" id="content_ar"
                    name="content_ar">{{ $blog->content_ar }}</textarea>
                @error('content_ar')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace(document.getElementById('content_en'))
    CKEDITOR.replace(document.getElementById('content_ar'))
</script>
@endsection
