<x-modern-layout title="Platinums Progress">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Platinums Progress</h3>

            {{-- info about platinums, and then two button. one, draft progress, 2, weekly focus --}}
            <div class="container-fluid">

                <div class="row">
                    @foreach($platinums as $platinum)
                        <div class="col-4">
                            <div class="card shadow-lg">
                                <div class="card-body d-flex flex-column justify-content-start pb-0">
                                    <a style="min-height: 3rem" class="mb-4" href="{{ route('view-profile-id', ['id' => $platinum->user->id]) }}">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($platinum->plat_photo) }}" alt=""
                                                 class="rounded-circle me-3" style="max-height: 2.5rem">
                                            <div>
                                                <div class="form-label m-0">{{ $platinum->plat_name }}</div>
                                                <div class="text-secondary" style="font-size: 0.875rem">
                                                    {{ $platinum->plat_edu_field }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-footer d-flex justify-content-center gap-3 align-items-center">
                                    <a class="btn btn-outline-primary" href="{{ route('crmp.view_draft_progress', ['platinum' => $platinum]) }}">Draft Progress</a>
                                    <a class="btn btn-outline-primary" href="{{ route('crmp.weekly_foci', ['platinum' => $platinum]) }}">Weekly Focus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</x-modern-layout>
