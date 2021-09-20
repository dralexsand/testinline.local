<div class="card">
    <h4 class="card-header"><span>Post#{{ $post_id }}:</span> {{ $post_title }}</h4>
    <div class="card-body">
        <h5 class="card-title">{{ $comment_name }}</h5>
        <p class="card-text">{!! $comment_body !!}</p>
        <footer><cite title="Source Title">{{ $comment_email }}</cite></footer>
    </div>
</div>
