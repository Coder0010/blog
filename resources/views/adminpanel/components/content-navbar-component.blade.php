<!--begin::Subheader-->
<div id="kt_subheader" class="subheader py-2 py-lg-6 subheader-solid">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted"> {{ __("main.dashboard") }} </a>
                    </li>
                    @if($parentRoute)
                        <li class="breadcrumb-item">
                            <a href="{{ $parentRoute }}" class="text-muted"> {{ $parent }} </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="javascript:;" class="text-dark font-weight-bold"> {{ $child }} </a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
