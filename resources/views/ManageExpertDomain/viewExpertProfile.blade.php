<x-app-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black ">
            <div class="col-3">
                <div class="row h-100 p-3 border border-1 border-dark">
                    <img class="h-100 w-50" src="#" alt="Image Uploaded">
                </div>
            </div>
            <div class="col">
                <div class="row p-3">
                    <label class="form form-label">Expert Image:</label>
                    <input class="form form-control" type="text" value="pic.png" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Name:</label>
                    <input class="form form-control" type="text" value="Dr.Syafiq Fauzi Bin Kamarulzaman" readonly>
                </div>
            </div>
        </div>
        <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
            <div class="col">
                <div class="row p-3">
                    <label class="form form-label">Email:</label>
                    <input class="form form-control" type="email" value="syafiqfauzi29@gmail.com" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Phone Number:</label>
                    <input class="form form-control" type="text" value="0117363254" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Affiliation:</label>
                    <input class="form form-control" type="text" value="Universiti Malaysia Pahang" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Area of Expertise:</label>
                    <input class="form form-control" type="text" value="Robotics" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            
            {{-- <div class="col p-3 d-flex justify-content-end">
                <a href="#" type="submit" class="btn btn-primary">Edit Profile</a>
            </div> --}}
            <div class="col p-3 ">

            </div>
            <div class="col-3 p-3 d-flex justify-content-end">
                <a href="#" type="submit" class="btn btn-primary mx-3">Edit Profile</a>
                <a href="#" type="button" class="btn btn-danger">Delete Profile</a>
            </div>
        </div>

        <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black">
            <div class="col-2 p-3">
                <h2>Articles</h2>
            </div>
            <div class="col p-3">
                {{-- An empty box --}}
            </div>
            <div class="col-1 p-3 d-flex justify-content-end ">
                <a href="#" class="btn btn-primary">Upload Articles</a>
            </div>
        </div>
        <div class=" row p-3 bg bg-light border-bottom border-end border-start border-1  border-black">
            <div class="col">
                @for ($i = 0; $i < 10; $i++)
                    <div class="row p-3 m-3 border border-1 border-black">
                        <div class="col border border-1 border-black d-flex justify-content-start">
                            <div class="row p-3 m-3">
                                <p>Title: Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Eaque laudantium error esse, perspiciatis facere commodi eum, 
                                    voluptas quia dolore quisquam sit vel maxime nostrum dolor atque
                                    officiis modi officia dolores?</p>
                            </div>
                            <div class="row p-3 m-3">
                                <p>
                                    Type: Journal
                                </p>
                            </div>
                        </div>
                        <div class="col-3 border border-1 border-black d-flex justify-content-end">
                            <div class="row p-3 m-3">
                                <a class="btn btn-primary">Edit Articles</a>
                            </div>
                            <div class="row p-3 m-3">
                                <a class="btn btn-danger">Delete Articles</a>
                            </div>
                        </div>
                    </div>   
                @endfor
            </div>
        </div>
    </div>
    {{-- Bottom Content --}}
</x-app-layout>