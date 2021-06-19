<x-dashboard-layout title="Add Category">


    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('status'))
        <div class="alert alert-info">
            {{ session()->get('status') }}
        </div>
    @endif
    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        @include('admin.categories._form',[
        'button_label' => 'Add'
        ])
    </form>
</x-dashboard-layout>
