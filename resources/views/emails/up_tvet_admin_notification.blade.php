<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Admin - Permohonan Baharu UP_TVET</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px; color: #1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 32px 28px; text-align: center;">
                <div style="display: inline-block; background-color: #3b82f6; color: #ffffff; font-weight: 800; font-size: 14px; padding: 5px 12px; border-radius: 6px; letter-spacing: 1px; margin-bottom: 12px; text-transform: uppercase;">
                    Panel Pentadbir AceTVET
                </div>
                <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.5px;">Permohonan Baharu TVET</h1>
                <p style="color: #94a3b8; margin: 8px 0 0 0; font-size: 14px;">Borang Permohonan Kursus TVET Telah Dihantar</p>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 32px 28px;">
                <div style="background-color: #eff6ff; border-left: 4px solid #3b82f6; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px;">
                    <p style="margin: 0; color: #1e40af; font-size: 14px; font-weight: 600;">
                        📢 Makluman Pentadbir: Permohonan Baharu Diterima
                    </p>
                </div>

                <p style="font-size: 15px; line-height: 1.6; margin-top: 0;">
                    Salam sejahtera Pentadbir,
                </p>
                <p style="font-size: 15px; line-height: 1.6; color: #475569;">
                    Seorang pemohon telah selesai mengisi dan menghantar borang permohonan kemasukan <strong>UP_TVET Perdana</strong> secara terus ke dalam sistem.
                </p>

                <!-- Applicant Summary Box -->
                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 24px 0;">
                    <h3 style="margin-top: 0; margin-bottom: 14px; font-size: 15px; color: #0f172a; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                        Maklumat Pemohon
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="6" style="font-size: 14px;">
                        <tr>
                            <td style="color: #64748b; width: 40%;">Nama Penuh:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->full_name }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Alamat E-mel:</td>
                            <td style="color: #0f172a; font-weight: 600;">
                                <a href="mailto:{{ $application->email }}" style="color: #2563eb; text-decoration: none;">{{ $application->email }}</a>
                            </td>
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
                            <td style="color: #0f172a; font-weight: 600;">
                                <a href="tel:{{ $application->phone_number }}" style="color: #2563eb; text-decoration: none;">{{ $application->phone_number }}</a>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td style="color: #64748b;">Tarikh Disahkan:</td>
                            <td style="color: #0f172a; font-weight: 600;">{{ $application->completed_at ? $application->completed_at->format('d/m/Y, h:i A') : now()->format('d/m/Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b;">Status Semasa:</td>
                            <td>
                                <span style="background-color: #dbeafe; color: #1e40af; font-size: 12px; font-weight: 700; padding: 3px 8px; border-radius: 4px;">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                        </tr>
                        @if($application->notes)
                        <tr>
                            <td style="color: #64748b; vertical-align: top;">Catatan:</td>
                            <td style="color: #334155;">{{ $application->notes }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div style="text-align: center; margin: 30px 0; display: flex; justify-content: center; gap: 12px;">
                    <a href="{{ config('app.url', 'http://127.0.0.1:8000') }}/admin/up-tvet" style="background-color: #0f172a; color: #ffffff; text-decoration: none; padding: 12px 24px; font-weight: 700; font-size: 14px; border-radius: 8px; display: inline-block;">
                        Buka Senarai Pemohon Kursus TVET
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #0f172a; padding: 20px; text-align: center; color: #94a3b8; font-size: 12px;">
                &copy; {{ date('Y') }} AceTVET - Admin Notification System.<br>
                Emel automatik daripada sistem.
            </td>
        </tr>
    </table>
</body>
</html>
