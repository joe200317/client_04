@php
    $prefix = $prefix ?? '';
    $bookFieldId = $prefix !== '' ? $prefix.'-book_id' : 'book_id';
    $phoneFieldId = $prefix !== '' ? $prefix.'-phone' : 'phone';
    $orderBooks = $orderBooks ?? collect();
    $showByDefault = old('topic') === 'Book Order';
@endphp

<div class="contact-book-order-fields" data-book-order-fields @if (! $showByDefault) hidden @endif>
    <label for="{{ $bookFieldId }}">Book</label>
    <select id="{{ $bookFieldId }}" name="book_id" data-book-order-input @if ($showByDefault) required @endif>
        <option value="" disabled {{ old('book_id') ? '' : 'selected' }}>Select a book</option>
        @foreach ($orderBooks as $book)
            <option value="{{ $book->id }}" @selected((string) old('book_id') === (string) $book->id)>{{ $book->title }}</option>
        @endforeach
    </select>
    @error('book_id')<span class="field-error">{{ $message }}</span>@enderror

    <label for="{{ $phoneFieldId }}">Phone number</label>
    <input
        id="{{ $phoneFieldId }}"
        name="phone"
        type="tel"
        value="{{ old('phone') }}"
        placeholder="e.g. +91 98765 43210"
        data-book-order-input
        @if ($showByDefault) required @endif
    >
    @error('phone')<span class="field-error">{{ $message }}</span>@enderror
</div>
