<div class="form-group mb-3">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ $category->name }}  " class="form-control">
</div>
<div class="form-group mb-3">
    <label for="">Parent :</label>
    <select name="parent_id" class="form-control">
        <option value="">No parent</option>
        @foreach ($parents as $parent)
            <option value=" {{ $parent->id }} " @if ($parent->id == $category->parent_id) selected @endif> {{ $parent->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <textarea name="description" class="form-control"> {{ $category->description }} </textarea>
</div>
<div class="form-group mb-3">
    <label for="">Image:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group mb-3">
    <label for="">Status:</label>
    <div class="form-group mb-3">
        <label><input type="radio" name="status" value="active" @if ($category->status == 'active') checked @endif>
            Active</label>
        <label><input type="radio" name="status" value="inactive" @if ($category->status == 'inactive') checked @endif>
            Inactive</label>
    </div>
</div>
<div class="form-group mb-3">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
</div>
