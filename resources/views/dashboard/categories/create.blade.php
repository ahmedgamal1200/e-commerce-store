@extends('layouts.partials.javascript')
@extends('layouts.partials.fonts')
@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection



<!doctype html>
<html lang="en">
<!--begin::Head-->
@include('layouts.partials.head')
<!--end::Head-->
@include('layouts.partials.body')
<!--begin::Start Navbar Links-->
@include('layouts.partials.navbar')
<!--end::End Navbar Links-->
</div>
<!--end::Container-->
</nav>
<!--end::Header-->
<!--begin::Sidebar-->
{{--@include('layouts.partials.sidebar')--}}
<x-nav />
<!--end::Sidebar-->

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                @include('layouts.partials.main')
            </div>
            <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('dashboard.categories._form')
            </form>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content Header-->
</main>
<!--end::App Main-->
</div>
<!--end::App Wrapper-->
</body>
<!--end::Body-->
</html>

