window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const tabulka = document.getElementById('tabulka');
    if (tabulka) {
        new simpleDatatables.DataTable(tabulka);
    }
    
    const search = document.getElementById('search');
    if (search) {
        new simpleDatatables.DataTable(search);
    }
});

