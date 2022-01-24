@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="card-title">
        本のタイトル
    </div>
</div>
@include('common.errors')
<form action="{{ url('/books') }}" method="POST"
    class="form-horizontal">
    @csrf
    <div class="form-group">
        <div class="col-sm-6">
            <input type="text" name="item_name"
                value="{{ old('item_name') }}" class="form-group">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
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
                                <form action="{{ url('book/'.$book->id) }}" method="POST">
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

@endif
@endsection
