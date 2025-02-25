@extends('layouts.partials.javascript')
@extends('layouts.partials.fonts')
@section('title', $category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Categories</li>
    <li class="breadcrumb-item active" aria-current="page">{{$category->name }}</li>
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
@include('layouts.partials.sidebar')
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
            <div class="mb-5">
                <a href="{{route('dashboard.categories.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Store</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $products = $category->products()->with('store')->latest()->paginate(5);
                @endphp
                @forelse($products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No products defined.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $products->links() }}
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

