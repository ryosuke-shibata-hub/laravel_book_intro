@extends('layouts.app')
@section('content')

<div class="row container pl-5">
    <div class="col-md-12 pl-5">
        @include('common.errors')
        <form enctype="multipart/form-data" action="{{ url('/Books/update') }}" method="POST"
        class="form-horizontal">
        @csrf
        <input type="hidden" value="{{ $book->id }}" name="id">
        <div class="form-group">
            <label for="item_name">title</label>
            <input type="text" name="item_name"
                value="{{ $book->item_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="item_number">Number</label>
            <input type="text" name="item_number"
                value="{{ $book->item_number }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="item_amount">amount</label>
            <input type="text" name="item_amount"
                value="{{ $book->item_amount }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="published">published</label>
            <input type="datetime" name="published"
                value="{{ $book->published }}" class="form-control">
        </div>
        <div class="col-sm-6">
        <label>画像</label>
        <input type="file" name="item_img">
        </div>
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/" class="btn btn-link pull-right">Back</a>
        </div>
        </form>
    </div>
</div>
@endsection
