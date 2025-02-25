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
                <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
                <a href="{{route('dashboard.categories.trash')}}" class="btn btn-sm btn-outline-dark">Trash</a>

            </div>

            <x-alert />

            <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                <x-form.input name="name" placeholder="Name" class="mx-2"  :value="request('name')"/>
                <select name="status" class="form-control mx-2">
                    <option value="">All</option>
                    <option value="active" @selected(request('status', 'active'))>Active</option>
                    <option value="archived"  @selected(request('status', 'archived'))>Archived</option>
                </select>
                <button class="btn btn-dark">Filter</button>
            </form>

           <table class="table">
               <thead>
               <tr>
                   <th>Image</th>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Parent</th>
                   <th>Products#</th>
                   <th>Status</th>
                   <th>Created At</th>
                   <th colspan="2"></th>
               </tr>
               </thead>
               <tbody>
               @forelse ($categories as $category)
               <tr>
                   <td><img src="{{asset('storage/' . $category->image)}}" alt="" height="50"></td>
                   <td>{{$category->id}}</td>
                   <td> <a href="{{route('dashboard.categories.show', $category->id)}}" style="text-decoration: none;">{{$category->name}}</a></td>
                   <td>{{$category->parent->name}}</td>
                   <td>{{$category->products_number}}</td>
                   <td>{{$category->status}}</td>
                   <td>{{$category->created_at->format('y-m-d h A')}}</td>
                   <td>
                       <a href="{{route('dashboard.categories.edit', $category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                   </td>
                   <td>
                        <form action="{{route('dashboard.categories.destroy', $category->id)}}" method="post">
                            @csrf
                            {{--Form method Spoofing--}}
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                   </td>
               </tr>
               @empty
               <tr>
                   <td style="text-align: center;" colspan="9">No categories defined.</td>
               </tr>
               @endforelse
               </tbody>
           </table>

            {{ $categories->withQueryString()->links() }}
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

