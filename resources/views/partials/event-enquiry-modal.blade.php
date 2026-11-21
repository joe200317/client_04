<div
    class="event-modal"
    data-event-enquiry-modal
    data-old-event-id="{{ old('upcoming_event_id') }}"
    hidden
    aria-hidden="true"
>
    <div class="event-modal__backdrop" data-event-modal-close></div>
    <div
        class="event-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="event-enquiry-title"
    >
        <button class="event-modal__close" type="button" aria-label="Close enquiry form" data-event-modal-close>×</button>

        <p class="eyebrow">Upcoming Program</p>
        <h2 id="event-enquiry-title" data-event-modal-title>Event enquiry</h2>
        <p class="event-modal__meta" data-event-modal-meta></p>
        <p class="event-modal__summary" data-event-modal-description></p>

        <form class="event-modal__form" method="POST" action="{{ route('event-enquiries.store') }}">
            @csrf
            <input type="hidden" name="upcoming_event_id" value="{{ old('upcoming_event_id') }}" data-event-modal-id>

            <label>
                Name
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name">
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>
                Phone
                <input type="tel" name="phone" value="{{ old('phone') }}" maxlength="30" autocomplete="tel">
                @error('phone')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>
                Message
                <textarea name="message" rows="4" required maxlength="2000">{{ old('message') }}</textarea>
                @error('message')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            @error('upcoming_event_id')<span class="field-error">{{ $message }}</span>@enderror

            <div class="event-modal__actions">
                <button class="hero-btn hero-btn--outline" type="button" data-event-modal-close>Cancel</button>
                <button class="hero-btn hero-btn--primary" type="submit">Send enquiry →</button>
            </div>
        </form>
    </div>
</div>
