</div>

  <!-- Bootstrap Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("mainContent");

    // Toggle Sidebar Function
    function toggleSidebar() {
      sidebar.classList.toggle("active");
      mainContent.classList.toggle("collapsed");
    }

    // Example of Search Functionality
    function searchMovies() {
      const query = document.getElementById("search").value.toLowerCase();
      const filmList = document.getElementById("filmList");

      // Replace with dynamic rendering logic
      if (query === "") {
        filmList.innerHTML = `<p class="text-center">Type to search movies...</p>`;
      } else {
        filmList.innerHTML = `<p class="text-center">Showing results for "<b>${query}</b>"</p>`;
      }
    }
  </script>
</body>

</html>
