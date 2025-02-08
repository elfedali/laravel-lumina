@props(['companies', 'selected' => null])

<div class="mb-3">
    <label for="company_id" class="form-label">Select Company</label>
    <select name="company_id" id="company_id" class="form-select">
        <option value="">-- Select Company --</option>
        @foreach ($companies as $company)
        <option value="{{ $company->id }}" {{ $selected == $company->id ? 'selected' : '' }}>
            {{ $company->name }}
        </option>
        @endforeach
    </select>
</div>