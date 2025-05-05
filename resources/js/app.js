document.addEventListener('DOMContentLoaded', function () {
    const searchInputs = document.querySelectorAll('#search_user');
    let debounceTimeout = null;

    searchInputs.forEach(input => {
        const form = input.closest('form');
        const userIdSelect = form.querySelector('#user_id');
        const wifiPackageSelect = form.querySelector('#wifi_package');
        let dropdown = null;

        input.addEventListener('input', function () {
            const query = this.value.trim();

            if (debounceTimeout) {
                clearTimeout(debounceTimeout);
            }

            if (dropdown) {
                dropdown.remove();
                dropdown = null;
            }

            if (query.length < 2) {
                return;
            }

            debounceTimeout = setTimeout(() => {
                fetch(`/api/users/search?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(users => {
                    if (users.length === 0) {
                        return;
                    }

                    dropdown = document.createElement('ul');
                    dropdown.className = 'autocomplete-dropdown';
                    dropdown.style.top = `${input.offsetTop + input.offsetHeight}px`;
                    dropdown.style.left = `${input.offsetLeft}px`;

                    users.forEach(user => {
                        const li = document.createElement('li');
                        li.className = 'px-4 py-2 cursor-pointer hover:bg-indigo-100';
                        li.textContent = user.user_id;
                        li.addEventListener('click', () => {
                            userIdSelect.value = user.user_id;
                            wifiPackageSelect.value = user.wifi_package || '';
                            input.value = '';
                            dropdown.remove();
                            dropdown = null;
                        });
                        dropdown.appendChild(li);
                    });

                    input.parentElement.appendChild(dropdown);
                })
                .catch(error => {
                    console.error('Error fetching users:', error.message);
                });
            }, 300);
        });

        document.addEventListener('click', function (e) {
            if (dropdown && !input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.remove();
                dropdown = null;
            }
        });
    });
});