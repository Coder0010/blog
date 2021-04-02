@extends("enduser.layouts.main")

@section("title", $title)

@section("content")
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="all-blog-posts">
                <div class="row">
                    @include("settings::enduser._sections._blogs")
                </div>
            </div>
        </div>
    </section>
@endsection
