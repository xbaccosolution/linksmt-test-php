let currentPage = 1;
let totalPages = 1;
const perPage = 20;

const token = sessionStorage.getItem('token'); // Recupera il token dalla sessione

// Funzione per determinare quante birre ci sono:
async function loadTotalPages() {
    const response = await fetch(`/api/breweries/total?per_page=${perPage}`, {
        headers: {
            'Authorization': `Bearer ${sessionStorage.getItem('token')}`
        }
    });

    if (response.ok) {
        const breweries = await response.json();
        const total = breweries.total;

        document.getElementById('totBreweries').innerHTML = total;

        // totale pagine
        totalPages = calculateTotalPages(total, perPage);

        // Carica la prima pagina all'avvio
        loadBreweries(currentPage);
    } else {
        alert('Failed to load breweries');
    }
}

// Funzione per caricare le birrerie
async function loadBreweries(page) {
    const response = await fetch(`/api/breweries?page=${page}&per_page=${perPage}`, {
        headers: {
            'Authorization': `Bearer ${sessionStorage.getItem('token')}`
        }
    });

    if (response.ok) {
        const breweries = await response.json();
        const list = document.getElementById('breweryList');
        list.innerHTML = '';

        breweries.forEach(brewery => {
            const item = document.createElement('li');
            item.textContent = brewery.name;
            item.dataset.breweryId = brewery.id; // Salva l'ID della birreria
            item.classList.add('brewery-item');
            list.appendChild(item);
        });

        document.getElementById('totalPages').innerHTML = 'Pagina ' + page + '/' + totalPages;

        document.getElementById('prevPage').disabled = page === 1;
        document.getElementById('nextPage').disabled = breweries.length < perPage;
    } else {
        alert('Failed to load breweries');
    }
}

// Funzione per mostrare i dettagli di una singola birreria
async function showBreweryDetails(breweryId) {
    const response = await fetch(`/api/breweries/${breweryId}`, {
        headers: {
            'Authorization': `Bearer ${sessionStorage.getItem('token')}`
        }
    });

    if (response.ok) {
        const brewery = await response.json();
        const modal = document.getElementById('breweryModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
            <h2>${brewery.name}</h2>
            <p><strong>Type:</strong> ${brewery.brewery_type}</p>
            <p><strong>Country:</strong> ${brewery.country}</p>
            <p><strong>Address:</strong> ${brewery.street}, ${brewery.city}, ${brewery.state}</p>
            <button id="closeModal">Chiudi</button>
        `;

        modal.style.display = 'block';

        document.getElementById('closeModal').addEventListener('click', () => {
            modal.style.display = 'none';
        });
    } else {
        alert('Failed to load brewery details');
    }
}

function calculateTotalPages(totalItems, itemsPerPage) {
    return Math.ceil(totalItems / itemsPerPage);
}

// Event listener per il clic sulle birrerie
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('brewery-item')) {
        const breweryId = e.target.dataset.breweryId;
        showBreweryDetails(breweryId);
    }
});

// Event listener per i pulsanti di navigazione
document.getElementById('prevPage').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        loadBreweries(currentPage);
    }
});

document.getElementById('nextPage').addEventListener('click', () => {
    currentPage++;
    loadBreweries(currentPage);
});

loadTotalPages();

