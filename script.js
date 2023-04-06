  // Get the form element
  const expenseForm = document.getElementById("expense-form");

  // Add event listener for form submission
  expenseForm.addEventListener("submit", (event) => {
    // Prevent default form submission behavior
    event.preventDefault();

    // Get the form input values
    const date = expenseForm.elements.date.value;
    const category = expenseForm.elements.category.value;
    const amount = expenseForm.elements.amount.value;
    const description = expenseForm.elements.description.value;

    // Check if the amount is a valid number
    if (isNaN(amount)) {
      alert("Amount must be a valid number.");
      return;
    }

    // Submit the form if all inputs are valid
    expenseForm.submit();
  });
