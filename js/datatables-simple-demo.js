window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
if (datatablesSimple) {
    
    new simpleDatatables.DataTable(datatablesSimple, {

        labels: {
            placeholder: "Hledat...", // The search input placeholder 
            perPage: "{select} záznamů na stránku", // per-page dropdown label 
            noRows: "Nebyly nalezeny žádné záznamy", // Message shown when there are no records to show 
            noResults: "Vašemu vyhledávacímu dotazu neodpovídají žádné výsledky", // Message shown when there are no search results 
            info: "Zobrazuje se {start} až {end} z {rows} záznamů" // 
             
        }
      });
}
});
