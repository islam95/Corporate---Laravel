@foreach($items as $item)
    <li {{ (URL::current() == $item->url()) ? "class=active" : '' }}>
        <a href="{{ $item->url() }}">{{ $item->title }}</a>
        @if($item->hasChildren())
        <ul class="sub-menu">
            {{-- Recursive include --}}
            @include(env('THEME') .'.includes.customMenuItems', ['items'=>$item->children()])
        </ul>
        @endif
    </li>
@endforeach
