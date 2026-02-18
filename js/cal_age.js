document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const dateOfBirthField = document.getElementById('date_of_birth');
    const ageField = document.getElementById('current_age');

    form.addEventListener('submit', function(event) {
        const dateOfBirth = new Date(dateOfBirthField.value);
        const currentAge = parseInt(ageField.value);

        const today = new Date();
        let calculatedAge = today.getFullYear() - dateOfBirth.getFullYear();
        const monthDifference = today.getMonth() - dateOfBirth.getMonth();

        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateOfBirth.getDate())) {
            calculatedAge--;
        }

        if (calculatedAge !== currentAge) {
            event.preventDefault(); // Prevent form submission
            alert('The age entered does not match the calculated age based on the date of birth.');
        }
    });
});
