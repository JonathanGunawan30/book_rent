@extends('layouts.main')

@section('title', 'Rent Log')

@section('content')

    <x-rent-log-table :rentLogs="$rentLogs" />

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
@endsection
