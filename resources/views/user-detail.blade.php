@extends('layouts.main')

@section('title', 'User Details')

@section('content')

    <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
        <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold">User Detail</h3>
            <div class="space-x-2">
                @if($user->status == 'inactive')
                    <a href="/users/{{$user->slug}}/approve"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                        Approve
                    </a>
                @endif
                @if($user->status == 'active')
                        <a href="javascript:void(0);" data-id="{{ $user->slug }}"
                           class="deactivate-btn inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                            Deactivate
                        </a>
                @endif
                @if($user->status == 'active')
                    <a href="/users"
                @else
                    <a href="/users/registered"
                @endif
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
                        <th class="w-1/5 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Field
                        </th>
                        <th class="w-4/5 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Details
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500">Username</td>
                        <td class="px-4 py-4 text-sm text-gray-900">{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500">Phone</td>
                        <td class="px-4 py-4 text-sm text-gray-900">
                            @if($user->phone)
                                {{ $user->phone }}
                            @else
                                {{ '-' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500">Address</td>
                        <td class="px-4 py-4 text-sm text-gray-900">{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500">Status</td>
                        <td class="px-4 py-4 text-sm font-medium {{ $user->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $user->status }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        document.querySelectorAll('.deactivate-btn').forEach(button => {
            button.addEventListener('click', function () {
                const userSlug = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This user will be deactivated and won't be able to access the system!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1d4ed8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivate it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/users/${userSlug}/deactivate`;
                    }
                });
            });
        });
    </script>

@endsection
