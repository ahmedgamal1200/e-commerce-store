@extends('layouts.partials.javascript')
@extends('layouts.partials.fonts')
@section('title', 'Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
            <x-alert />
            <form action="{{route('dashboard.profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-row">
                    <div class="col-md-6">
                        <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile->birthday" />
                    </div>
                    <div class="col-md-6">
                        <x-form.radio name="gender" label="Gender" :options="['male'=>'Male', 'female'=>'Female']" :checked="$user->profile->gender" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <x-form.input name="street_address" label="Street Address" :value="$user->profile->street_address" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="city" label="City" :value="$user->profile->city" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="state" label="State" :value="$user->profile->state" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile->country" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->profile->locale" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary m-2">Save</button>
            </form>
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

