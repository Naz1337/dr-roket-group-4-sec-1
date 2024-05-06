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
        <table class="table table-striped" style="width: 90%;">
            <thead class="table-light">
            <tr class="text-center">
                <th>No.</th>
                <th>Completion Date</th>
                <th>Title</th>
                <th>Page Count</th>
                <th>Days taken to Complete</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr class="align-baseline">
                <th>1.</th>
                <td>11 September 2001</td>
                <td>Analysis on Current Meta</td>
                <td class="text-center">188</td>
                <td class="text-end">9</td>
                <td class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('drafts.show', ['draft' => 1]) }}" class="icon-link p-4"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('drafts.show', ['draft' => 1, 'download' => 1]) }}" class="icon-link p-4"><i class="bi bi-download"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
