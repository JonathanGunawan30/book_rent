@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-4">User Profile</h2>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name:</label>
                <p class="mt-1 text-sm text-gray-600">{{ Auth::user()->username }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone:</label>
                <p class="mt-1 text-sm text-gray-600">{{ Auth::user()->phone }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address:</label>
                <p class="mt-1 text-sm text-gray-600">{{ Auth::user()->address }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role:</label>
                <p class="mt-1 text-sm text-gray-600">{{ 'user' }}</p>
            </div>

            <div class="mt-6">
                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Edit Profile
                </a>
                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change Password
                </a>
            </div>

            <div class="flex justify-between items-center p-4 bg-gray-50 border-b mt-6">
                <h3 class="text-xl font-semibold">Rent Log</h3>
            </div>

            <div class="overflow-x-auto mt-4">
                <div class="w-full">
                    <table class="w-full min-w-max">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="w-16 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No.
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Book
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rent Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Return Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actual Return Date
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($rentLogs as $index => $log)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $log->book->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::parse($log->rent_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::parse($log->return_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $log->actual_return_date ? ($log->actual_return_date > $log->return_date ? 'text-red-500' : 'text-green-500') : 'text-gray-500' }}">
                                    {{ $log->actual_return_date ? \Carbon\Carbon::parse($log->actual_return_date)->format('Y-m-d') : 'Not Returned' }}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
