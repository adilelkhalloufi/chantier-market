(function () {
  const cardsGrid = document.getElementById('cardsGrid');
  if (!cardsGrid) {
    return;
  }

  const cards = Array.from(document.querySelectorAll('.listing'));
  const resultCount = document.getElementById('resultCount');

  const searchInput = document.getElementById('searchInput');
  const brandFilter = document.getElementById('brandFilter');
  const yearMin = document.getElementById('yearMin');
  const yearMax = document.getElementById('yearMax');
  const priceMax = document.getElementById('priceMax');
  const priceLabel = document.getElementById('priceLabel');
  const sortSelect = document.getElementById('sortSelect');
  const applyBtn = document.getElementById('applyBtn');
  const resetBtn = document.getElementById('resetBtn');

  function cardValues(card) {
    return {
      name: card.dataset.name || '',
      brand: card.dataset.brand || '',
      year: Number(card.dataset.year || 0),
      price: Number(card.dataset.price || 0),
    };
  }

  function applyFilters() {
    const keyword = (searchInput?.value || '').trim().toLowerCase();
    const brand = brandFilter?.value || 'all';
    const minYear = Number(yearMin?.value || 0);
    const maxYear = Number(yearMax?.value || 9999);
    const maxPrice = Number(priceMax?.value || 999999999);

    let visible = cards.filter((card) => {
      const v = cardValues(card);
      const matchText = v.name.toLowerCase().includes(keyword);
      const matchBrand = brand === 'all' || v.brand === brand;
      const matchYear = v.year >= minYear && v.year <= maxYear;
      const matchPrice = v.price === 0 || v.price <= maxPrice;
      return matchText && matchBrand && matchYear && matchPrice;
    });

    const mode = sortSelect?.value || 'latest';
    visible.sort((a, b) => {
      const av = cardValues(a);
      const bv = cardValues(b);
      if (mode === 'priceAsc') return av.price - bv.price;
      if (mode === 'priceDesc') return bv.price - av.price;
      if (mode === 'yearDesc') return bv.year - av.year;
      return bv.year - av.year;
    });

    cards.forEach((card) => card.classList.add('hidden'));
    visible.forEach((card) => {
      card.classList.remove('hidden');
      cardsGrid.appendChild(card);
    });

    if (resultCount) {
      resultCount.textContent = visible.length + ' resultats';
    }
  }

  priceMax?.addEventListener('input', () => {
    if (priceLabel) {
      priceLabel.textContent = Number(priceMax.value).toLocaleString('fr-FR');
    }
  });

  applyBtn?.addEventListener('click', applyFilters);
  sortSelect?.addEventListener('change', applyFilters);
  searchInput?.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      applyFilters();
    }
  });

  resetBtn?.addEventListener('click', () => {
    if (searchInput) searchInput.value = '';
    if (brandFilter) brandFilter.value = 'all';
    if (yearMin) yearMin.value = '1994';
    if (yearMax) yearMax.value = '2006';
    if (priceMax) priceMax.value = '600000';
    if (priceLabel && priceMax) {
      priceLabel.textContent = Number(priceMax.value).toLocaleString('fr-FR');
    }
    if (sortSelect) sortSelect.value = 'latest';
    applyFilters();
  });

  if (priceLabel && priceMax) {
    priceLabel.textContent = Number(priceMax.value).toLocaleString('fr-FR');
  }
  applyFilters();
})();
