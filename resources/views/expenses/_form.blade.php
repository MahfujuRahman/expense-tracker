<div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" class="form-control" value="{{ old('title', $expense->title ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Amount</label>
    <input name="amount" type="number" step="0.01" class="form-control" value="{{ old('amount', $expense->amount ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Date</label>
    <input name="date" type="date" class="form-control" value="{{ old('date', isset($expense) ? $expense->date->format('Y-m-d') : date('Y-m-d')) }}">
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-select">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ (old('category_id', $expense->category_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
</div>
