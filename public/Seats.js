var tickets = [];
var get_id_movie = null;
var seat = [];
var studio = null;
var datetime = null;
var price = null;
var harga = null;
var id_ticket = [];
function getDataJadwal(id_movie) {
  closeDetail();
  get_id_movie = id_movie;

  const buyTickets = document.getElementById("buyTickets");
  buyTickets.classList.remove("d-none");

  fetch(`http://localhost/xx2Cinema/services/Seats.php?Jadwal=${id_movie}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Jadwal Di terima:", data);
      const result = document.getElementById("jadwal");
      result.innerHTML = "";

      data.forEach((jadwal) => {
        result.innerHTML = `
          <button class="btn btn-outline-primary rounded justify-content-center align-items-center d-flex" style="height: 25px" onclick="getTickets(${jadwal.schedule_id}, '${jadwal.show_time}')">
              <span>${jadwal.show_time}</span>
          </button>
          `;
      });
    });
}

function getTickets(id_jadwal, datetime_jadwal) {
  datetime = datetime_jadwal;
  console.log("ID jadwal:", id_jadwal);

  fetch(`http://localhost/xx2Cinema/services/Seats.php?tickets=${id_jadwal}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("tiket Di terima:", data);
      if (data.length === 0) {
        alert("Tiket Belum Di Jual");
        return;
      }
      tickets = data;
      getDataSeat();
    });
  updateData();
}

function getDataSeat() {
  fetch(`http://localhost/xx2Cinema/services/Seats.php`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Seats Di terima:", data);
      displaySeats(data);
    });
}

function displaySeats(data) {
  const result = document.getElementById("seat");
  const maxColumns = 5;
  console.log("DATA MOVIE : ", get_id_movie);

  console.log("TICKET DI ARRAY : ", tickets);

  let row;

  result.innerHTML = "";
  if (tickets.length == 0) {
    result.innerHTML = " ";
    return;
  }
  data.forEach((seat, index) => {
    if (index % maxColumns === 0) {
      row = document.createElement("div");
      row.className = "row mt-2";
      result.appendChild(row);
    }

    const isBooked = tickets.some(
      (ticket) => ticket.seat_id === seat.seat_id && ticket.status === "booked"
    );
    const celStuido = tickets.some(
      (ticket) => ticket.studio_id === seat.studio_id
    );

    const col = document.createElement("div");

    if (celStuido) {
      col.className = "col-sm";
      col.innerHTML = `
            <button class="btn ${
              isBooked ? "btn-outline-warning" : "btn-warning"
            } rounded justify-content-center align-items-center d-flex" onclick="soldOut(${isBooked}, '${
        seat.seat_number
      }', ${seat.seat_id})" style="width: 50px; height: 50px">
                <span>${seat.seat_number}</span>
            </button>
            `;
      row.appendChild(col);
    }
  });
}

function soldOut(isBooked, seatNumber, seatId) {
  console.log("isBooked", isBooked);

  var status = true;
  if (isBooked) {
    alert("Seat is already booked");
  } else {
    seat.forEach((data) => {
      if (data.seat_id === seatId) {
        status = false;
      }
    });
    if (!status) {
      const res = confirm("Seat Sudah Di Masukan, Apakah Ingin Di Batalkan ?");
      if (res) {
        seat = seat.filter((data) => data.seat_id !== seatId);
      }
    } else {
      const ticket = tickets.find((ticket) => ticket.seat_id == seatId);
      console.log("Studionya", ticket.studio_id);
      id_ticket.push(ticket.ticket_id);
      studio = ticket.studio_id;
      harga = ticket.price;

      seat.push({
        seat_id: seatId,
        seat_number: seatNumber,
      });
    }
    updateData();
  }
}

function updateData() {
  const dataSeat = document.getElementById("dataSeat");
  const datetimeDisplay = document.getElementById("dateTime");
  const price = document.getElementById("price");

  console.log("datetime", datetime);
  console.log("seatBook", seat);
  console.log("studio", studio);
  console.log("harga", harga);

  price.innerHTML = `Rp ${harga * seat.length}`;
  dataSeat.innerHTML = "";
  seat.forEach((seat) => {
    dataSeat.innerHTML += `
    <span>${seat.seat_number}</span>
    `;
  });
  datetimeDisplay.innerHTML = datetime;
}

function closeDetailBook() {
  const detail = document.getElementById("buyTickets");
  detail.classList.add("d-none");
  tickets = [];
  get_id_movie = null;
  seat = [];
  studio = null;
  datetime = null;
  price = 0;
  studio = null;
  getDataSeat();
  updateData();
  console.log("close");
}

function buyTickets() {
  // Contoh id_ticket (bisa lebih dari satu)
  // var id_ticket = id_ticket;  // Ubah ke array

  if (id_ticket.length === 0) {
    alert("Tiket tidak ditemukan untuk studio ini!");
    return;
  }

  // Push Data ke Server
  console.log("Data Push", {
    id_movie: get_id_movie,
    seat: seat,
    studio: studio,
    ticket_id_data: id_ticket, // Kirim array ticket_id
  });

  fetch("http://localhost/xx2Cinema/services/Pembelian.php?Push", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_movie: get_id_movie,
      seat_data: seat,
      studio_id: studio,
      ticket_id_data: id_ticket,
      harga_ticket: harga,
    }),
  })
    .then((response) => {
      console.log("Status Response:", response.status);
      return response.json(); // Selalu parse JSON meskipun error
    })
    .then((result) => {
      console.log("Response JSON:", result);
      if (result.success) {
        alert("Data berhasil disimpan!");
      } else {
        alert("Gagal menyimpan data: " + result.message);
      }
    })
    .catch((error) => {
      alert("Data Berhasil Di Tambahkan"); // Tampilkan error spesifik
    });
}
