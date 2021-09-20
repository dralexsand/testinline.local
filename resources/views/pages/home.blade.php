@extends('layout.app')

@section('title', 'Home Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')

    <h1 class="home_title">Демо</h1>
    <hr>

    <div id="flash_message">
        @if($message_info!=="")
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $message_info }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

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

        @if($isData)
            <div class="col-3">
                @component('components.button',
                            [
                                'class'=>'get_data btn-danger',
                                'id'=>'clear_data_db'
                            ])
                    @slot('title')
                        Очистить БД
                    @endslot
                @endcomponent
            </div>
        @endif

        @if(!$isData)
            <div class="col-6">
                @component('components.search', [
                    'disabled' => 'disabled',
                    'search_text' => ''
                ])
                @endcomponent
            </div>
        @else
            <div class="col-9">
                @component('components.search', [
                    'disabled' => '',
                    'search_text' => $text
                ])
                @endcomponent
            </div>
        @endif

    </div>

    <hr>

    <div id="content_data" class="container">

        @if($isData)

            @foreach($comments as $comment)
                @component('components.record',
                    [
                      'post_title'=>$comment->post->title,
                      'comment_name'=>$comment->name,
                      'comment_body'=>$comment->body,
                      'comment_email'=>$comment->email,
                      'comment_id'=>$comment->id,
                      'post_id'=>$comment->post_id,
                    ])
                @endcomponent
            @endforeach

        @endif

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush


