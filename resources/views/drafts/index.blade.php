<x-app-layout>
    <div class="panel">
        <x-page-title class="mb-5">
            DRAFTS
        </x-page-title>
        <div class="d-flex gap-3 align-items-center mb-3">
            <a href="{{ route('drafts.create') }}">
                <button class="btn btn-primary">
                    Create
                </button>
            </a>
        </div>
        <table class="table table-hover">
            <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Completion Date</th>
                <th>Title</th>
                <th>Page Count</th>
                <th>Days taken to Complete</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>1.</th>
                <td>11 September 2001</td>
                <td>Analysis on Current Meta</td>
                <td>188</td>
                <td>9</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
