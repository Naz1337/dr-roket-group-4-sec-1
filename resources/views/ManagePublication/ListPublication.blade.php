<x-modern-layout>
<div class="p-3 bg-white content">
{{-- Page Content --}}
        <div class="row">   
                    <div class="col-1">
                        <label class="form form-label p-2">Search:</label>
                    </div>
                    <div class="col">
                        <input class="form form-control" list="datalistOptions" type="text" placeholder="Search...">
                        <datalist id="datalistOptions">
                            <option value="Software Security">
                            <option value="Robotics">
                            <option value="Pattern Recognition">
                            <option value="Bio-technology">
                            <option value="Cloud Architecture">
                          </datalist>
                    </div>
                    <div class="col-2 d-flex justify-content-end mb-4">
                        <i class=" bi bi-search"></i>
                        &nbsp;
                        <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
                    </div>        
  </div>

  <hr>

  <div class="row p-3 bg bg-light">
  {{-- Content --}}        
            <div class="row">
              <div class="col d-flex  justify-content-end mb-4">
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
                          <th scope="col">No</th>
                          <th scope="col">Title</th>
                          <th scope="col">Author</th>
                          <th scope="col">Published Date</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($publication as $publication)
                          <tr>
                            <th scope="row">{{ $loop->iteration }} </th>
                            <td> title </td>
                            <td> authors </td>
                            <td> publisheddate </td>
                            <td>
                              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="">Edit</button>
                              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="">Delete</button>
                            </td>
                          </tr>
                          @endforeach
                          <!-- Update Modal -->
                          <div class="modal fade" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="">Edit Publication</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Delete Modal -->
                          <div class="modal fade" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="">Delete Publication</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this publication?
                                </div>
                                <div class="modal-footer">
                                  
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                      
                      </tbody>
                    </table>
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
                  <form action="" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
</x-modern-layout>
