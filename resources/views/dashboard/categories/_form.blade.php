@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occurred!</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif

<div class="form-group">
    <x-form.input label="Category Name" type="text" id="name" name="name" :value="$category->name" />
</div>
<div class="form-group">
    <label for="parent_id">Category Parent</label>
    <select id="parent_id" name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <x-form.textarea label="Description" type="text" id="Description" name="Description" :value="$category->Description" />
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" id="image" name="image" class="form-control">
    @if($category->image)
        <img src="{{asset('storage/' . $category->image)}}" alt="" height="50">
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" id="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>
