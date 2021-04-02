
@extends("enduser.layouts.main")

@section("title", $title)

@section("content")
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="all-blog-posts">
                <div class="row">
                    @forelse ($categories as $item)
                        <div class="col-lg-6">
                            <div class="blog-post">
                                <div class="down-content">
                                    <h4>{{ $item->name_val }}</h4>
                                    <p>{{ $item->description_val }}</p>
                                    <div class="post-options">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <a href="{{ route("categoriesShow", $item->id) }}" class="btn btn-info"> {{ __("site.show") }} </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            {{ __("site.there_is_no_data_avaliable") }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
