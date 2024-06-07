<modern-app-layout>

<!-- resources/views/publications/_form.blade.php -->

@php
    $publication = $publication ?? new \App\Models\Publication();
@endphp

<div class="mb-3">
    <label for="authors" class="form-label">Authors</label>
    <input type="text" class="form-control" id="authors" name="authors" value="{{  $publication->authors) }}" required>
</div>
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{  $publication->title) }}" required>
</div>
<div class="mb-3">
    <label for="publisheddate" class="form-label">Published Date</label>
    <input type="date" class="form-control" id="publisheddate" name="publisheddate" value="{{  $publication->publisheddate) }}" required>
</div>
<div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <input type="text" class="form-control" id="type" name="type" value="{{  $publication->type) }}" required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" required>{{ old('description', $publication->description) }}</textarea>
</div>
<div class="mb-3">
    <label for="p_path" class="form-label">File Path</label>
    <input type="text" class="form-control" id="p_path" name="p_path" value="{{ old('p_path', $publication->p_path) }}" required>
</div>
<div class="mb-3">
    <label for="p_filename" class="form-label">File Name</label>
    <input type="text" class="form-control" id="p_filename" name="p_filename" value="{{ old('p_filename', $publication->p_filename) }}" required>
</div>
<div class="mb-3">
    <label for="expert_domain_id" class="form-label">Expert Domain</label>
    <select class="form-control" id="expert_domain_id" name="expert_domain_id" required>
        @foreach($expertDomains as $domain)
            <option value="{{ $domain->id }}" {{ old('expert_domain_id', $publication->expert_domain_id) == $domain->id ? 'selected' : '' }}>{{ $domain->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="platinum_id" class="form-label">Platinum</label>
    <select class="form-control" id="platinum_id" name="platinum_id" required>
        @foreach($platinums as $platinum)
            <option value="{{ $platinum->id }}" {{ old('platinum_id', $publication->platinum_id) == $platinum->id ? 'selected' : '' }}>{{ $platinum->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="doi" class="form-label">DOI</label>
    <input type="text" class="form-control" id="doi" name="doi" value="{{ old('doi', $publication->doi) }}">
</div>


</modern-app-layout>