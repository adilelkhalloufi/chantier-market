(function () {
  const dashboardUrl =
    (window.btp360Data && window.btp360Data.dashboardUrl) ||
    "/dashboard-client/";

  const filters = document.querySelectorAll(".cat-filter");
  const listings = document.querySelectorAll("#homeListings .listing");

  if (filters.length && listings.length) {
    filters.forEach((btn) => {
      btn.addEventListener("click", () => {
        const cat = btn.dataset.cat;
        filters.forEach((b) => b.classList.remove("btn-brand"));
        btn.classList.add("btn-brand");
        listings.forEach((card) => {
          const show = cat === "all" || card.dataset.cat === cat;
          card.classList.toggle("hidden", !show);
        });
      });
    });
    filters[0].click();
  }

  const tabLogin = document.getElementById("tabLogin");
  const tabRegister = document.getElementById("tabRegister");
  const loginForm = document.getElementById("loginForm");
  const registerForm = document.getElementById("registerForm");

  if (tabLogin && tabRegister && loginForm && registerForm) {
    function showLogin() {
      loginForm.classList.remove("hidden");
      registerForm.classList.add("hidden");
      tabLogin.classList.add("active");
      tabRegister.classList.remove("active");
    }

    function showRegister() {
      registerForm.classList.remove("hidden");
      loginForm.classList.add("hidden");
      tabRegister.classList.add("active");
      tabLogin.classList.remove("active");
    }

    tabLogin.addEventListener("click", showLogin);
    tabRegister.addEventListener("click", showRegister);

    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      window.location.href = dashboardUrl;
    });

    registerForm.addEventListener("submit", (e) => {
      e.preventDefault();
      window.location.href = dashboardUrl;
    });
  }

  const dashTabs = document.querySelectorAll(".dash-tab");
  const dashPanels = {
    profil: document.getElementById("panelProfil"),
    annonces: document.getElementById("panelAnnonces"),
    parametres: document.getElementById("panelParametres"),
  };

  if (dashTabs.length && dashPanels.profil) {
    function activate(key) {
      dashTabs.forEach((tab) => {
        const active = tab.dataset.tab === key;
        tab.classList.toggle("btn-brand", active);
      });

      Object.keys(dashPanels).forEach((name) => {
        dashPanels[name].classList.toggle("hidden", name !== key);
      });
    }

    dashTabs.forEach((tab) => {
      tab.addEventListener("click", () => activate(tab.dataset.tab));
    });
  }

  const formRoot = document.getElementById("createProductForm");
  if (formRoot) {
    const categoryInput = document.getElementById("category");
    const subcategoryInput = document.getElementById("subcategory");
    const categoryCards = document.querySelectorAll(".category-card");
    const subcategoryGrid = document.getElementById("subcategoryGrid");

    const step1 = document.getElementById("step1");
    const step2 = document.getElementById("step2");
    const step3 = document.getElementById("step3");

    const toStep2 = document.getElementById("toStep2");
    const toStep3 = document.getElementById("toStep3");
    const backToStep1 = document.getElementById("backToStep1");
    const backToStep2 = document.getElementById("backToStep2");

    const subcategoriesByCategory = {
      "Materiels TP": ["Pelle", "Tractopelle", "Chargeuse", "Bulldozer"],
      Manutention: [
        "Chariot elevateur",
        "Chariot telescopique",
        "Gerbeur",
        "Nacelle",
      ],
      "Poids Lourds": [
        "Tracteur routier",
        "Camion",
        "Ensemble routier",
        "Semi remorque",
      ],
      Agricole: [
        "Tracteur agricole",
        "Moissonneuse",
        "Outils du sol",
        "Fenaison",
      ],
    };

    function showStep(num) {
      step1.classList.toggle("hidden", num !== 1);
      step2.classList.toggle("hidden", num !== 2);
      step3.classList.toggle("hidden", num !== 3);
    }

    function renderSubcategories(category) {
      const items = subcategoriesByCategory[category] || [];
      subcategoryGrid.innerHTML = "";
      subcategoryInput.value = "";
      items.forEach((item) => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "btn btn-outline";
        btn.textContent = item;
        btn.addEventListener("click", () => {
          subcategoryInput.value = item;
        });
        subcategoryGrid.appendChild(btn);
      });
    }

    categoryCards.forEach((card) => {
      card.addEventListener("click", () => {
        categoryInput.value = card.dataset.category;
        renderSubcategories(card.dataset.category);
      });
    });

    toStep2?.addEventListener("click", () => {
      if (!categoryInput.value) {
        categoryInput.reportValidity();
        return;
      }
      showStep(2);
    });

    toStep3?.addEventListener("click", () => {
      if (!subcategoryInput.value) {
        subcategoryInput.reportValidity();
        return;
      }
      showStep(3);
    });

    backToStep1?.addEventListener("click", () => showStep(1));
    backToStep2?.addEventListener("click", () => showStep(2));

    formRoot.addEventListener("submit", (e) => {
      e.preventDefault();
      window.location.href = dashboardUrl;
    });
  }
})();
