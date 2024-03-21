    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
      <div class="container-fluid">
        <a class="navbar-brand"><?php echo $title; ?></a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          </ul>
          <div class="d-flex">
            <?php
            if ($_SESSION == NULL) {
            ?>

            <?php
            } else {
            ?>
              <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"><?php echo "<i class='fa-solid fa-user-gear'></i> " . $result_tb_admin[3] . ' ' . $result_tb_admin[4] . ' '; ?></button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><button class="dropdown-item" type="button" onclick="window.location.href='profile.php'"><i class="fa-solid fa-address-card"></i> ข้อมูลส่วนตัว</button></li>
                  <?php
                  if ($_SESSION["a_level"] == "admin"  ) {
                  ?>
                  
                    <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/index.php'"><i class="fas fa-cog"></i> ระบบหลังบ้าน</button></li>
                  <?php
                  }
                  ?>
                  <hr>
                  <li><button class="dropdown-item" type="button" onclick="window.location.href='logout.php'"><i class="fa-solid fa-arrow-right-from-bracket"></i> ออกจากระบบ</button></li>
                  
                </ul>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </nav>