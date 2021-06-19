<x-dashboard-layout title="Edit Category">
    <form action="{{ route('admin.categories.update', $id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('put')
        @include('admin.categories._form',[
        'button_label' => 'update'
        ])
    </form>

</x-dashboard-layout>
