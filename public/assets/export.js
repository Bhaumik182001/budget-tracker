// New version with proper error handling
function exportToCSV() {
    fetch('/api/transactions/export')
      .then(response => {
        if (!response.ok) throw new Error('Export failed');
        return response.blob();
      })
      .then(blob => {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `transactions_${new Date().toISOString().slice(0,10)}.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      })
      .catch(error => {
        alert(error.message);
        console.error('Export Error:', error);
      });
  }