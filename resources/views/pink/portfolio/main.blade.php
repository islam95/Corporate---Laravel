<div id="content-page" class="content group">
    <div class="hentry group">

        @if($projects)

            <div id="portfolio" class="portfolio-big-image">

                @foreach($projects as $project)

                    <div class="hentry work group">
                        <div class="work-thumbnail">
                            <div class="nozoom">
                                <img src="{{ asset(env('THEME')) }}/images/projects/{{ $project->img->max }}" alt="0061" title="0061" />
                                <div class="overlay">
                                    <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/projects/{{ $project->img->path }}" rel="lightbox" title="{{ $project->title }}"></a>
                                    <a class="overlay_project" href="{{ route('portfolios.show',['alias' => $project->alias]) }}"></a>
                                    <span class="overlay_title">{{ $project->title }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="work-description">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->text }}</p>
                            <div class="clear"></div>
                            <div class="work-skillsdate">
                                <p class="skills"><span class="label">Tags:</span> {{ $project->tag->title }}</p>
                                <p class="workdate"><span class="label">Customer:</span>{{ $project->customer }}</p>

                                @if($project->created_at)
                                    <p class="workdate"><span class="label">Year:</span>{{ $project->created_at->format('Y') }}</p>
                                @endif

                            </div>
                            <a class="read-more" href="{{ route('portfolios.show',['alias' => $project->alias]) }}">View Project</a>
                        </div>
                        <div class="clear"></div>
                    </div>

                @endforeach

                @if ($projects->lastPage() > 1)
                    <div class="general-pagination group">
                        <ul class="pagination">
                            @if ($projects->currentPage() !== 1)
                                <a  href="{{ $projects->url(($projects->currentPage()-1)) }}">&lsaquo;</a>
                            @endif

                            @for ($i = 1; $i <= $projects->lastPage(); $i++)
                                @if ($projects->currentPage() == $i)
                                    <a class="selected disabled">{{ $i }}</a>
                                @else
                                    <a href="{{ $projects->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($projects->currentPage() !== $projects->lastPage())
                                <a href="{{ $projects->url($projects->currentPage()+1) }}" >&rsaquo;</a>
                            @endif
                        </ul>
                    </div>

                    @endif
            </div>

            @else
            <div>
                <h3>Currently, there are no projects.</h3>
                <h3>Please, visit our portfolio page later.</h3>
            </div>

        @endif
        <div class="clear"></div>
    </div>
</div>