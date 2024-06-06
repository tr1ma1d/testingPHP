document.addEventListener('DOMContentLoaded', function() {
    fetch('./php/get_checkbox.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const checkboxList = document.getElementById('checkbox-list');
                data.data.forEach(item => {
                    const div = document.createElement('div');

                    const checkboxItem = document.createElement('div');
                    checkboxItem.classList.add('checkbox-item');

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `checkbox-${item.id}`;
                    checkbox.dataset.description = item.description;

                    const label = document.createElement('label');
                    label.htmlFor = `checkbox-${item.id}`;
                    label.textContent = item.name;

                    const button = document.createElement('button');
                    button.textContent = '+';
                    button.classList.add('btn-desc');
                    button.dataset.checkboxId = `checkbox-${item.id}`;

                    checkboxItem.appendChild(checkbox);
                    checkboxItem.appendChild(label);
                    checkboxItem.appendChild(button);

                    const description = document.createElement('div');
                    description.id = `description-${item.id}`;
                    description.textContent = item.description;
                    description.classList.add('desc');

                    div.appendChild(checkboxItem);
                    div.appendChild(description);
                    checkboxList.appendChild(div);

                    const toggleDescription = function () {
                        checkbox.checked = !checkbox.checked;
                        description.style.display = checkbox.checked ? 'block' : 'none';
                    };

                    checkbox.addEventListener('change', function () {
                        description.style.display = this.checked ? 'block' : 'none';
                    });

                    button.addEventListener('click', toggleDescription);
                });
            } else {
                console.error('Failed to load checkbox data:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching checkbox data:', error);
        });
});
