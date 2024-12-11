<?php
require_once __DIR__ . '/layout.php';

$content = function () {
?>
    <div>
        <h1>Lista Birre <span class="small">(<span id="totBreweries"></span>)</span></h1>
        <ul id="breweryList"></ul>
        <div>
            <div id="totalPages">
            </div>
            <button id="prevPage" disabled>Indietro</button>
            <button id="nextPage">Avanti</button>
        </div>
    </div>

    <!-- Modale per i dettagli della birreria -->
    <div id="breweryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);">
        <div id="modalContent" style="background: white; margin: 10% auto; padding: 20px; width: 50%; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <!-- Contenuto dinamico -->
        </div>
    </div>

    <script src="/assets/js/breweries.js?t=<?= time() ?>"></script>
<?php
};

layout($content);
