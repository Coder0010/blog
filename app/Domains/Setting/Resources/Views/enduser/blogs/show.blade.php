@extends("enduser.layouts.main")

@section("title", $title)

@section("content")
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="all-blog-posts">
                <div class="row">
                    <div class="col-12">
                        <div class="all-blog-posts">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="{{ $item->getMainMedia() }}">
                                </div>
                                <div class="down-content">
                                    <span>{{ $item->category_name }}</span>
                                    <h4>{{ $item->name_val }}</h4>
                                    <ul class="post-info">
                                        <li><a href="#">{{ optional($item->author)->name }}</a></li>
                                        <li><a href="#">{{ $item->created_at->diffForHumans() }}</a></li>
                                        <li><a href="#">{{ count($item->comments) }}</a></li>
                                    </ul>
                                    {!! $item->description_val !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        <blog-comments :blog="{{ $item }}"/>
                    @else
                        <div class="alert alert-info">
                            <a href="{{ route("login") }}" class="btn btn-block btn-lg create-btn">{{ __("site.sign_in") }}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
