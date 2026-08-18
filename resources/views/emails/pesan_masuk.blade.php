<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Masuk Baru</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }
        .header {
            background-color: #0f172a;
            padding: 32px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 32px;
        }
        .meta-box {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
            border: 1px solid #f1f5f9;
        }
        .meta-item {
            margin-bottom: 16px;
        }
        .meta-item:last-child {
            margin-bottom: 0;
        }
        .meta-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }
        .meta-value {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }
        .message-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }
        .message-body {
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            white-space: pre-line;
        }
        .footer {
            background-color: #f8fafc;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
            font-size: 12px;
            color: #64748b;
        }
        .btn {
            display: inline-block;
            background-color: #0284c7;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            margin-top: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan Masuk Baru</h1>
        </div>
        <div class="content">
            <p style="margin-top: 0; margin-bottom: 24px; font-size: 14px; line-height: 1.5; color: #475569;">
                Halo Admin Bakesbangpol, terdapat pesan masuk baru dari pengunjung website. Berikut detail pesannya:
            </p>
            
            <div class="meta-box">
                <div class="meta-item">
                    <span class="meta-label">Nama Pengirim</span>
                    <span class="meta-value">{{ $pesan->nama }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Alamat Email</span>
                    <span class="meta-value"><a href="mailto:{{ $pesan->email }}" style="color: #0284c7; text-decoration: none;">{{ $pesan->email }}</a></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Subjek</span>
                    <span class="meta-value">{{ $pesan->subjek }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Tanggal Kirim</span>
                    <span class="meta-value">{{ $pesan->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </div>

            <span class="message-title">Isi Pesan</span>
            <div class="message-body">{{ $pesan->pesan }}</div>
            
            <div style="text-align: center;">
                <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="btn" style="color: #ffffff;">Buka di Dashboard Admin</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Bakesbangpol Kabupaten Banyuwangi. All rights reserved.
        </div>
    </div>
</body>
</html>
