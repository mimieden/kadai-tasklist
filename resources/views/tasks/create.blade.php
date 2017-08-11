@extends('layouts.app')

@section('content')

    <h1>タスク新規作成ページ</h1>

    {!! Form::model($task, ['route' => 'tasks.store']) !!}

        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content') !!}

        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::select('status', ['not yet' => '未対応', 'in process' => '対応中', 'done' => '完了']) !!}

        {!! Form::submit('投稿') !!}

    {!! Form::close() !!}

@endsection