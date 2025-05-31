<?php

use Dom\Mysql;

require 'function.php';
require 'cek.php';

// Pengaturan Pagination dan Pencarian
$perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10; // Menentukan default per halaman 10
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Menentukan halaman default ke 1
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Menangkap kata pencarian

// Menentukan data mulai dari halaman ke berapa
$startFrom = ($page - 1) * $perPage;

// Query untuk mengambil data dengan pencarian dan limit untuk pagination
$sql = "SELECT * FROM stock WHERE namabarang LIKE '%$search%' LIMIT $startFrom, $perPage";
$ambilsemuadatastock = mysqli_query($conn, $sql);

// Menghitung total data untuk pagination
$totalRecordsResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM stock WHERE namabarang LIKE '%$search%'");
$totalRecords = mysqli_fetch_array($totalRecordsResult)['total'];
$totalPages = ceil($totalRecords / $perPage);

// FILTER TAHUN
// Mendapatkan filter tahun dari URL, jika ada
$tahunFilter = isset($_GET['tahun_filter']) ? $_GET['tahun_filter'] : '';

// Menentukan query SQL dengan filter tahun
$sql = "SELECT * FROM stock WHERE namabarang LIKE '%$search%'";

// Menambahkan kondisi untuk filter tahun jika ada
if ($tahunFilter) {
    $sql .= " AND tahun = '$tahunFilter'";
}

$sql .= " LIMIT $startFrom, $perPage"; // Pagination

$ambilsemuadatastock = mysqli_query($conn, $sql);

// Menghitung total data untuk pagination
$totalRecordsResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM stock WHERE namabarang LIKE '%$search%'");
if ($tahunFilter) {
    $totalRecordsResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM stock WHERE namabarang LIKE '%$search%' AND tahun = '$tahunFilter'");
}
$totalRecords = mysqli_fetch_array($totalRecordsResult)['total'];
$totalPages = ceil($totalRecords / $perPage);

?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>
      Export
    </title>

    <meta name="description" content="" />

    <!-- ICO -->
    <link rel="icon" href="/assets/img/logo-white.png" type="image/x-icon">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">


    <!-- Core CSS -->
    <link
      rel="stylesheet"
      href="../assets/vendor/css/core.css"
      class="template-customizer-core-css"
    />
    <link
      rel="stylesheet"
      href="../assets/vendor/css/theme-default.css"
      class="template-customizer-theme-css"
    />
    <link rel="stylesheet" href="../assets/css/Styles.css" />

    <!-- Vendors CSS -->
    <link
      rel="stylesheet"
      href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"
    />

    <link
      rel="stylesheet"
      href="../assets/vendor/libs/apex-charts/apex-charts.css"
    />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside
          id="layout-menu"
          class="layout-menu menu-vertical menu bg-menu-theme"
        >
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="/assets/img/logo2.png" alt="Logo TVRI" style="height: 30px;">
              </span>
              <span class="app-brand-text menu-text fw-bolder ms-2"
                >TVRI DKI JAKARTA</span
              >
            </a>

            <a
              href="javascript:void(0);"
              class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"
            >
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Barang</span></li>
            <!-- Daftar Barang -->
            <li class="menu-item">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Analytics">Daftar Barang</div>
              </a>
            </li>
            <!-- Barang Masuk -->
            <li class="menu-item">
              <a href="Masuk.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Analytics">Barang Masuk</div>
              </a>
            </li>
            <!-- Barang Keluar -->
            <li class="menu-item">
              <a href="Keluar.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Analytics">Barang Keluar</div>
              </a>
            </li>
            <!-- Export -->
            <li class="menu-item active">
              <a href="export.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-download"></i>
                <div data-i18n="Analytics">Export</div>
              </a>
            </li>
            <!-- Logout -->
            <li class="menu-item">
              <a
                href="logout.php"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-run"></i>
                <div data-i18n="Logout">Logout</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div
              class="navbar-nav-right align-items-center pt-3"
              id="navbar-collapse"
            >
              <!-- Search -->
              <div class="navbar-nav align-items-center text-center">
                <h2>Export Data Stock</h2>
              </div>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container mt-4">
                <!-- Filter Tahun & Search -->
                <div class="row mb-3">
                    <div class="col-md-3">
                    <form method="get">
                        <select name="tahun_filter" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tahun</option>
                        <?php
                        $tahuns = mysqli_query($conn, "SELECT DISTINCT tahun FROM stock ORDER BY tahun DESC");
                        while ($t = mysqli_fetch_assoc($tahuns)) {
                            $selected = (isset($_GET['tahun_filter']) && $_GET['tahun_filter'] == $t['tahun']) ? 'selected' : '';
                            echo "<option value='".$t['tahun']."' $selected>".$t['tahun']."</option>";
                        }
                        ?>
                        </select>
                    </form>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="card">
                    <div class="card-body">
                    <table id="dataStock" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Kuantitas</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Tahun</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                        $tahun_filter = isset($_GET['tahun_filter']) ? mysqli_real_escape_string($conn, $_GET['tahun_filter']) : '';

                        $query = "SELECT * FROM stock WHERE namabarang LIKE '%$search%'";
                        if ($tahun_filter) {
                            $query .= " AND tahun = '$tahun_filter'";
                        }
                        $ambilsemuadatastock = mysqli_query($conn, $query);
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                            $total = $data['stock'] * $data['harga'];
                            echo "<tr>
                                <td>" . $i++ . "</td>
                                <td>" . $data['kodebarang'] . "</td>
                                <td>" . $data['namabarang'] . "</td>
                                <td>" . $data['satuan'] . "</td>
                                <td>" . $data['stock'] . "</td>
                                <td>Rp" . number_format($data['harga'], 0, ',', '.') . "</td>
                                <td>Rp" . number_format($total, 0, ',', '.') . "</td>
                                <td>" . $data['tahun'] . "</td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="index.php" class="btn btn-primary mb-3 mt-4">← Kembali</a>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  
<!-- JS Library -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
  $('#dataStock').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      {
        extend: 'excelHtml5',
        title: 'Export_Data',
      },
      {
        extend: 'pdfHtml5',
        title: 'Export_Data',
        orientation: 'landscape',
        pageSize: 'A4'
      },
      'print'
    ],
    scrollX: true
  });
});
</script>
</body>


</html>
