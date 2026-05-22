<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ToDo App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #011d47;
            background: #5d9fe0 url('https://www.transparenttextures.com/patterns/cubes.png');
            color: #333;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2);
        }

        .todo-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .todo-item {
            border-left: 5px solid #3b82f6;
            border-radius: 8px !important;
            margin-bottom: 12px;
            background-color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .todo-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .todo-item.completed {
            border-left-color: #10b981;
            background-color: #f9fafb;
            opacity: 0.85;
        }

        .custom-checkbox-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-checkbox-btn i {
            font-size: 12px;
            color: white;
            display: none;
        }

        input[type="checkbox"]:checked+.custom-checkbox-btn {
            background-color: #10b981;
            border-color: #10b981;
        }

        input[type="checkbox"]:checked+.custom-checkbox-btn i {
            display: block;
        }

        .nav-pills .nav-link {
            color: #4b5563;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 20px;
            transition: all 0.2s;
        }

        .nav-pills .nav-link.active {
            background-color: #4f46e5;
            color: #fff;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        }

        .btn-custom-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-custom-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">
                <i class="fas fa-check-double mr-2"></i>ListFlow
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <span class="nav-link text-white font-weight-medium">
                            <i class="fas fa-calendar-alt mr-1"></i> To-Do List Publik
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <div class="row mb-5 text-center">
            <div class="col-md-4 mb-3">
                <div class="card stat-card p-3 shadow-sm">
                    <h6 class="text-muted text-uppercase font-weight-bold">Total Tugas</h6>
                    <h2 class="font-weight-bold text-primary">{{ $todos->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card p-3 shadow-sm">
                    <h6 class="text-muted text-uppercase font-weight-bold">Belum Selesai</h6>
                    <h2 class="font-weight-bold text-warning">{{ $todos->where('is_completed', 0)->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card p-3 shadow-sm">
                    <h6 class="text-muted text-uppercase font-weight-bold">Selesai</h6>
                    <h2 class="font-weight-bold text-success">{{ $todos->where('is_completed', 1)->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card todo-card p-4">
                    <h5 class="font-weight-bold mb-4 text-dark">
                        <i class="fas fa-plus-circle text-primary mr-2"></i>Buat Tugas Baru
                    </h5>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('todos.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-muted small">NAMA TUGAS</label>
                            <input type="text" name="title" class="form-control form-control-lg"
                                placeholder="Contoh: Selesaikan modul 3" required style="border-radius: 8px;">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-muted small">CATATAN / DESKRIPSI</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Masukkan detail opsional..." style="border-radius: 8px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom-primary btn-block py-3">
                            <i class="fas fa-paper-plane mr-2"></i>Simpan Tugas
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card todo-card p-4">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                        <h5 class="font-weight-bold text-dark mb-3 mb-md-0">
                            <i class="fas fa-list text-primary mr-2"></i>Daftar Tugas
                        </h5>

                        <div class="input-group col-md-6 px-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"
                                    style="border-radius: 8px 0 0 8px;"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" id="searchInput" class="form-control border-left-0"
                                placeholder="Cari tugas..." style="border-radius: 0 8px 8px 0;">
                        </div>
                    </div>


                    <ul class="nav nav-pills mb-4">
                        <li class="nav-item">
                            <a class="nav-link active filter-btn" data-filter="all" href="#"><i
                                    class="fas fa-th-large mr-1"></i> Semua</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link filter-btn" data-filter="pending" href="#"><i
                                    class="fas fa-hourglass-half mr-1"></i> Pending</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link filter-btn" data-filter="completed" href="#"><i
                                    class="fas fa-check-circle mr-1"></i> Selesai</a>
                        </li>
                    </ul>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between small text-muted font-weight-bold mb-1">
                            <span>PROGRESS SELESAI</span>
                            <span id="progressBarPercent">0%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 5px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                id="progressBar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>

                    <div id="todoListContainer">
                        @if($todos->isEmpty())
                            <div class="text-center py-5">
                                <h6 class="font-weight-bold text-muted">Belum ada tugas di daftar Anda!</h6>
                            </div>
                        @else
                            <div class="list-group">
                                @foreach($todos as $todo)
                                    <div class="list-group-item todo-item d-flex align-items-center justify-content-between p-3 {{ $todo->is_completed ? 'completed' : '' }}"
                                        data-status="{{ $todo->is_completed ? 'completed' : 'pending' }}">

                                        <div class="d-flex align-items-center flex-grow-1">
                                            <form action="{{ route('todos.update', $todo->id) }}" method="POST"
                                                class="d-inline mr-3">
                                                @csrf
                                                @method('PUT')
                                                <label class="mb-0">
                                                    <input type="checkbox" name="is_completed" onchange="this.form.submit()"
                                                        class="d-none" {{ $todo->is_completed ? 'checked' : '' }}>
                                                    <div class="custom-checkbox-btn">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                </label>
                                            </form>

                                            <div>
                                                <h6 class="todo-title mb-0 font-weight-bold"
                                                    style="{{ $todo->is_completed ? 'text-decoration: line-through; color: #9ca3af !important;' : '' }}">
                                                    {{ $todo->title }}
                                                </h6>
                                                @if($todo->description)
                                                    <small class="todo-desc text-muted d-block">{{ $todo->description }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    style="border-radius: 8px;"
                                                    onclick="return confirm('Hapus tugas ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            // 1. FUNGSI LIVE SEARCH (Pencarian Instan)
            $('#searchInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('.filter-btn').removeClass('active');
                $('.filter-btn[data-filter="all"]').addClass('active');

                $('.todo-item').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                calculateProgress();
            });

            // 2. FUNGSI PEMILAHAN DAFTAR TUGAS (Semua, Pending, Selesai)
            $('.filter-btn').on('click', function (e) {
                e.preventDefault();

                $('.filter-btn').removeClass('active');
                $(this).addClass('active');

                var filter = $(this).data('filter');

                if (filter === 'all') {
                    $('.todo-item').fadeIn(200);
                } else {
                    $('.todo-item').hide();
                    $('.todo-item[data-status="' + filter + '"]').fadeIn(200);
                }
            });

            // 3. FUNGSI OTOMATIS PROGRESS BAR
            function calculateProgress() {
                var totalTasks = $('.todo-item').length;
                if (totalTasks === 0) {
                    $('#progressBar').css('width', '0%');
                    $('#progressBarPercent').text('0%');
                    return;
                }
                var completedTasks = $('.todo-item.completed').length;
                var percentage = Math.round((completedTasks / totalTasks) * 100);

                $('#progressBar').css('width', percentage + '%');
                $('#progressBarPercent').text(percentage + '%');
            }

            calculateProgress();
        });
    </script>
</body>

</html>