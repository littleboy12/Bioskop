<!-- Start of the film list card section -->

<style>
  .film-detail-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    z-index: 1050;
  }

  .film-card {
    width: 90%;
    max-width: 700px;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    position: relative;
  }

  .film-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-bottom: 2px solid #f4f4f4;
  }

  .film-card .card-body {
    padding: 20px;
  }

  .film-card .card-title {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .film-card .card-text {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 15px;
  }

  .film-card .release-date {
    font-size: 0.95rem;
    color: #777;
    margin-bottom: 10px;
  }

  .film-card .duration,
  .film-card .genre,
  .film-card .rating {
    font-size: 1rem;
    color: #333;
    margin-bottom: 10px;
  }

  .film-card .rating span {
    font-weight: 700;
    color: #ffb400;
  }

  .film-card .genre span {
    font-weight: 600;
    color: #007bff;
  }

  .btn-close {
    font-size: 2rem;
    color: #888;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
    background: none;
    border: none;
  }

  .btn-close:hover {
    color: #000;
  }
</style>

<?php include "../layout/header.php" ?>
<div class="container mt-4">
  <div class="d-flex justify-content-center align-items-center">
    <input type="text" class="form-control mb-4" id="search" placeholder="Search movie title" onkeyup="searchMovies()">
    <a href="view_daftar_beli.php" class="btn btn-outline-success btn-sm">Pembelian</a>
  </div>
  <div class="row" id="filmList">

  </div>
</div>
<div class="fixed-top w-100 h-100 d-flex justify-content-center align-items-center py-2 d-none" id="detail" style="background-color:rgba(0, 0, 0, 0.34);">
  <div class="film-detail-container">
    <div class="film-card" id="filmCard">

    </div>
  </div>
</div>
<div class="fixed-top w-100 h-100 d-flex justify-content-center align-items-center py-2 d-none" id="buyTickets" style="background-color:rgba(0, 0, 0, 0.34);">
  <div class="film-detail-container">
    <div class="film-card">
      <div class="card-body">
        <div class="justify-content-center align-items-center d-flex mb-3">
          <div class="row" id="jadwal">
            <div class="col-sm">

            </div>
          </div>
        </div>
        <div class="justify-content-center align-items-center d-flex">
          <div id="seat">

          </div>
        </div>
        <div class="mt-3">
          <table class="table" style="border: transparent;">
            <tbody>
              <tr>
                <td style="width: 125px">Seat </td>
                <td id="dataSeat">Seat </td>
              </tr>
              <tr>
                <td style="width: 125px">Jam </td>
                <td id="dateTime">Jam </td>
              </tr>
              <tr>
                <td style="width: 125px">Harga </td>
                <td id="price">Rp </td>
              </tr>
            </tbody>
          </table>
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="payTickets()">Checkout</button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="closeDetailBook()">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="fixed-top w-100 h-100 d-flex justify-content-center align-items-center py-2 d-none" id="bayar" style="background-color:rgba(0, 0, 0, 0.34);">
  <div class="film-detail-container">
    <div class="film-card" id="filmCard">
      <div class="card-body">
        <div class="justify-content-center align-items-center d-flex">
          <div>
            <h4>Total Pembayaran : <span id="totalPrice">Rp </span></h4>
            <input type="text" class="form-control mt-4" id="inpBayar" placeholder="Masukan Nominal Pembayaran">
          </div>
        </div>
        <div class="mt-3">
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-success" id="bayarSekarang">Bayar</button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="closeDetailBook()">Batal</button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<?php include "../layout/footer.php" ?>
<script src="../public/Movies.js"></script>
<script src="../public/Seats.js"></script>
<!-- End of the film list card section -->