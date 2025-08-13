document.addEventListener('click', function (e) {
    if (e.target.closest('.qty-btn')) {
        const btn = e.target.closest('.qty-btn');
        const input = btn.parentElement.querySelector('input.qty');
        let value = parseFloat(input.value) || 0;
        const step = parseFloat(input.getAttribute('step')) || 1;

        if (btn.classList.contains('plus')) {
            value += step;
        } else if (btn.classList.contains('minus')) {
            value = Math.max(value - step, parseFloat(input.getAttribute('min')) || 0);
        }

        input.value = value;
        input.dispatchEvent(new Event('change', { bubbles: true }));
    }
});
