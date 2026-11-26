(() => {
    const eyeOpen = `
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M12 5c-5.2 0-9.4 3.3-11 7 1.6 3.7 5.8 7 11 7s9.4-3.3 11-7c-1.6-3.7-5.8-7-11-7zm0 11.5A4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 0 1 0 9z"/>
            <circle cx="12" cy="12" r="2.2"/>
        </svg>
    `;

    const eyeOff = `
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M3.3 2.9 2 4.2l3.1 3.1C3.3 8.6 1.7 10.5 1 12c1.6 3.7 5.8 7 11 7 2.1 0 4.1-.5 5.8-1.4l3.2 3.2 1.3-1.3L3.3 2.9zM12 17c-2.8 0-5-2.2-5-5 0-.6.1-1.2.3-1.7l6.4 6.4c-.5.2-1.1.3-1.7.3zm9.9-5c-.5-1.1-1.3-2.3-2.4-3.3l-2.2 2.2c.2.5.3 1 .3 1.6A5 5 0 0 1 13 16.9l-2.1 2.1c.7.1 1.4.2 2.1.2 5.2 0 9.4-3.3 11-7z"/>
            <path d="M12 7c.4 0 .8 0 1.2.1l-1.7 1.7A3.5 3.5 0 0 0 8.6 12l-1.7 1.7C6.3 12.8 6 11.9 6 11c0-3.3 2.7-6 6-6z"/>
        </svg>
    `;

    const enhance = (input) => {
        if (!(input instanceof HTMLInputElement) || input.dataset.passwordToggleReady === '1') {
            return;
        }

        const wrap = document.createElement('div');
        wrap.className = 'password-input-wrap';

        input.parentNode?.insertBefore(wrap, input);
        wrap.appendChild(input);
        input.dataset.passwordToggleReady = '1';

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle';
        button.setAttribute('aria-label', 'Show password');
        button.setAttribute('aria-pressed', 'false');
        button.innerHTML = eyeOpen;

        button.addEventListener('click', () => {
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            button.setAttribute('aria-pressed', String(!showing));
            button.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
            button.innerHTML = showing ? eyeOpen : eyeOff;
        });

        wrap.appendChild(button);
    };

    document.querySelectorAll('input[type="password"]').forEach(enhance);
})();
