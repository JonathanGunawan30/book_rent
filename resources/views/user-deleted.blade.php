@extends('layouts.main')

@section('title', 'Users')

@section('content')

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">User Deleted</h3>
            <div class="space-x-2">

                <a href="{{url()->previous()}}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                    Back
                </a>
            </div>
        </div>

        <div class="overflow-x-auto mt-4">
            <div class="w-full">
                <table class="w-full table-auto">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="w-16 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No.
                        </th>
                        <th class="w-1/5 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Username
                        </th>
                        <th class="w-1/5 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="w-1/3 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Address
                        </th>
                        <th class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $index => $user)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{$index + 1}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$user->username}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if($user->phone)
                                    {{$user->phone}}
                                @else
                                    {{'-'}}
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$user->address}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium {{$user->status == 'active' ? 'text-green-500' : 'text-red-500'}}">{{$user->status}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2">

                                <a href="javascript:void(0);" data-id="{{$user->slug}}"
                                   class="delete-btn inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Restore
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: '#4F46E5'
            });
        </script>
    @endif

    @if(session ('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{session('error')}}",
                confirmButtonColor: '#4F46E5'
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const userSlug = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This category will be restored!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/users/${userSlug}/restore`;
                    }
                })
            });
        });
    </script>
@endsection
