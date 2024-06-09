<div>
    <h4 class="mb-4">Feedbacks</h4>

    @php
        // in ascending order of created time then limit it to 5
        $messages = $platinum->feedbackMessages->where('type', $feedbackType)
        ->sortByDesc('created_at')->take(5);
    @endphp
    @foreach($messages as $message)

        <div class="row">
            <div class="col-6">
                <div class="card shadow-md">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                @if ($message->user->user_type === \App\Enums\Roles::MENTOR)
                                    @php
                                        $picture = $message->user->user_profile->user_photo;
                                        if ($picture === null) {
                                            $picture = '/assets/images/profile/user-1.jpg';
                                        }
                                        else {
                                            $picture = \Illuminate\Support\Facades\Storage::url($picture);
                                        }
                                    @endphp
                                    <img src="{{ $picture }}" alt="" class="rounded-circle"
                                         style="max-width: 100%">
                                @else
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($message->user->platinum->plat_photo) }}" alt="" class="rounded-circle"
                                         style="max-width: 100%">
                                @endif

                            </div>
                            <div class="col">
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-label" style="font-size: 0.875rem">
                                            @if ($message->user->user_type === \App\Enums\Roles::MENTOR)
                                                {{ $message->user->user_profile->profile_name }} <span class="badge rounded-pill text-bg-secondary">Mentor</span>
                                            @else
                                                {{ $message->user->platinum->plat_name }} <span class="badge rounded-pill text-bg-success ">CRMP</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{ $message->message }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-secondary text-end" style="font-size: 0.75rem">
                                            {{ $message->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>
