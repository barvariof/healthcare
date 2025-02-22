<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Poli</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPoli ?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pasien</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPasien ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-reguler fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>