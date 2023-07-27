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
                <th scope="col">Orders</th>
                <th scope="col">Extensions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)               
            <tr>
                <td scope="row">
                    <p class="mb-0">{{ $job->name }}</p>
                    <small class="text-muted">{{ $job->description }}</small>
                </td>
                <td>{{ $job->orders_count }}</td>
                <td>{{ $job->extensions_count }}</td>
                <td class="text-nowrap text-end">
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
