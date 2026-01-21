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
  console.log("Form script loaded");

  const tabButtons = document.querySelectorAll(".tab-btn");
  const formContainers = document.querySelectorAll(".form-container");

  tabButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const type = this.getAttribute("data-type");

      tabButtons.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");

      formContainers.forEach((container) => {
        container.classList.remove("active");
        if (container.id === type + "FormContainer") {
          container.classList.add("active");
        }
      });

      if (type === "professional") {
        goToStep(1);
      }
    });
  });

  let currentStep = 1;
  const totalSteps = 3;

  document.querySelectorAll(".btn-next").forEach((button) => {
    button.addEventListener("click", function () {
      if (currentStep < totalSteps) {
        goToStep(currentStep + 1);
      }
    });
  });

  document.querySelectorAll(".btn-prev").forEach((button) => {
    button.addEventListener("click", function () {
      if (currentStep > 1) {
        goToStep(currentStep - 1);
      }
    });
  });

  function goToStep(stepNumber) {
    document.querySelectorAll(".form-step").forEach((step) => {
      step.classList.remove("active");
    });

    const stepElement = document.getElementById("step" + stepNumber);
    if (stepElement) {
      stepElement.classList.add("active");
    }

    updateProgressBar(stepNumber);

    document.querySelectorAll(".step").forEach((step) => {
      const stepValue = parseInt(step.getAttribute("data-step"));
      if (stepValue <= stepNumber) {
        step.classList.add("active");
      } else {
        step.classList.remove("active");
      }
    });

    currentStep = stepNumber;
  }

  function updateProgressBar(step) {
    const progress = ((step - 1) / (totalSteps - 1)) * 100;
    const progressBar = document.getElementById("progressBar");
    if (progressBar) {
      progressBar.style.width = progress + "%";
    }
  }

  const roleSelect = document.getElementById("pro_role");
  if (roleSelect) {
    roleSelect.addEventListener("change", function () {
      const role = this.value;

      document.getElementById("avocatFields").style.display = "none";
      document.getElementById("huissierFields").style.display = "none";

      if (role === "avocat") {
        document.getElementById("avocatFields").style.display = "block";
      } else if (role === "huissier") {
        document.getElementById("huissierFields").style.display = "block";
      }
    });
  }

  document.querySelectorAll(".password-toggle").forEach((button) => {
    button.addEventListener("click", function () {
      const input = this.parentElement.querySelector("input");
      const icon = this.querySelector("i");

      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });
  });

  document.querySelectorAll(".upload-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const uploadArea = this.closest(".upload-area");
      const inputId = uploadArea.id.replace("Upload", "");
      const fileInput = document.getElementById(inputId);

      if (fileInput) {
        fileInput.click();
      }
    });
  });

  document.querySelectorAll('input[type="file"]').forEach((input) => {
    input.addEventListener("change", function () {
      const uploadArea = this.closest(".upload-area");
      const fileInfo = uploadArea.querySelector(".file-info");

      if (this.files.length > 0) {
        if (this.multiple) {
          const fileNames = Array.from(this.files)
            .map((file) => file.name)
            .join(", ");
          fileInfo.textContent = `${this.files.length} fichier(s) sélectionné(s)`;
        } else {
          const file = this.files[0];
          fileInfo.textContent = file.name;
        }
        fileInfo.style.color = "#28a745";
      } else {
        fileInfo.textContent = "Aucun fichier sélectionné";
        fileInfo.style.color = "#6c757d";
      }
    });
  });

  const submitBtn = document.querySelector(
    '.submit-btn[onclick*="submitProfessionalForm"]',
  );
  if (submitBtn) {
    submitBtn.addEventListener("click", function (e) {
      e.preventDefault();

      const requiredFields = document.querySelectorAll("[required]");
      let isValid = true;

      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          isValid = false;
          field.style.borderColor = "#dc3545";
        } else {
          field.style.borderColor = "";
        }
      });

      if (!isValid) {
        alert("Veuillez remplir tous les champs obligatoires.");
        return;
      }

      const terms = document.getElementById("pro_terms");
      if (terms && !terms.checked) {
        alert("Veuillez accepter les conditions d'utilisation.");
        return;
      }

      alert("Formulaire soumis avec succès!");
    });
  }

  const clientForm = document.getElementById("clientForm");
  if (clientForm) {
    clientForm.addEventListener("submit", function (e) {
      const password = document.getElementById("client_password");
      const confirmPassword = document.getElementById(
        "client_confirm_password",
      );

      if (
        password &&
        confirmPassword &&
        password.value !== confirmPassword.value
      ) {
        e.preventDefault();
        alert("Les mots de passe ne correspondent pas.");
        return;
      }

      const terms = document.getElementById("client_terms");
      if (terms && !terms.checked) {
        e.preventDefault();
        alert("Veuillez accepter les conditions d'utilisation.");
        return;
      }

      console.log("Client form submitted");
    });
  }
});

function toggleLoginForm() {
  const loginFormContainer = document.querySelector(".login-form-container");
  if (loginFormContainer) {
    if (
      loginFormContainer.style.display === "none" ||
      loginFormContainer.style.display === ""
    ) {
      loginFormContainer.style.display = "block";
    } else {
      loginFormContainer.style.display = "none";
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const loginBtn = document.getElementById("loginToggleBtn");

  const loginForm = document.querySelector(".login-form-container");

  if (loginBtn && loginForm) {
    loginBtn.addEventListener("click", function () {
      if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
      } else {
        loginForm.style.display = "none";
      }
    });
  }
});
