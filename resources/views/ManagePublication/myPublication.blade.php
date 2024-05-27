<x-modern-layout>
@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
      <h1 class="display-4">Publications</h1>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create New Publication</button>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($publications as $publication)
                <tr>
                  <th scope="row">{{ $publication->id }}</th>
                  <td>{{ $publication->title }}</td>
                  <td>{{ $publication->authors }}</td>
                  <td>{{ $publication->publisheddate }}</td>
                  <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $publication->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $publication->id }}">Delete</button>
                  </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal{{ $publication->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $publication->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel{{ $publication->id }}">Edit Publication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('publications.update', $publication->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          @include('publications._form', ['publication' => $publication, 'expertDomains' => $expertDomains, 'platinums' => $platinums])
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $publication->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $publication->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $publication->id }}">Delete Publication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete this publication?
                      </div>
                      <div class="modal-footer">
                        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Create New Publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('publications.store') }}" method="POST">
          @csrf
          @include('publications._form', ['expertDomains' => $expertDomains, 'platinums' => $platinums])
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
</x-modern-layout>
