<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($comments) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current comment
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Comment</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $comment->text }}</div>
                            </td>
                            @if (Auth::check())
                            <td>
                                <form action="{{ url('comment/'.$comment->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-comment-{{ $comment->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if (Auth::check())
    <div class="panel-body">
        @include('common.errors')

                <!-- Форма добавки коммента -->
        <form action="{{ url('comment') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

                    <!-- Коммент -->
            <div class="form-group">
                <label for="comment" class="col-sm-3 control-label">Comment</label>

                <div class="col-sm-6">
                    <input type="text" name="text" id="text-name" class="form-control">
                </div>
            </div>

            <!-- Кнопка добавления коммента -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add comment
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection