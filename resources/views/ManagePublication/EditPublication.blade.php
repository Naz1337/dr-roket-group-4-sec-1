<modern-app-layout>
@section('content')
<div class="container">
    <h1>Edit Publication</h1>
    <form action="{{ route('publications.update', $publication->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('publications._form', ['publication' => $publication, 'expertDomains' => $expertDomains, 'platinums' => $platinums])
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
</modern-app-layout>