
@extends("enduser.layouts.main")

@section("title", $title)

@section("content")
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @include("settings::enduser._sections._blogs")
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sidebar-item recent-posts">
                                    <div class="sidebar-heading">
                                        <h2>{{ __("site.viewed_blogs") }}</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @forelse ($viewed_blogs as $item)
                                                <li>
                                                    <a href="{{ route("blogsShow", $item->id) }}">
                                                        <h5> {{ $item->name_val }} </h5>
                                                        <span>{{ $item->updated_at->diffForHumans() }}</span>
                                                    </a>
                                                </li>
                                            @empty
                                                <li class="text-info"> {{ __('site.there_is_no_blog_viewed') }} </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- Recent Posts -->

                            <div class="col-lg-12">
                                <div class="sidebar-item tags">
                                    <div class="sidebar-heading">
                                        <h2>{{ __('site.viewed_categories') }}</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @forelse ($viewed_categories as $item)
                                                <li><a href="{{ route("categoriesShow", $item->id) }}">{{ $item->name_val }}</a></li>
                                            @empty
                                                <li class="text-info"> {{ __('site.there_is_no_category_viewed') }} </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- Tags Posts -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
