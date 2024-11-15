function populateUserData(user) {

    document.getElementById('update_name').value = user.name;
    document.getElementById('update_phone').value = user.phone;
    document.getElementById('update_user_type').value = user.user_type;
    document.getElementById('update_status').value = user.status;
    document.getElementById('update_email').value = user.email;

    const updateForm = document.getElementById('updateUserForm');
    updateForm.action = `/users/${user.id}`;
}
