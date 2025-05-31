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
      Barang Masuk
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
            <li class="menu-item active">
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
            <li class="menu-item">
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
                <h2>Barang Masuk</h2>
              </div>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

              <!-- Tombol untuk memicu modal -->
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary w-auto my-2 ms-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah Barang
                    </button>
                    <!-- Search -->
                    <div class="form-group w-auto my-2 ">
                        <form method="get" class="d-flex">
                            <input type="text" name="search" value="<?=$search;?>" class="form-control me-1" placeholder="Cari Nama Barang" />
                            <button type="submit" class="btn btn-primary ml-2">Cari</button>
                        </form>
                    </div>
                </div>

                <!-- Search & Filter -->
                <div class="d-flex gap-2">
                    <!-- Pilihan Per Page -->
                    <div class="form-group w-auto my-2 ms-3 d-flex align-items-center">
                        <label for="perPage" class="me-2">Tampilkan</label>
                        <select id="perPage" class="form-control" onchange="window.location.href='?page=1&per_page=' + this.value + '&search=<?=$search;?>'">
                            <option value="10" <?= $perPage == 10 ? 'selected' : ''; ?>>10</option>
                            <option value="20" <?= $perPage == 20 ? 'selected' : ''; ?>>20</option>
                            <option value="50" <?= $perPage == 50 ? 'selected' : ''; ?>>50</option>
                            <option value="100" <?= $perPage == 100 ? 'selected' : ''; ?>>100</option>
                        </select>
                    </div>

                    <!-- Filter Tahun -->
                    <form method="get" class="my-2 d-flex align-items-center">
                      <label for="filterTahun" class="form-label mb-0 me-2">Filter Tahun:</label>
                      <select name="tahun_filter" id="filterTahun" class="form-select w-auto me-2">
                        <option value="">Semua Tahun</option>
                        <option value="2024" <?= (isset($_GET['tahun_filter']) && $_GET['tahun_filter'] == '2024') ? 'selected' : ''; ?>>2024</option>
                        <option value="2023" <?= (isset($_GET['tahun_filter']) && $_GET['tahun_filter'] == '2023') ? 'selected' : ''; ?>>2023</option>
                        <option value="2022" <?= (isset($_GET['tahun_filter']) && $_GET['tahun_filter'] == '2022') ? 'selected' : ''; ?>>2022</option>
                        <!-- Tambahkan lebih banyak tahun sesuai kebutuhan -->
                      </select>
                      <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                  </div>
                  
              <!-- Tabel -->
                <div class="card">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Penerima</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "select * from masuk m, stock s where s.idbarang = m.idbarang");
                                        $i = 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $tanggal = $data['tanggal'];
                                            $kodebarang = $data['kodebarang'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['penerima'];
                                            $keterangan = $data['keterangan'];
                                        
                                        ?>
                          <tr>
                                                                      <td><?=$i++;?></td>
                                            <td><?=$tanggal?></td>
                                            <td><?=$kodebarang;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$keterangan;?></td>
                            <td>
                                                <button type="button" class="btn btn-warning my-1 mx-1" data-bs-toggle="modal" data-bs-target="#edit<?=$idm;?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="idbarangygdihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger my-1 mx-1" data-bs-toggle="modal" data-bs-target="#delete<?=$idm;?>">
                                                    Delete
                                                </button>
                                                <input type="hidden" name="idbarangygdihapus" value="<?=$idb;?>">
                                            </td>
                          </tr>

                          <!-- Edit Modal -->
                                         <div class="modal fade" id="edit<?=$idm;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- modal header -->
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Barang</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="kodebarang" value="<?=$kodebarang;?>" placeholder="Kode Barang" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="namabarang" value="<?=$namabarang;?>" placeholder="Nama Barang" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="qty" value="<?=$qty;?>" placeholder="Jumlah Barang" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="penerima" value="<?=$penerima;?>" placeholder="Penerima Barang" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" placeholder="Keterangan" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idm;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- modal header -->
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Barang</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <!-- modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <?php
                                        };
                                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- PAGINATION -->
                <div class="pagination justify-content-center mt-1">
                  <ul class="pagination">
                    <!-- First Button -->
                    <li class="page-item first <?= ($page == 1) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?page=1&per_page=<?=$perPage;?>&search=<?=$search;?>">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                      </a>
                    </li>

                    <!-- Previous Button -->
                    <li class="page-item prev <?= ($page == 1) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?page=<?= ($page > 1) ? $page - 1 : 1; ?>&per_page=<?=$perPage;?>&search=<?=$search;?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                      </a>
                    </li>

                    <!-- Page Numbers -->
                    <?php
                    // Set the range for pages to be displayed
                    $start = max(1, $page - 2); // Start is 2 pages before the current page, but not less than 1
                    $end = min($totalPages, $page + 2); // End is 2 pages after the current page, but not more than the last page

                    // Ensure there are exactly 5 pages displayed
                    if ($end - $start < 4) {
                        if ($start == 1) {
                            $end = min($totalPages, $start + 4); // If start is 1, extend the range to show 5 pages
                        } else {
                            $start = max(1, $end - 4); // If the range is less than 5, adjust the start to show 5 pages
                        }
                    }

                    // Loop to display the page numbers
                    for ($i = $start; $i <= $end; $i++) {
                    ?>
                      <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?=$i;?>&per_page=<?=$perPage;?>&search=<?=$search;?>">
                          <?= $i; ?>
                        </a>
                      </li>
                    <?php } ?>

                    <!-- Next Button -->
                    <li class="page-item next <?= ($page == $totalPages) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?page=<?= ($page < $totalPages) ? $page + 1 : $totalPages; ?>&per_page=<?=$perPage;?>&search=<?=$search;?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                      </a>
                    </li>

                    <!-- Last Button -->
                    <li class="page-item last <?= ($page == $totalPages) ? 'disabled' : ''; ?>">
                      <a class="page-link" href="?page=<?=$totalPages;?>&per_page=<?=$perPage;?>&search=<?=$search;?>">
                        <i class="tf-icon bx bx-chevrons-right"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- END PAGINATION -->
                  </div>
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

    <!-- JS OTOMATIS KODE -->
     <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectBarang = document.querySelector('select[name="barangnya"]');
                const inputKode = document.getElementById('kodebarang');

                // saat pertama kali modal dibuka
                selectBarang.addEventListener('change', function () {
                    const selectedOption = selectBarang.options[selectBarang.selectedIndex];
                    const kode = selectedOption.getAttribute('data-kode');
                    inputKode.value = kode;
                });

                // trigger awal ketika modal dibuka
                selectBarang.dispatchEvent(new Event('change'));
            });
        </script>

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
  </body>
  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- modal header -->
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang Masuk</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- modal body -->
              <form method="post">
                  <div class="modal-body">
                      <select name="barangnya" class="form-control">
                      <option value="">-- Pilih Barang --</option>
                          <?php
                              $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                              while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                  $namabarangnya = $fetcharray['namabarang'];
                                  $idbarangnya = $fetcharray['idbarang'];
                                  ?>

                                  <option value="<?=$idbarangnya;?>" data-kode="<?=$fetcharray['kodebarang'];?>">
                                      <?=$namabarangnya;?>
                                  </option>
                                  <?php
                              }
                          ?>
                      </select>
                      <br>
                      <input type="text" name="kodebarang" id="kodebarang" placeholder="Kode Barang" class="form-control" readonly>
                      <br>
                      <input type="number" name="qty" placeholder="Jumlah" class="form-control" required>
                      <br>
                      <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
                      <br>
                      <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
                      <br>
                      <button type="submit" class="btn btn-primary" name="addbarangmasuk">Submit</button>
                  </div>
              </form>
          </div>
      </div>
    </div>


</html>
