<x-modern-layout title="Register Successful">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bolder fs-8 mb-4">Success!</h5>
                <p class="fs-5 mb-4">Platinum information is successfully submitted to database! Here's the account
                    information:</p>
                <div class="row mb-4">
                    <div class="col-2">
                        <h5 class="fw-semibold">Username</h5>
                    </div>
                    <div class="col-8">
                        @isset($user)
                            {{ $user->username }}
                        @else
                            Test Username
                        @endisset
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-2">
                        <h5 class="fw-semibold">Password</h5>
                    </div>
                    <div class="col-8">
                        @isset($user)
                            {{ $user->getPlatinum()->plat_ic }}
                        @else
                            Test Password
                        @endisset
                    </div>
                </div>
                <a href="{{ route('manage-user-profile') }}" class="btn btn-primary float-end">Go to Manage User Profile</a>
            </div>
        </div>
    </div>
</x-modern-layout>
