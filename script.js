      const form = document.getElementById("expense-form");
      const submitBtn = document.getElementById("submit-btn");
      const tableBody = document.querySelector("#expense-table tbody");

      form.addEventListener("submit", (event) => {
        event.preventDefault();
        submitBtn.disabled = true;

        const formData = new FormData(form);
        const url = "process.php";

        fetch(url, {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            tableBody.innerHTML = "";
            data.forEach((row) => {
              const tr = document.createElement("tr");
              const dateTd = document.createElement("td");
              const categoryTd = document.createElement("td");
              const amountTd = document.createElement("td");
              const descriptionTd = document.createElement("td");

              dateTd.textContent = row.date;
              categoryTd.textContent = row.category;
              amountTd.textContent = row.amount;
              descriptionTd.textContent = row.description;

              tr.appendChild(dateTd);
              tr.appendChild(categoryTd);
              tr.appendChild(amountTd);
              tr.appendChild(descriptionTd);

              tableBody.appendChild(tr);
            });
          })
          .catch((error) => {
            console.error("Error:", error);
          })
          .finally(() => {
            submitBtn.disabled = false;
          });
      });
