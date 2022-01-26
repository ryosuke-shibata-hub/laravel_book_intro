@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="card-title">
        本のタイトル
    </div>
</div>
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@include('common.errors')
<form action="{{ url('/Books') }}" method="POST"
    class="form-horizontal">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="book" class="col-sm-3 control-label">BOOK</label>
                <input type="text" name="item_name"
                    value="{{ old('item_name') }}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="price" class="col-sm-3 control-label">金額</label>
                <input type="text" name="item_amount"
                    value="{{ old('item_amount') }}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="number" class="col-sm-3 control-label">数</label>
                <input type="text" name="item_number"
                    value="{{ old('item_number') }}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="published" class="col-sm-3 control-label">年月日</label>
                <input type="date" name="published"
                    value="{{ old('published') }}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6 pl-5">
            <button type="submit" class="btn btn-primary">
                save
            </button>
        </div>
    </div>
</form>
@if(count($books)>0)
    <div class="card-body">
        <div class="cord-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>本一覧</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td class="table-text">
                                <div>
                                    {{ $book->item_name }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ url('Books/edit/'.$book->id) }}" method="GET">
                                @csrf
                                    <button type="submit" class="btn btn-primary">
                                        更新
                                    </button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ url('Books/'.$book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div class="row">
    <div class="col-md-4 offset-md-4">
        {{ $books->links() }}
    </div>
</div>

@endif
@endsection
