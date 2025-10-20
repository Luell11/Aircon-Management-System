document.querySelectorAll('tbody tr').forEach(row => {
  const editBtn = row.querySelector('.btn-edit');
  const removeBtn = row.querySelector('.btn-remove');
  const saveBtn = row.querySelector('.btn-save');
  const cancelBtn = row.querySelector('.btn-cancel');

  if (!editBtn || editBtn.disabled) return; // skip disabled rows

  let originalData = {};

  editBtn.addEventListener('click', () => {
    // Save original text
    originalData = {
      name: row.cells[0].textContent,
      role: row.cells[1].textContent,
      status: row.cells[2].textContent
    };

    // Replace cells with input fields
    row.cells[0].innerHTML = `<input class="edit-input" type="text" value="${originalData.name}">`;
    row.cells[1].innerHTML = `<input class="edit-input" type="text" value="${originalData.role}">`;
    row.cells[2].innerHTML = `<input class="edit-input" type="text" value="${originalData.status}">`;

    // Toggle buttons visibility
    editBtn.style.display = 'none';
    removeBtn.style.display = 'none';
    saveBtn.style.display = 'inline-block';
    cancelBtn.style.display = 'inline-block';
  });

  cancelBtn.addEventListener('click', () => {
    // Restore original text
    row.cells[0].textContent = originalData.name;
    row.cells[1].textContent = originalData.role;
    row.cells[2].textContent = originalData.status;

    // Reset status class
    updateStatusClass(row.cells[2], originalData.status);

    // Toggle buttons visibility
    editBtn.style.display = 'inline-block';
    removeBtn.style.display = 'inline-block';
    saveBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
  });

  saveBtn.addEventListener('click', () => {
    const newName = row.cells[0].querySelector('input').value.trim();
    const newRole = row.cells[1].querySelector('input').value.trim();
    const newStatus = row.cells[2].querySelector('input').value.trim();

    if (!newName || !newRole || !newStatus) {
      alert('Please fill in all fields.');
      return;
    }

    // Update cells text
    row.cells[0].textContent = newName;
    row.cells[1].textContent = newRole;
    row.cells[2].textContent = newStatus;

    // Update status class for styling
    updateStatusClass(row.cells[2], newStatus);

    // Toggle buttons visibility
    editBtn.style.display = 'inline-block';
    removeBtn.style.display = 'inline-block';
    saveBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
  });

  removeBtn.addEventListener('click', () => {
    if (confirm('Are you sure you want to remove this worker?')) {
      row.remove();
    }
  });
});

function updateStatusClass(cell, status) {
  cell.className = ''; // clear all classes
  const s = status.toLowerCase();
  if (s === 'available') {
    cell.classList.add('status-available');
  } else if (s === 'working') {
    cell.classList.add('status-working');
  } else if (s === 'off-duty') {
    cell.classList.add('status-off-duty');
  }
}