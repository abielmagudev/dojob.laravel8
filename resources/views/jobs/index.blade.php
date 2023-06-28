@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">New job</a>
</p>    
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">Job</th>
                <th scope="col">Description</th>
                <th scope="col">Extensions</th>
                <th scope="col">Orders</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)               
            <tr>
                <td scope="row">{{ $job->name }}</td>
                <td>{{ $job->description }}</td>
                <td>{{ $job->extensions_count }}</td>
                <td>{{ $job->orders_count }}</td>
                <td class="text-end">
                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary btn-sm">
                        <span>Show</span>
                    </a>
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-outline-warning btn-sm">
                        <span>Edit</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
