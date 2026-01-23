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

document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab-btn");
  const forms = document.querySelectorAll(".form-container");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const type = tab.dataset.type;

      tabs.forEach((t) => t.classList.remove("active"));
      forms.forEach((f) => f.classList.remove("active"));
      loginBox.classList.remove("active"); 
      tab.classList.add("active");
      document.getElementById(type + "FormContainer")?.classList.add("active");

      if (type === "professional") goToStep(1);
    });
  });

  let currentStep = 1;
  const totalSteps = 3;

  window.goToStep = (step) => {
    currentStep = step;

    document
      .querySelectorAll(".form-step")
      .forEach((s) => s.classList.remove("active"));
    document.getElementById("step" + step)?.classList.add("active");

    const progress = ((step - 1) / (totalSteps - 1)) * 100;
    const bar = document.getElementById("progressBar");
    if (bar) bar.style.width = progress + "%";
  };

  document
    .querySelectorAll(".btn-next")
    .forEach((b) =>
      b.addEventListener(
        "click",
        () => currentStep < totalSteps && goToStep(currentStep + 1),
      ),
    );

  document
    .querySelectorAll(".btn-prev")
    .forEach((b) =>
      b.addEventListener(
        "click",
        () => currentStep > 1 && goToStep(currentStep - 1),
      ),
    );

  const roleSelect = document.getElementById("pro_role");
  const avocat = document.getElementById("avocatFields");
  const huissier = document.getElementById("huissierFields");

  roleSelect?.addEventListener("change", () => {
    avocat.style.display = roleSelect.value === "avocat" ? "block" : "none";
    huissier.style.display = roleSelect.value === "huisser" ? "block" : "none";
  });

  document.querySelectorAll(".password-toggle").forEach((btn) => {
    btn.addEventListener("click", () => {
      const input = btn.previousElementSibling;
      input.type = input.type === "password" ? "text" : "password";
    });
  });

  const loginBtn = document.querySelector(".loginToggleBtn");
  const loginBox = document.querySelector(".login-form-container");
  const form = document.querySelectorAll(".form-container");

  loginBtn?.addEventListener("click", () => {
    form.forEach((f) => f.classList.remove("active"));

    loginBox.classList.toggle("active");
  });

  // inscrire.addEventListener("click", () => {
  //   loginBox.classList.toggle("active");
  //   formcont.style.display = "block";
  // });
});
// document.querySelector("#professionalFormContainer").style.display = "block";

const uploadForm = document.getElementById("uploadForm");

uploadForm?.addEventListener("submit", function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  fetch("uploadfile.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((response) => {
      if (response === "OK") {
        alert("Upload successfully!");
        goToStep(3);
      } else {
        alert("Upload failed");
      }
    });
});

