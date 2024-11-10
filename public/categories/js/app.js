function toggleEditForm(id) {
  const nameElement = document.getElementById('category-name-' + id);
  const formElement = document.getElementById('edit-form-' + id);

  // Toggle visibility of name and edit form
  nameElement.classList.toggle('d-none');
  formElement.classList.toggle('d-none');
}