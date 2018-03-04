<div id="content-page" class="content group">
    <div class="clear"></div>
    <div class="posts">
        <div class="group portfolio-post internal-post">

            @if($project)

                <div id="portfolio" class="portfolio-full-description">
                    <div class="fulldescription_title gallery-filters">
                        <h1>{{ $project->title }}</h1>
                    </div>

                    <div class="portfolios hentry work group">
                        <div class="work-thumbnail">
                            <a class="thumb"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $project->img->max }}" alt="0081" title="0081" /></a>
                        </div>
                        <div class="work-description">
                            <p>{!! $project->text !!}</p>
                            <div class="clear"></div>
                            <div class="work-skillsdate">
                                <p class="skills"><span class="label">Tag:</span> {{ $project->tag->title }}</p>
                                <p class="workdate"><span class="label">Customer:</span> {{ $project->customer }}</p>
                                <p class="workdate"><span class="label">Year:</span> {{ $project->created_at->format('Y') }}</p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>

                    @if(!$projects->isEmpty())

                        <h3>Other Projects</h3>

                        <div class="portfolio-full-description-related-projects">

                            @foreach($projects as $project)

                                <div class="related_project">
                                    <a class="related_proj related_img" href="{{ route('portfolios.show',['alias'=>$project->alias])}}" title="Love"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $project->img->mini }}" alt="0061" title="0061" /></a>
                                    <h4><a href="{{ route('portfolios.show',['alias'=>$project->alias])}}">{{ $project->title }}</a></h4>
                                </div>

                            @endforeach

                        </div>

                    @endif
                </div>

            @endif
            <div class="clear"></div>
        </div>
    </div>
</div>