<div class="mb-3">
    <label for="name" class="form-label">Platform Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $version->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="platform" class="form-label">Platform (1=Android, 2=iOS)</label>
    <input type="number" name="platform" class="form-control" value="{{ old('platform', $version->platform ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="version" class="form-label">Version</label>
    <input type="text" name="version" class="form-control" value="{{ old('version', $version->version ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="type" class="form-label">Type (1 or 2)</label>
    <input type="number" name="type" class="form-control" value="{{ old('type', $version->type ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="updateStatus" class="form-label">Update Status (0=Soft, 1=Force)</label>
    <input type="number" name="updateStatus" class="form-control" value="{{ old('updateStatus', $version->updateStatus ?? '0') }}" required>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status (0=Inactive, 1=Active)</label>
    <input type="number" name="status" class="form-control" value="{{ old('status', $version->status ?? '1') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $version->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="release_date" class="form-label">Release Date</label>
    <input type="datetime-local" name="release_date" class="form-control"
           value="{{ old('release_date', isset($version) ? \Carbon\Carbon::parse($version->release_date)->format('Y-m-d\TH:i') : '') }}" required>
</div>

<div class="mb-3">
    <label for="created_date" class="form-label">Created Date</label>
    <input type="datetime-local" name="created_date" class="form-control"
           value="{{ old('created_date', isset($version) ? \Carbon\Carbon::parse($version->created_date)->format('Y-m-d\TH:i') : '') }}" required>
</div>
