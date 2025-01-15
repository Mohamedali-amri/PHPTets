document.getElementById("upload-button").addEventListener("click", function () {
  const fileInput = document.getElementById("json-file");
  if (fileInput.files.length === 0) {
    alert("Please select a JSON file.");
    return;
  }

  const file = fileInput.files[0];
  const formData = new FormData();
  formData.append("json-file", file);

  fetch("upload_json.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      fetchResults();
    })
    .catch((error) => {
      console.error("Upload error:", error);
      alert("An error occurred.");
    });
});

function resetFilters() {
  document.getElementById("employee_name").value = "";
  document.getElementById("event_name").value = "";
  document.getElementById("event_date").value = "";
  fetchResults();
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("reset-button")
    .addEventListener("click", resetFilters);

  document
    .getElementById("employee_name")
    .addEventListener("input", fetchResults);
  document.getElementById("event_name").addEventListener("input", fetchResults);
  document
    .getElementById("event_date")
    .addEventListener("change", fetchResults);

  fetchResults();
});

function fetchResults() {
  const employeeName = document.getElementById("employee_name").value;
  const eventName = document.getElementById("event_name").value;
  const eventDate = document.getElementById("event_date").value;

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `ajax_filter.php?employee_name=${employeeName}&event_name=${eventName}&event_date=${eventDate}`,
    true
  );
  xhr.onload = function () {
    if (this.status === 200) {
      const response = JSON.parse(this.responseText);
      const tableBody = document.getElementById("table-body");
      const totalFee = document.getElementById("total-fee");

      tableBody.innerHTML = "";
      if (response.data && response.data.length > 0) {
        response.data.forEach((row) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
                      <td>${row.participation_id}</td>
                      <td>${row.employee_name}</td>
                      <td>${row.employee_mail}</td>
                      <td>${row.event_name}</td>
                      <td>${parseFloat(row.participation_fee).toFixed(2)} €</td>
                      <td>${row.event_date}</td>
                  `;
          tableBody.appendChild(tr);
        });
      } else {
        tableBody.innerHTML = '<tr><td colspan="7">No results found.</td></tr>';
      }

      totalFee.textContent = response.total_fee.toFixed(2) + " €";
    }
  };
  xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("employee_name")
    .addEventListener("input", fetchResults);
  document.getElementById("event_name").addEventListener("input", fetchResults);
  document
    .getElementById("event_date")
    .addEventListener("change", fetchResults);

  fetchResults();
});

