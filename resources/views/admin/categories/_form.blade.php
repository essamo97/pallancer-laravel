@if ($errors->any())

    <div class="alert alert-danger">
        Erorrs!
        <ul>
            @foreach ($errors->all() as $message)
                <li>
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>

@endif


<div class="form-group mb-3">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ Old('name'), $category->name }}"
        class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <P class="invalid-feedback ">{{ $message }}</P>
    @enderror
</div>
<div class="form-group mb-3 ">
    <label for="">Parent :</label>
    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
        <option value="">No parent</option>
        @foreach ($parents as $parent)
            <option value=" {{ $parent->id }} " @if ($parent->id == old('parent_id', $category->parent_id)) selected @endif> {{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <P class="invalid-feedback ">{{ $message }}</P>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <textarea name="description"
        class="form-control @error('description') is-invalid @enderror"> {{ old('description', $category->description) }} </textarea>
    @error('description')
        <P class="invalid-feedback ">{{ $message }}</P>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Image:</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <P class="invalid-feedback ">{{ $message }}</P>
    @enderror
</div>
<div class="form-group mb-3">
    {{-- <label for="">Status:</label>
    <select class="form-control" name="status">
        <option value=" ">Sele</option>
        <option value="active">active</option>
        <option value="inactive">inactive</option>
    </select> --}}

    <div class="form-group mb-3">
        <label><input type="radio" name="status" value="active" @if (old('status', $category->status) == 'active') checked @endif>
            Active</label>
        <label><input type="radio" name="status" value="inactive" @if (old('status', $category->status) == 'inactive') checked @endif>
            Inactive</label>
    </div>
    @error('status')
        <P class="invalid-feedback ">{{ $message }}</P>
    @enderror
</div>
<div class="form-group mb-3">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
</div>
