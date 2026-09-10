<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - IT Helpdesk Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        .header {
            background: #166534;
            color: white;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .header p {
            margin-top: 5px;
            font-size: 13px;
            opacity: 0.9;
        }

        .admin-info {
            text-align: right;
            font-size: 14px;
        }

        .container {
            padding: 30px 35px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 30px;
            font-weight: bold;
        }

        .pending {
            color: #d97706;
        }

        .section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .section h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        th {
            background: #f9fafb;
            color: #374151;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #6b7280;
        }

        @media (max-width: 800px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }

            .header {
                padding: 18px 20px;
            }

            .section {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <div>
        <h1>IT Helpdesk Gateway</h1>
        <p>Admin / Management Dashboard</p>
    </div>

    <div class="admin-info">
    <div>Administrator</div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 8px;">
        @csrf
        <button type="submit">
            Logout
        </button>
        </form>
    </div>
</header>

<main class="container">

    <div class="welcome">
        <h2>Dashboard Admin</h2>
        <p>Kelola pengguna dan aktivitas sistem IT Helpdesk.</p>
    </div>

    <div class="stats">

        <div class="stat-card">
            <div class="label">User Menunggu Persetujuan</div>

            <div class="number pending">
                {{ $pendingUsers->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="label">Total User</div>

            <div class="number">
                {{ \App\Models\User::where('role_id', 1)->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="label">Total Admin / IT Support</div>

            <div class="number">
                {{ \App\Models\User::whereIn('role_id', [2, 3])->count() }}
            </div>
        </div>

    </div>

    <div class="section">

        <h3>User Menunggu Persetujuan</h3>

        @if ($pendingUsers->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Office</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($pendingUsers as $user)

                        <tr>
                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->office_id }}</td>

                            <td>{{ $user->department_id }}</td>

                            <td>
                                <span class="status">
                                    Pending
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                                 @csrf
                                <button type="submit">Approve</button>
                                </form>

                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" style="display:inline;">
                                 @csrf
                                <button type="submit">Reject</button>
                                </form>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">
                Tidak ada user yang menunggu persetujuan.
            </div>

        @endif

    </div>

</main>

</body>
</html>
