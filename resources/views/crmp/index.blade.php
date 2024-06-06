<x-modern-layout title="Assign Crmp">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4">Assign CRMP</h2>
            <form class="row mb-4" method="get">
                <div class="col-2 col-form-label">
                    <label for="platinumSearch" class="form-label">Search: </label>
                </div>
                <div class="col">
                    <div class="input-group">
                        @vite('resources/js/crmp_index.js')
                        <input type="text" class="form-control" value="{{ $query }}"
                               id="platinumSearch" placeholder="Search" name="query">
                        <button class="btn btn-primary" type="submit"><i class="ti ti-search"></i></button>
                    </div>
                </div>
            </form>
            {{-- Tell them how many are in the results --}}
            <p class="mb-4">
                @if($platinums->count() > 0)
                    Showing {{ $platinums->count() }} entries
                @else
                    No results found
                @endif
            </p>

            @foreach($platinums as $platinum)
                <div class="card shadow-lg">
                    <div class="card-body d-flex align-items-center" style="padding: 1rem;">
                        <div class="me-3">
                            <img src="/assets/images/profile/user-1.jpg" alt=""
                                 class="rounded-circle ratio ratio-1x1" style="max-height: 2.5rem">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <label class="form-label p-0 m-0">{{ $platinum->plat_name }}</label>
                            <div style="font-size: 0.875rem"
                                 class="text-secondary d-flex gap-3">
                                <div><i class="ti ti-mail"></i> {{ $platinum->plat_email }}</div>
                                <div>|</div>
                                <div><i class="ti ti-phone"></i> {{ $platinum->plat_phone_no }}</div>
                            </div>
                        </div>
                        <form class="ms-auto" method="post"
                              action="{{ route('crmp.toggle_crmp', ['platinum' => $platinum]) }}">
                            @if ($platinum->is_crmp)
                            <button class="btn btn-danger stretched-link" type="submit" onclick="on_click_toggle(event)">Remove as CRMP</button>
                            @else
                            <button class="btn btn-success stretched-link" type="submit" onclick="on_click_toggle(event)">Assign as CRMP</button>
                            @endif
                            @csrf
                        </form>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</x-modern-layout>
