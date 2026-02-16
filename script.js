document.addEventListener('DOMContentLoaded', () => {

function showError(input, message) {
  const error = input.parentElement.parentElement.querySelector('.error-msg');
  error.textContent = message;
}

function clearError(input) {
  const error = input.parentElement.parentElement.querySelector('.error-msg');
  error.textContent = '';
}



  const form = document.getElementById('regForm');

  // Select Inputs using NAME (matches your form)
  const nameInput = form.querySelector('input[name="name"]');
  const emailInput = form.querySelector('input[name="email"]');
  const phoneInput = form.querySelector('input[name="phone"]');
  const whatsappInput = form.querySelector('input[name="whatsapp"]');
  const collegeInput = form.querySelector('input[name="college"]');
  const deptInput = form.querySelector('input[name="dept"]');
  const yearSelect = document.getElementById('passout_year');
  const districtSelect = document.getElementById('districtSelect');

  // ---------------- Name Validation ----------------
nameInput.addEventListener('input', function () {
  this.value = this.value.replace(/[^a-zA-Z ]/g, '');
  this.value = this.value.replace(/\b\w/g, (c) => c.toUpperCase());

  if (this.value.length < 3) {
    showError(this, 'Name must be at least 3 letters');
  } else {
    clearError(this);
  }
});


  // ---------------- Email Validation ----------------
emailInput.addEventListener('input', function () {
  this.value = this.value.toLowerCase().replace(/\s/g, '');
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(this.value)) {
    showError(this, 'Enter a valid email');
  } else {
    clearError(this);
  }
});


  // ---------------- Phone + WhatsApp Validation ----------------
function validatePhone(input) {
  input.addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 10);
    const val = this.value;

    const repetitive = /^(.)\1{9}$/.test(val);
    const sequential = ['1234567890', '9876543210'];

    if (val.length === 0) {
      showError(this, 'Phone number is required');
    } else if (!/^[6-9]/.test(val)) {
      showError(this, 'Must start with 6,7,8 or 9');
    } else if (val.length < 10) {
      showError(this, 'Enter 10 digit number');
    } else if (repetitive || sequential.includes(val)) {
      showError(this, 'Enter a genuine number');
    } else {
      clearError(this);
    }
  });
}

validatePhone(phoneInput);
validatePhone(whatsappInput);


  // ---------------- College Validation ----------------
collegeInput.addEventListener('input', function () {
  this.value = this.value.replace(/[^a-zA-Z.\- ]/g, '');
  this.value = this.value.replace(/\b\w/g, (c) => c.toUpperCase());

  if (this.value.length < 3) {
    showError(this, 'Enter a valid college name');
  } else {
    clearError(this);
  }
});


  // ---------------- Department Validation ----------------
deptInput.addEventListener('input', function () {
  this.value = this.value.replace(/[^a-zA-Z.\- ]/g, '');

  if (this.value.length < 2) {
    showError(this, 'Enter a valid department');
  } else {
    clearError(this);
  }
});


  // ---------------- Passout Year ----------------
yearSelect.addEventListener('change', function () {
  const error = document.getElementById('year-error');

  if (!this.value) {
    error.textContent = 'Please select your passout year';
  } else {
    error.textContent = '';
  }
});

});
