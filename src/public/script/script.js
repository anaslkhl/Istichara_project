const searchInput = document.querySelector("#searching");
const typeSelect = document.querySelector("select[name='type']");

async function getData() {
  const name = searchInput.value;
  const type = typeSelect.value.toLowerCase();

  const url = `allData.php?query=${encodeURIComponent(name)}&type=${encodeURIComponent(type)}`;

  try {
    const response = await fetch(url);
    const result = await response.json();

    const cardsCont = document.querySelector(".cards");
    cardsCont.innerHTML = "";

    result.forEach((person) => {
      const card = document.createElement("div");
      card.className = "card";
      card.innerHTML = `
        <div class="card-header">
          <h3>${person.fullname}</h3>
          <span class="role-badge">${person.speciality ?? ""}</span>
        </div>
        <div class="card-body">
          <p><strong>Spécialité:</strong> ${person.speciality ?? person.type_actes ?? ""}</p>
          <p><strong>Expérience:</strong> ${person.experience} ans</p>
          <p><strong>Tarif:</strong> ${person.tarif} MAD</p>
          ${person.consultate_online ? `<p><strong>Consultation en ligne:</strong> ${person.consultate_online}</p>` : ""}
        </div>
        <form class="card-footer" method="POST" action="delete">
          <input type="hidden" name="delete" value="${person.id}">
          <button type="submit" class="del">Delete</button>
          <a href="/form/${person.id}" class="btn-view">Edit</a>
        </form>
      `;
      cardsCont.appendChild(card);
    });
  } catch (error) {
    console.error(error.message);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const tabButtons = document.querySelectorAll(".tab-btn");
  tabButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const userType = this.dataset.type;

      tabButtons.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");

      document.querySelectorAll(".form-container").forEach((form) => {
        form.classList.remove("active");
      });

      document
        .getElementById(userType + "FormContainer")
        .classList.add("active");
    });
  });
});

// added by hafid
function toggleForm() {
  // if (document.getElementById('modalll').style.display == 'none'){

  //   document.getElementById('modalll').style.display = "block";
  // }
  // else{

  //   document.getElementById('modalll').style.display = "none"
  // }
  document.getElementById('modalll').style.display = "block";
}