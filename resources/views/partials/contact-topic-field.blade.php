@php
    $topics = [
        'Book 1-on-1 Session',
        'Book Order',
        'Mind and Memory Training',
        'Book and Resources',
        'Student/Parent Program',
        'School or Institutional Collaboration',
        'HR and Professional Development',
        'Others',
    ];
    $fieldId = $fieldId ?? 'topic';
@endphp

<label for="{{ $fieldId }}">What can we help with?</label>
<select id="{{ $fieldId }}" name="topic" required data-topic-select>
    <option value="" disabled {{ old('topic') ? '' : 'selected' }}>Select an option</option>
    @foreach ($topics as $topic)
        <option value="{{ $topic }}" @selected(old('topic') === $topic)>{{ $topic }}</option>
    @endforeach
</select>
@error('topic')<span class="field-error">{{ $message }}</span>@enderror
