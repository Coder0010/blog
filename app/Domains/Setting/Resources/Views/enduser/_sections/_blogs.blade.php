@forelse ($blogs as $item)
    <div class="col-lg-6">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ $item->getMainMedia() }}" class="img-responsive" style="max-height: 200px">
            </div>
            <div class="down-content">
                <span>{{ $item->category_name }}</span>
                <h4>{{ $item->name_val }}</h4>
                <ul class="post-info">
                    <li><a href="#">{{ optional($item->author)->name }}</a></li>
                    <li><a href="#">{{ $item->created_at->diffForHumans() }}</a></li>
                    <li><a href="#">{{ count($item->comments) }}</a></li>
                </ul>
                <div class="post-options">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="{{ route("blogsShow", $item->id) }}" class="btn btn-info"> {{ __("site.show") }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col">
        <div class="alert altet-info">{{ __("site.there_is_no_data_avaliable") }}</div>
    </div>
@endforelse
