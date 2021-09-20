<div class="card">
    <h5 class="card-header">{{ $post_title }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $comment_name }}</h5>
        <p class="card-text">{{ $comment_body }}</p>
        <footer><cite title="Source Title">{{ $comment_email }}</cite></footer>
        <a href="comments/{{ $comment_id }}" class="btn btn-primary">Подробнее...</a>
    </div>
</div>
