@extends('layout.app')

@section('title', 'Home Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')

    <h1 class="home_title">Демо</h1>
    <hr>

    <div id="flash_message"></div>

    <div class="row">

        @if(!$isEmptyPosts)
            <div class="col-3">
                @component('components.button',
                            [
                                'class'=>'get_data btn-danger',
                                'id'=>'get_data_posts'
                            ])
                    @slot('title')
                        Получить данные posts
                    @endslot
                @endcomponent
            </div>
        @endif

        @if(!$isEmptyComments)
            <div class="col-3">
                @component('components.button',
                            [
                                'class'=>'get_data btn-danger',
                                'id'=>'get_data_comments'
                            ])
                    @slot('title')
                        Получить данные comments
                    @endslot
                @endcomponent
            </div>
        @endif

        @if($isEmptyPosts || $isEmptyComments)
            <div class="col-3">
                @component('components.button',
                            [
                                'class'=>'get_data btn-danger',
                                'id'=>'clear_data_db'
                            ])
                    @slot('title')
                        Очистить данные в БД
                    @endslot
                @endcomponent
            </div>
        @endif

        @if(!$isEmptyPosts || !$isEmptyComments)
            <div class="col-6">
                @component('components.search', [
                    'disabled' => 'disabled'
                ])
                @endcomponent
            </div>
        @else
            <div class="col-9">
                @component('components.search', [
                    'disabled' => ''
                ])
                @endcomponent
            </div>
        @endif

    </div>

    <hr>

    <div class="container">

        @if($isData)

            @foreach($comments as $comment)
                @component('components.record',
                    [
                      'post_title'=>'Post Title',
                      'comment_name'=>$comment->name,
                      'comment_body'=>$comment->body,
                      'comment_email'=>$comment->email,
                      'comment_id'=>$comment->id,
                    ])
                @endcomponent
            @endforeach

        @endif

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush


