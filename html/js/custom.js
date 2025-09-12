$('.banner-slides').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    dots: false,
    nav: true,  
    navText: ["<img src='images/arrow-img.png'>", "<img src='images/arrow-img.png'>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});


$('.slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    autoplay:true,
    responsive: {
        0: {
            items: 2
        },
        600: {
            items: 4
        },
        1000: {
            items: 6
        }
    }
});


$(".main_drop").hover(function () {
    var isHovered = $(this).is(":hover");
    if (isHovered) {
        $(this).children(".drop-menu").stop().slideDown(300);
    } else {
        $(this).children(".drop-menu").stop().slideUp(300);
    }
});









console.clear();

function ready(fn) {
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(fn, 1);
    document.removeEventListener('DOMContentLoaded', fn);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

ready(function () {

  // Global Constants

  const progressForm = document.getElementById('progress-form');

  const tabItems = progressForm.querySelectorAll('[role="tab"]'),
        tabPanels = progressForm.querySelectorAll('[role="tabpanel"]');

  let currentStep = 0;

  // Form Validation

  const isValidPhone = val => {
    const regex = new RegExp(/^[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?$/);
    return regex.test(val);
  };

  const isValidEmail = val => {
    const regex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    return regex.test(val);
  };

  const validateText = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return { isValid: false };
    } else {
      return { isValid: true };
    }
  };

  const validateSelect = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return { isValid: false, message: 'Please select an option from the dropdown menu.' };
    } else {
      return { isValid: true };
    }
  };

  const validateGroup = fieldset => {
    const choices = fieldset.querySelectorAll('input[type="radio"], input[type="checkbox"]');
    let isRequired = false, isChecked = false;
    for (const choice of choices) {
      if (choice.required) {
        isRequired = true;
      }
      if (choice.checked) {
        isChecked = true;
      }
    }
    if (!isChecked && isRequired) {
      return { isValid: false, message: 'Please make a selection.' };
    } else {
      return { isValid: true };
    }
  };

  const validateChoice = field => {
    return validateGroup(field.closest('fieldset'));
  };

  const validatePhone = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return { isValid: false };
    } else if (val !== '' && !isValidPhone(val)) {
      return { isValid: false, message: 'Please provide a valid US phone number.' };
    } else {
      return { isValid: true };
    }
  };

  const validateEmail = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return { isValid: false };
    } else if (val !== '' && !isValidEmail(val)) {
      return { isValid: false, message: 'Please provide a valid email address.' };
    } else {
      return { isValid: true };
    }
  };

  const getValidationData = field => {
    switch (field.type) {
      case 'text':
      case 'textarea':
        return validateText(field);
      case 'select-one':
        return validateSelect(field);
      case 'fieldset':
        return validateGroup(field);
      case 'radio':
      case 'checkbox':
        return validateChoice(field);
      case 'tel':
        return validatePhone(field);
      case 'email':
        return validateEmail(field);
      default:
        throw new Error(`The provided field type '${field.tagName}:${field.type}' is not supported in this form.`);
    }
  };

  const isValid = field => {
    return getValidationData(field).isValid;
  };

  const validateStep = currentStep => {
    const fields = tabPanels[currentStep].querySelectorAll('fieldset, input:not([type="radio"]):not([type="checkbox"]), select, textarea');
    const invalidFields = [...fields].filter(field => {
      return !isValid(field);
    });
    return new Promise((resolve, reject) => {
      if (invalidFields && !invalidFields.length) {
        resolve();
      } else {
        reject(invalidFields);
      }
    });
  };

  // Form Error and Success

  const FIELD_PARENT_CLASS = 'form__field',
        FIELD_ERROR_CLASS = 'form__error-text';

  function updateChoice(fieldset, status, errorId = '') {
    const choices = fieldset.querySelectorAll('[type="radio"], [type="checkbox"]');
    for (const choice of choices) {
      if (status) {
        choice.setAttribute('aria-invalid', 'true');
        choice.setAttribute('aria-describedby', errorId);
      } else {
        choice.removeAttribute('aria-invalid');
        choice.removeAttribute('aria-describedby');
      }
    }
  }

  function reportError(field, message = 'Please complete this required field.') {
    const fieldParent = field.closest(`.${FIELD_PARENT_CLASS}`);
    if (progressForm.contains(fieldParent)) {
      let fieldError = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`),
          fieldErrorId = '';
      if (!fieldParent.contains(fieldError)) {
        fieldError = document.createElement('p');
        if (field.matches('fieldset')) {
          fieldErrorId = `${field.id}__error`;
          updateChoice(field, true, fieldErrorId);
        } else if (field.matches('[type="radio"], [type="checkbox"]')) {
          fieldErrorId = `${field.closest('fieldset').id}__error`;
          updateChoice(field.closest('fieldset'), true, fieldErrorId);
        } else {
          fieldErrorId = `${field.id}__error`;
          field.setAttribute('aria-invalid', 'true');
          field.setAttribute('aria-describedby', fieldErrorId);
        }
        fieldError.id = fieldErrorId;
        fieldError.classList.add(FIELD_ERROR_CLASS);
        fieldParent.appendChild(fieldError);
      }
      fieldError.textContent = message;
    }
  }

  function reportSuccess(field) {
    const fieldParent = field.closest(`.${FIELD_PARENT_CLASS}`);
    if (progressForm.contains(fieldParent)) {
      const fieldError = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`);
      if (fieldParent.contains(fieldError)) {
        if (field.matches('fieldset')) {
          updateChoice(field, false);
        } else if (field.matches('[type="radio"], [type="checkbox"]')) {
          updateChoice(field.closest('fieldset'), false);
        } else {
          field.removeAttribute('aria-invalid');
          field.removeAttribute('aria-describedby');
        }
        fieldParent.removeChild(fieldError);
      }
    }
  }

  function reportValidity(field) {
    const validation = getValidationData(field);
    if (!validation.isValid && validation.message) {
      reportError(field, validation.message);
    } else if (!validation.isValid) {
      reportError(field);
    } else {
      reportSuccess(field);
    }
  }

  function deactivateTabs() {
    tabItems.forEach(tab => {
      tab.setAttribute('aria-selected', 'false');
      tab.setAttribute('tabindex', '-1');
    });
    tabPanels.forEach(panel => {
      panel.setAttribute('hidden', '');
    });
  }

  function activateTab(index) {
    const thisTab = tabItems[index],
          thisPanel = tabPanels[index];
    deactivateTabs();
    thisTab.focus();
    thisTab.setAttribute('aria-selected', 'true');
    thisTab.removeAttribute('tabindex');
    thisPanel.removeAttribute('hidden');
    currentStep = index;
  }

  function clickTab(e) {
    activateTab([...tabItems].indexOf(e.currentTarget));
  }

  function arrowTab(e) {
    const { keyCode, target } = e;
    const targetPrev = target.previousElementSibling,
          targetNext = target.nextElementSibling,
          targetFirst = target.parentElement.firstElementChild,
          targetLast = target.parentElement.lastElementChild;
    const isDisabled = node => node.hasAttribute('aria-disabled');
    switch (keyCode) {
      case 37: // Left arrow
        if (progressForm.contains(targetPrev) && !isDisabled(targetPrev)) {
          activateTab(currentStep - 1);
        } else if (!isDisabled(targetLast)) {
          activateTab(tabItems.length - 1);
        }
        break;
      case 39: // Right arrow
        if (progressForm.contains(targetNext) && !isDisabled(targetNext)) {
          activateTab(currentStep + 1);
        } else if (!isDisabled(targetFirst)) {
          activateTab(0);
        }
        break;
    }
  }

  tabItems[0].addEventListener('click', clickTab);
  tabItems[0].addEventListener('keydown', arrowTab);

  function handleProgress(isComplete) {
    const currentTab = tabItems[currentStep],
          nextTab = tabItems[currentStep + 1];
    if (isComplete) {
      currentTab.setAttribute('aria-disabled', 'true');
      currentTab.removeEventListener('click', clickTab);
      currentTab.removeEventListener('keydown', arrowTab);
      if (progressForm.contains(nextTab)) {
        nextTab.addEventListener('click', clickTab);
        nextTab.addEventListener('keydown', arrowTab);
        nextTab.removeAttribute('aria-disabled');
        nextTab.click();
      }
    }
  }

  function handleSuccess(fields) {
    for (const field of fields) {
      reportSuccess(field);
    }
    handleProgress(true);
  }

  function handleError(fields) {
    for (const field of fields) {
      reportValidity(field);
    }
    const firstErrorField = fields[0];
    if (firstErrorField.matches('fieldset')) {
      const firstChoice = firstErrorField.querySelector('[type="radio"], [type="checkbox"]');
      firstChoice.focus();
    } else {
      firstErrorField.focus();
    }
    handleProgress(false);
  }

  function submitForm() {
    // This is where you would process your form submission (AJAX, Fetch, etc)
    // For this example, let's assume submission is successful and display "Thank You" message
    const thankYouMessage = document.createElement('p');
    thankYouMessage.textContent = 'Thank You!';
    progressForm.innerHTML = ''; // Clear the form content
    progressForm.appendChild(thankYouMessage); // Display the "Thank You" message
  }

  progressForm.addEventListener('submit', e => {
    e.preventDefault();
    validateStep(currentStep)
      .then(() => {
        if (currentStep === tabItems.length - 1) {
          submitForm();
        } else {
          handleSuccess(tabPanels[currentStep].querySelectorAll('fieldset, input:not([type="radio"]):not([type="checkbox"]), select, textarea'));
        }
      })
      .catch(invalidFields => {
        handleError(invalidFields);
      });
  });

});
