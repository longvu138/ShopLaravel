@extends('admin.main')


@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>&nbsp</th>

            </tr>
        </thead>
        <tbody>
            {{-- Dùng static function Menu của helper --}}

            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>

@endsection
