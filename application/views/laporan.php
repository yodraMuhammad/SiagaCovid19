<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Data Laporan</title>
</head>

<body>
    <!-- <div class="container"> -->
    <h1>Data Laporan</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama Pelapor</th>
                <th scope="col">Nama Terduka</th>
                <th scope="col">Alamat</th>
                <th scope="col">Gejala</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Jadwal penjemputan</th>
                <th scope="col">Jam</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($laporan as $l) : ?>
                <tr>
                    <th scope="row"><?= $i; ?> </th>
                    <td><?= $l['nik'] ?></td>
                    <td><?= $l['nama_pelapor'] ?></td>
                    <td><?= $l['nama_terduga'] ?></td>
                    <td><?= $l['alamat'] ?></td>
                    <td><?= $l['gejala'] ?></td>
                    <td><?= date('d F Y', $l['date_created']) ?></td>
                    <td><?= date('d F, H:i', $l['date_created'] * 60 * 60 * 5) ?></td>
                    <td><?= date(' H:i', $l['date_created'] * 60 * 60 * 5) ?></td>
                    <td><?= $l['status'] ?></td>
                    <!-- <td><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSubmenu<?= $l['id']; ?>">EDIT</a></td> -->
                    <td><a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $l['id']; ?>">
                            Edit
                        </a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $l['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('laporan/edit/') . $l['id'] ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="niK" name="nik" placeholder="nik" value="<?= $l['nik'] ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="nama_pelapor" value="<?= $l['nama_pelapor']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="nama_terduga" name="nama_terduga" placeholder="nama_terduga" value="<?= $l['nama_terduga']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="<?= $l['alamat']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="gejala" name="gejala" placeholder="UgejalaRL" value="<?= $l['gejala']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="status" name="status" placeholder="status" value="<?= $l['status']; ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="date_created" name="date_created" placeholder="date_created" value="<?= $l['date_created']; ?>">
                                    </div>
                                    <!-- <div class="form-group">
                                    <select name="menu_id" id="menu_id" class="form-control">
                                        <option value="">Select Menu</option>
                                    </select>
                                </div> -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal EDIT DATA -->
                        <div class="modal fade" id="editSubmenu<?= $l['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newSubMenuModal">Edit Laporan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('laporan/edit') . $l['id'] ?>" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $l['nik'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <select name="menu_id" id="menu_id" class="form-control">
                                                    <option value="">Select Menu</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="<?= $l['alamat']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="<?= $l['status'] ?>"">
                                            </div>
                                            <div class=" form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                                    <label class="form-check-label" for="is_active">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
        </tbody>
    </table>
    <!-- </div> -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>