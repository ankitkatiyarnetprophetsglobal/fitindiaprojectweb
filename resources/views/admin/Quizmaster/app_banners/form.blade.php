<div class="mb-2">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $banner->name ?? '') }}" required>
</div>

<div class="mb-2">
    <label>Type (s/c)</label>
    <input type="text" name="type" class="form-control" value="{{ old('type', $banner->type ?? '') }}" required>
</div>

<div class="mb-2">
    <label>Landing URL</label>
    <input type="text" name="landing_url" class="form-control" value="{{ old('landing_url', $banner->landing_url ?? '') }}">
</div>

<div class="mb-2">
    <label>Banner URL</label>
    <input type="url" name="banner_url" class="form-control" value="{{ old('banner_url', $banner->banner_url ?? '') }}" required>
</div>

<div class="mb-2">
    <label>Language</label>
    <select name="language" class="form-control" required>
        <option value="EN" {{ old('language', $banner->language ?? '') == 'EN' ? 'selected' : '' }}>English</option>
        <option value="HI" {{ old('language', $banner->language ?? '') == 'HI' ? 'selected' : '' }}>Hindi</option>
    </select>
</div>


<div class="mb-2">
    <label>Duration (seconds)</label>
    <input type="number" name="duration" class="form-control" value="{{ old('duration', $banner->duration ?? '') }}">
</div>

<div class="mb-2">
    <label>Start From</label>
    <input type="datetime-local" name="start_from" class="form-control"
        value="{{ old('start_from', isset($banner) ? \Carbon\Carbon::parse($banner->start_from)->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-2">
    <label>End To</label>
    <input type="datetime-local" name="end_to" class="form-control"
        value="{{ old('end_to', isset($banner) ? \Carbon\Carbon::parse($banner->end_to)->format('Y-m-d\TH:i') : '') }}">
</div>

<div class="mb-2">
    <label>Order</label>
    <input type="number" name="order" class="form-control" value="{{ old('order', $banner->order ?? 0) }}" required>
</div>

<div class="mb-2">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="1" {{ (old('status', $banner->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ (old('status', $banner->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
