@extends('layouts.app')

@section('body')

<div class="container py-4">
    <div class="row">

        @include('partials.back-link')

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create Category
                </div>

                <div class="card-body">
                    <form action="{{ route('user.categories.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf


                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">

                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    <div class="form-group">
                            <label for="">Cover Photo</label>
                            <input type="file" name="cover_photo" class="form-control">

                            @error('cover_photo')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    <div class="form-group">
                            <label for="">KeyWords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" required class="form-control">

                            @error('meta_keywords')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description"  class="form-control">{{ old('meta_description') }}</textarea>

                            @error('meta_description')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    @foreach($languages as $language)
                    <hr>
                    <div class="form-group">
                            <label for="">Category Name in {{$language->name}}</label>
                            <input type="text" name="category_name_{{$language->local}}" value="" required class="form-control">

                            @error('category_name_'.$language->local)
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    <div class="form-group">
                            <label for="">Slug in {{$language->name}}</label>
                            <input type="text" name="slug_{{$language->local}}" value="{{ old('slug_'.$language->local) }}" class="form-control">

                            @error('slug_'.$language->local)
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    <div class="form-group">
                            <label for="">Description in {{$language->name}}</label>
                            <textarea type="text" name="description_{{$language->local}}" value="" class="form-control">{{ old('description_'.$language->local) }}</textarea>

                            @error('description_'.$language->local)
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    @endforeach

                        <button class="btn btn-primary" type="submit">Create</button>

                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection
