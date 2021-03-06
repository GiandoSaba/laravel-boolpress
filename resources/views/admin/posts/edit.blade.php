@extends('layouts.admin')

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            <h1>
                Modify {{ $post->title }}
            </h1>
        </div>
    </div>
    <div class="row">
        <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <select class="form-select" name="category_id">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }} - {{ $category->id }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <fieldset>
                <legend>Tags</legend>
                @error('tags.*')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                            @if ($post->tags()->get()->contains($tag->id)) checked @endif>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </fieldset>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value=" {{ old('title', $post->title) }}">
                @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3"
                    name="content"> {{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if (!empty($post->image))
                <div class="mb-3">
                    <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
            @endif
            <div class="mb-3">
                <label for="image" class="form-label">Image Path</label>
                <input class="form-control" type="file" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
@endsection
