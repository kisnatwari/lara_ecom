@extends('seller.layouts')

@section('content')
    <div class="h-full p-1">
        <div class="h-full bg-gray-900/90 p-2 overflow-auto">
            <form action="{{ route('categories.store') }}" method="POST" class="w-full my-4 max-w-lg mx-auto">
                @csrf
                <div class="w-full px-3 mb-6 md:mb-0 flex">
                    <div class="relative flex-grow mr-2">
                        <input
                            class="appearance-none w-full bg-gray-800 text-gray-300 py-3 px-4 leading-tight outline-none border-0 focus:bg-gray-700"
                            id="name" name="name" type="text" placeholder="Category name">
                    </div>
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create
                    </button>
                </div>
            </form>
            <div class="">
                <h1>Created Categories</h1>
                <div class="flex flex-wrap">
                    @foreach ($categories as $category)
                        <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                            <div class="bg-gray-800 rounded-lg shadow-md p-4 relative">
                                <h2 class="text-lg font-medium text-gray-300">{{ $category->name }}</h2>
                                <p class="text-gray-500">{{ $category->created_at->format('M d, Y') }}</p>
                                <div class="flex justify-end mt-2">
                                    <button class="text-blue-500 hover:text-blue-700 focus:outline-none mr-2 edit-category"
                                        data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500/70 hover:text-red-500 focus:outline-none">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="hidden fixed z-10 inset-0 overflow-y-auto backdrop-blur-lg" id="edit-modal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-800 opacity-70"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-gray-950 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full animate__animated animate__fadeIn"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-gray-950 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 class="text-lg font-medium text-gray-300 mb-2" id="modal-headline">Edit Category</h2>
                    <form action="#" method="POST" id="edit-category-form">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full px-3">
                                <input
                                    class="appearance-none block w-full bg-gray-700 text-gray-300 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-gray-600"
                                    id="edit-name" name="name" type="text" placeholder="Category name">
                            </div>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button
                                class="bg-indigo-700 hover:bg-indigo-700/90 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2"
                                type="submit" id="update-category">Update</button>
                            <button
                                class="bg-gray-500 hover:bg-gray-500/90 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="button" id="cancel-edit">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.edit-category').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#edit-category-form').attr('action', '/categories/' + id);
                $('#edit-name').val(name);
                $('#edit-modal').removeClass('hidden');
                $('#edit-modal').addClass('animate__animated animate__fadeIn');
            });

            $('#cancel-edit').click(function() {
                $('#edit-modal').removeClass('animate__fadeIn');
                $('#edit-modal').addClass('animate__animated animate__fadeOut');
                setTimeout(function() {
                    $('#edit-modal').addClass('hidden');
                    $('#edit-modal').removeClass('animate__animated animate__fadeOut');
                }, 500);
            });

            $('#edit-category-form').submit(function() {
                var url = $('#edit-category-form').attr('action');
                var data = $('#edit-category-form').serialize();
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
@endsection
