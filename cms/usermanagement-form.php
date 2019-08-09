<?php 
  require $_SERVER['DOCUMENT_ROOT'].'/staff_details/config/init.php';
    include 'inc/header.php'; 
    include 'inc/checklogin.php'; 
?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'inc/sidebar.php';?>
    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">SherpaChat</span>
                <img class="img-profile rounded-circle" src="http://corporate.sherpachat.com/images/logo-white.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <?php echo $_SESSION['name']; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php flash(); ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800" style="font-size: 28px;font-weight: bold;">Staff Add</h1>
          <div class="row">
            <div class="col-lg-12">
              <form class="form" action="process/usermanagement.php" method="post" enctype="multipart/form-data">
                <h5 style="font-weight: bold;font-size: 18px;">Personal Details</h5>
                
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="first_name">First Name: </label>
                    <input type="text" name="first_name" class="form-control " id="first_name" required placeholder="Enter Your Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="middle_name">Middle Name: </label>
                    <input type="text" name="middle_name" class="form-control " id="middle_name" placeholder="Enter Your Middle Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" class="form-control " id="last_name" required placeholder="Enter Your Last Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="father_name">Father Full Name: </label>
                    <input type="text" name="father_name" class="form-control " id="father_name" required placeholder="Enter Your Father Full Name">
                  </div>

                   <div class="form-group col-md-3">
                    <label for="mother_name">Mother Full Name: </label>
                    <input type="text" name="mother_name" class="form-control " id="mother_name" required placeholder="Enter Your Mother Full Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="">Email: </label>
                    <input type="email" name="email" class="form-control " id="email" required placeholder="Enter Your Email">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="">Phone No: </label>
                    <input type="number" name="phone_no" class="form-control " id="pnone_no" required placeholder="Enter Your Phone No">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="gender">Gender: </label>
                    <select id="gender" class="form-control" name="gender">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="others">Others</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="image">Passport Size Image: </label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="reporting">Reporting: </label>
                    <select id="reporting" class="form-control" name="reporting">
                      <option value="admin">Admin</option>
                      <option value="editor">Editor</option>
                    </select>
                  </div>

                </div>
                <hr class="sidebar-divider my-0">

                <h5 style="font-weight: bold;font-size: 18px;margin-top: 10px;">Address</h5>
                <h6 style="font-weight: bold;">Permanant Address</h6>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="muncipality">Muncipality/VDC: </label>
                    <input type="text" name="address" class="form-control " id="address" required placeholder="Enter Your Muncipality Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="district">District: </label>
                    <input type="text" name="address" class="form-control " id="address" placeholder="Enter Your District Name" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="ward_no">Ward No: </label>
                    <input type="number" name="address" class="form-control " id="address" required placeholder="Enter Your Ward No">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="street">Street: </label>
                    <input type="text" name="address" class="form-control " id="address" placeholder="Enter Your Street Name">
                  </div>
                </div>

                <h6 style="font-weight: bold;">Current Address</h6>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="muncipality">Muncipality/VDC: </label>
                    <input type="text" name="address" class="form-control " id="address" required placeholder="Enter Your Muncipality Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="district">District: </label>
                    <input type="text" name="address" class="form-control " id="address" placeholder="Enter Your District Name" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="ward_no">Ward No: </label>
                    <input type="number" name="address" class="form-control " id="address" required placeholder="Enter Your Ward No">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="street">Street: </label>
                    <input type="text" name="address" class="form-control " id="address"  placeholder="Enter Your Street Name">
                  </div>
                </div>
                <hr class="sidebar-divider my-0">

                <h5 style="font-weight: bold;font-size: 18px;margin-top: 10px;">Identifications</h5>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="date_of_birth">Date Of Birth: </label>
                    <input type="date" name="date_of_birth" class="form-control " id="date_of_birth" required placeholder="Enter Your Date Of Birth">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="id_type">Id Type: </label>
                    <input type="number" name="id_type" class="form-control " id="id_type" required placeholder="1" min="1">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="citizenship">Citizenship Number: </label>
                    <input type="number" name="citizenship" class="form-control " id="citizenship" required placeholder="154454858878785">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="issued_date">Issued Date: </label>
                    <input type="date" name="issued_date" class="form-control " id="issued_date" required placeholder="154454858878785">
                  </div>
                </div>
                <hr class="sidebar-divider my-0">

                <div class="form-group mt-2">
                  <label for="">Job Description: </label>
                  <textarea name="description" class="form-control"></textarea>
                </div>
                <hr class="sidebar-divider my-0">

                <div class="form-row mt-2">
                  <div class="form-group col-md-3">
                    <label for="status">Status: </label>
                    <select id="status" class="form-control" name="status">
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="">Role Type: </label>
                    <select name="role_type" class="form-control">
                      <option value="intern">Intern</option>
                      <option value="permanat">Permanant</option>
                      <option value="temprory">Temporary</option>
                      <option value="contract">Contract</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="">Salary: </label>
                      <select name="salary" class="form-control">
                        <option value="base salary">Base Salary</option>
                        <option value="extras salary">Extras</option>
                      </select>
                  </div> 

                  <div class="form-group col-md-3">
                    <label for="">Performance: </label>
                      <select name="performance" class="form-control">
                        <option value="project manager">Project Manager</option>
                        <option value="Product manager">Product Manager</option>
                      </select>
                  </div> 
                </div>
                <hr class="sidebar-divider my-0">

               <h5 style="font-weight: bold;font-size: 18px;margin-top: 10px;">Bank Details</h5>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="bank_name">Bank Name: </label>
                    <input type="text" name="bank_name" class="form-control " id="bank_name" required placeholder="Enter Your Bank Name">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="account_name">Account Name: </label>
                    <input type="text" name="account_name" class="form-control " id="account_name" required placeholder="Enter Your Account Name">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="account_number">Account Number: </label>
                    <input type="number" name="account_number" class="form-control " id="account_number" placeholder="Enter Your Account Number" required>
                  </div>
                </div>
                <hr class="sidebar-divider my-0">

                <button type="reset" class="btn btn-danger" style="min-width: 100px;border-radius: 30px;margin-top: 20px;padding: 4px 15px;margin-bottom: 20px;">
                  <i class="fas fa-trash"></i>
                  &nbspReset
                </button>
                <button type="submit" class="btn btn-success" style="min-width: 100px;border-radius: 30px;margin-top: 20px;padding: 4px 15px;margin-bottom: 20px;">
                  <i class="fas fa-paper-plane"></i>
                  &nbspSubmit
                </button>
              </form>                   
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright@SherpaChat.com</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

 <?php include 'inc/footer.php';?>