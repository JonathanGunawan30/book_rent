@extends('layouts.main')

@section('title', 'Rent Log')

@section('content')

    <div>
        <div class="bg-white rounded-xl mt-8 shadow-lg overflow-hidden mx-auto max-w-screen-xl">
            <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
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
                                Username
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rentLogs as $index => $log)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $log->user->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $log->book->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::parse($log->rent_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::parse($log->return_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $log->actual_return_date ? ($log->actual_return_date > $log->return_date ? 'text-red-500' : 'text-green-500') : 'text-gray-500' }}">
                                    {{ $log->actual_return_date ? \Carbon\Carbon::parse($log->actual_return_date)->format('Y-m-d') : 'Not Returned' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    @if($log->actual_return_date)
                                        <button class="bg-gray-300 text-gray-500 cursor-not-allowed px-4 py-2 rounded" disabled>Returned</button>
                                    @else
                                        <form id="return-form-{{ $log->book->id }}" action="/return/{{ $log->id }}" method="POST" class="inline">
                                            @csrf
                                            <button type="button" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700" onclick="confirmReturn('return-form-{{ $log->book->id }}')">Return</button>
                                        </form>
                                    @endif
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

    <script>
        function confirmReturn(formId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
