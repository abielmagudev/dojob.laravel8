<x-card title="Categories">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
