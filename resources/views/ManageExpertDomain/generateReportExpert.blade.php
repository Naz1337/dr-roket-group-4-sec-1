<x-modern-layout>
    <div class="p-3 bg-white content">
        {{-- Page Content --}}
        <div class="row">
            <div class="col">
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
                    <div class="col-2">
                        <i class=" bi bi-search"></i>
                        &nbsp;
                        <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row p-3 bg bg-light">
            {{-- Content --}}

        </div>
    </div>
</x-modern-layout>