
function exportTableToCSV(filename) {
    let csv = [];
    const rows = document.querySelectorAll("table tr");
    for (let row of rows) {
        let cols = row.querySelectorAll("td, th");
        let data = Array.from(cols).map(col => col.innerText.replace(/,/g, "")).join(",");
        csv.push(data);
    }
    let csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
    const link = document.createElement("a");
    link.setAttribute("href", csvContent);
    link.setAttribute("download", filename);
    link.click();
}
