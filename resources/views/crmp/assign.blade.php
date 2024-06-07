<x-modern-layout title="Assign CRMP to Platinum">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Assign CRMP to {{ $platinum1->plat_name }}</h4>

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
                @if($crmps->count() > 0)
                    Showing {{ $crmps->count() }} entries
                @else
                    No results found
                @endif
            </p>

            @if ($crmps->count() === 0 && $query !== '')
                <div>
                    <a class="btn btn-secondary" href="{{ route('crmp.assign_crmp', ['platinum' => $platinum]) }}">Try Again</a>
                </div>
            @endif

            @foreach($crmps as $platinum)
                <div class="card shadow-lg">
                    <div class="card-body d-flex align-items-center" style="padding: 1rem;">
                        <div class="me-3">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($platinum->plat_photo) }}" alt=""
                                 class="rounded-circle ratio ratio-1x1" style="max-height: 2.5rem">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <label class="form-label p-0 m-0">{{ $platinum->plat_name }}</label>
                            <div style="font-size: 0.875rem" class="text-secondary d-flex gap-3">
                                Has {{ $platinum->user->assigned_platinums->count() }} Platinums
                            </div>
                        </div>
                        <form class="ms-auto" method="post" action="{{
                            route('crmp.assign_crmp_post', [
                                'platinum' => $platinum1,
                                'crmp' => $platinum->user
                            ])
                         }}">
                            <button class="btn btn-outline-primary">Assign to this Platinum</button>
                            @csrf
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-modern-layout>
