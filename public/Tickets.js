getDataTickets();

var dataTicket = [];
var idTrans = [];
function getDataTickets() {
  fetch("http://localhost/xx2Cinema/services/Tickets.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("data Di terima:", data);
      dataTicket = data;
      displayTickets(data);
    });
}

function displayTickets(data) {
  const result = document.getElementById("daftar-beli");
  const riwayat = document.getElementById("daftar-riwayat");
  const maxColumns = 5;
  let row;

  result.innerHTML = "";
  riwayat.innerHTML = "";

  // Cek jika data kosong
  if (data.length === 0) {
    result.innerHTML = " ";
    riwayat.innerHTML = " ";
    return;
  }

  const displayed = new Set();

  data.forEach((ticket, index) => {
    const key = `${ticket.user_id}-${ticket.title}-${ticket.purchase_date}`;
    if (displayed.has(key)) {
      return;
    }
    displayed.add(key);

    if (index % maxColumns === 0) {
      row = document.createElement("div");
      row.className = "row";
    }

    if (ticket.status === "Sudah") {
      row.innerHTML += `
              <div class="col-md-4 film-item">
                  <div class="card mb-4 shadow-sm">
                      <div class="card-body">
                          <h3>${ticket.title}</h3>
                          <p class="card-text">${ticket.description}</p>
                      </div>
                  </div>
              </div>
            `;
      result.appendChild(row);
    } else {
      row.innerHTML += `
              <div class="col-md-4 film-item">
                  <div class="card mb-4 shadow-sm">
                      <div class="card-body">
                          <h3>${ticket.title}</h3>
                          <p class="card-text">${ticket.description}</p>
                          <button class="btn btn-outline-success btn-sm" onclick="cetakTicket()">Cetak</button>
                      </div>
                  </div>
              </div>
            `;
      result.appendChild(row);
    }
  });
}

function cetakTicket() {
    const rev = confirm('Yakin Ingin Di Cetak ?')

    if (rev) {
        if (dataTicket.length === 0) {
            alert("Tidak ada produk yang dibeli untuk dicetak!");
            return;
        }
        
        let notaContent = `
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .card {
                        border: 1px solid #000;
                        border-radius: 8px;
                        padding: 16px;
                        margin: 10px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }
                    .card h3 {
                        margin: 0 0 10px;
                    }
                    .product {
                        margin-bottom: 10px;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }
                    .total, .diskon, .total-bayar {
                        font-weight: bold;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>`;
        
        dataTicket.forEach(data => {
            if (data.status === "Belum") {
                notaContent += `
                    <div class="card">
                        <h3>${data.title}</h3>
                        <p>${data.show_time}</p>
                        <p><b> ${data.studio_name}  ${data.seat_number}</b></p>
                    </div>`;
                idTrans.push(data.transaction_id);
            }
        });;
        
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(notaContent);
        printWindow.document.close(); 
        printWindow.print(); 

        fetch("http://localhost/xx2Cinema/services/Tickets.php?Cetak", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              massage: "DI CETAK",
              push: idTrans,
            }),
          })
          .then((response) => {
            console.log("Status Response:", response.status);
            return response.json(); // Selalu parse JSON meskipun error
          })
          .then((result) => {
            console.log("Response JSON:", result);
          })
        
    }
}
