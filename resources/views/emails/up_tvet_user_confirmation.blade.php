<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengesahan Permohonan UP_TVET</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px; color: #1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 32px 28px; text-align: center;">
                <div style="display: inline-block; background-color: #f59e0b; color: #0f172a; font-weight: 800; font-size: 20px; padding: 6px 14px; border-radius: 8px; letter-spacing: 1px; margin-bottom: 12px;">
                    UP_TVET
                </div>
                <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.5px;">Pengesahan Permohonan UP_TVET</h1>
                <p style="color: #94a3b8; margin: 8px 0 0 0; font-size: 14px;">Portal Pengambilan Pelajar AceTVET</p>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 32px 28px;">
                <div style="background-color: #ecfdf5; border-left: 4px solid #10b981; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px;">
                    <p style="margin: 0; color: #065f46; font-size: 14px; font-weight: 600;">
                        ✅ Permohonan Kursus TVET Berjaya Direkodkan
                    </p>
                </div>

                <p style="font-size: 15px; line-height: 1.6; margin-top: 0;">
                    Salam sejahtera <strong>{{ $application->full_name }}</strong>,
                </p>
                <p style="font-size: 15px; line-height: 1.6; color: #475569;">
                    Terima kasih kerana telah melengkapkan permohonan kemasukan program TVET. Permohonan anda telah berjaya didaftarkan ke dalam sistem kami.
                </p>

                <!-- Details Box -->
                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 24px 0;">
                    <h3 style="margin-top: 0; margin-bottom: 14px; font-size: 15px; color: #0f172a; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                        Ringkasan Permohonan Anda
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="6" style="font-size: 14px;">
                        <tr>
                            <td style="color: #64748b; width: 40%;">Nama Pemohon:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->full_name }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Alamat E-mel:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->email }}</td>
                        </tr>
                        @if($application->ic_number)
                        <tr>
                            <td style="color: #64748b;">No. Kad Pengenalan:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->ic_number }}</td>
                        </tr>
                        @endif
                        @if($application->phone_number)
                        <tr>
                            <td style="color: #64748b;">No. Telefon:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->phone_number }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="color: #64748b;">Tarikh Dihantar:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->completed_at ? $application->completed_at->format('d/m/Y, h:i A') : now()->format('d/m/Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Status:</td>
                            <td>
                                <span style="background-color: #d1fae5; color: #065f46; font-size: 12px; font-weight: 700; padding: 3px 8px; border-radius: 4px;">
                                    Telah Lengkap
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <p style="font-size: 14px; line-height: 1.6; color: #475569;">
                    Pihak pentadbir institusi TVET sedang memproses maklumat permohonan anda. Sekiranya permohonan anda menepati syarat kelayakan, anda akan dihubungi melalui e-mel atau nombor telefon yang telah didaftarkan.
                </p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ config('app.url', 'http://127.0.0.1:8000') }}/dashboard" style="background-color: #f59e0b; color: #0f172a; text-decoration: none; padding: 12px 24px; font-weight: 700; font-size: 14px; border-radius: 8px; display: inline-block;">
                        Semak di Dashboard TVET
                    </a>
                </div>

                <p style="font-size: 12px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 18px; margin-bottom: 0;">
                    Jika anda mempunyai sebarang pertanyaan atau ingin mengemaskini maklumat, sila hubungi meja bantuan AceTVET.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #0f172a; padding: 20px; text-align: center; color: #94a3b8; font-size: 12px;">
                &copy; {{ date('Y') }} AceTVET. Hak Cipta Terpelihara.<br>
                Emel dijana secara automatik oleh Sistem Permohonan UP_TVET.
            </td>
        </tr>
    </table>
</body>
</html>
