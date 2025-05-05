document.addEventListener('DOMContentLoaded', function () {
    const searchInputs = document.querySelectorAll('#search_user');

    searchInputs.forEach(input => {
        const form = input.closest('form');
        let dropdown = null;

        input.addEventListener('input', function () {
            const query = this.value.trim();

            if (dropdown) {
                dropdown.remove();
                dropdown = null;
            }

            if (query.length < 2) {
                console.log('Query too short:', query);
                return;
            }

            console.log('Fetching users for query:', query);
            fetch(`/api/users/search?q=${encodeURIComponent(query)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(users => {
                console.log('Received users:', users);
                if (users.length === 0) {
                    console.log('No users found for query:', query);
                    return;
                }

                dropdown = document.createElement('ul');
                dropdown.className = 'autocomplete-dropdown';
                dropdown.style.top = `${input.offsetTop + input.offsetHeight}px`;
                dropdown.style.left = `${input.offsetLeft}px`;

                users.forEach(user => {
                    const li = document.createElement('li');
                    li.className = 'px-4 py-2 cursor-pointer hover:bg-indigo-100';
                    li.textContent = `${user.user_id} (${user.wifi_package})`;
                    li.addEventListener('click', () => {
                        input.value = user.user_id;
                        // Optionally check the corresponding checkbox
                        const checkbox = form.querySelector(`input[data-user-id="${user.user_id}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                            updateSelectedUsers(form);
                        }
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
        });

        document.addEventListener('click', function (e) {
            if (dropdown && !input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.remove();
                dropdown = null;
            }
        });
    });

    // Handle custom dropdown with multiple checkboxes
    const userSelects = document.querySelectorAll('.user-select');
    userSelects.forEach(select => {
        const button = select.querySelector('.dropdown-button');
        const menu = select.querySelector('.dropdown-menu');
        const checkboxes = menu.querySelectorAll('input[type="checkbox"]');

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                updateSelectedUsers(select.closest('form'));
            });
        });

        document.addEventListener('click', (e) => {
            if (!select.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });

    function updateSelectedUsers(form) {
        const checkboxes = form.querySelectorAll('.dropdown-menu input[type="checkbox"]:checked');
        const button = form.querySelector('.dropdown-button');
        const hiddenInputsContainer = form.querySelector('.user-ids');

        // Clear existing hidden inputs
        hiddenInputsContainer.innerHTML = '';

        if (checkboxes.length === 0) {
            button.textContent = 'Pilih Pengguna';
        } else {
            const userIds = Array.from(checkboxes).map(cb => cb.dataset.userId);
            button.textContent = userIds.length > 2 ? `${userIds.length} users selected` : userIds.join(', ');
            
            // Add hidden inputs for each selected user_id
            userIds.forEach(userId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'user_ids[]';
                input.value = userId;
                hiddenInputsContainer.appendChild(input);
            });
        }
    }
});