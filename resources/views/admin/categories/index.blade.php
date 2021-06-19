<x-dashboard-layout title="Categories">

    <x-alert title="my masege" type="danger" :url="URL::current()">
        <x-slot name="actions">
            <a href="#" class="btn btn-danger">Action BUtton</a>
        </x-slot>
    </x-alert>
    <div class="table-toolbar mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-info">create</a>
    </div>
    <form action="{{ URL::current() }}" method="get" class="d-flex mb-4">

        <input type="text" name="name" class="form-control me-2" placeholder="Sarch By Name">

        <select name="parent_id" class="form-control me-2">
            <option value="">no parent</option>
            @foreach ($parents as $parent)
                <option value=" {{ $parent->id }} ">{{ $parent->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary ">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent ID</th>
                <th>Create At</th>
                <th>Status</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('admin.categories.edit', $category->id) }}"> {{ $category->name }} </a>
                    </td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->created_at }} </td>
                    <td>{{ $category->status }}</td>
                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </div>
        </tbody>
    </table>

    </main>
</x-dashboard-layout>
