
    <div class="widget-first widget recent-posts">
        <h3>Recent Projects</h3>
        <div class="recent-post group">

            @if(!$projects->isEmpty())
                @foreach($projects as $project)

            <div class="hentry-post group">
                <div class="thumb-img"><img style="width:55px;" src="{{ asset(env('THEME')) }}/images/projects/{{ $project->img->mini }}" alt="001" title="001" /></div>
                <div class="text">
                    <a href="{{ route('portfolios.show', ['alias'=>$project->alias]) }}" title="{{ $project->title }}" class="title">{{ $project->title }}</a>
                    <p>{{ str_limit($project->text, 70) }}</p>
                    <a class="read-more" href="{{ route('portfolios.show', ['alias'=>$project->alias]) }}">&rarr; Read More</a>
                </div>
            </div>

                @endforeach

                @else
                <h3>There are no projects yet</h3>
            @endif
        </div>
    </div>

    <div class="widget-last widget recent-comments">
        <h3>Recent Comments</h3>

        @if(!$comments->isEmpty())
            @foreach($comments as $comment)

        <div class="recent-post recent-comments group">
            <div class="the-post group">
                <div class="avatar">
                    @set($hash, ($comment->email) ? md5(strtolower(trim($comment->email))) : md5(strtolower(trim($comment->user->email))))
                    <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=55" class="avatar" />
                </div>
                <span class="author"><strong><a href="#">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</a></strong> in</span>
                <a class="title" href="{{ route('articles.show', ['alias'=>$comment->article->alias]) }}">{{ $comment->article->title }}</a>
                <p class="comment">
                    {!! $comment->text !!} <a class="goto" href="{{ route('articles.show', ['alias'=>$comment->article->alias]) }}">&#187;</a>
                </p>
            </div>
        </div>

            @endforeach

            @else
            <h3>There are no comments yet.</h3>
        @endif
    </div>