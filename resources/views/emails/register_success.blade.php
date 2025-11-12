<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil di RBY</title>
  </head>
  <body style="font-family: 'Poppins', Arial, sans-serif; background-color: #f4f6f8; padding: 0; margin: 0;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" style="padding: 30px 15px;">
          <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            
            <!-- Header -->
            <tr>
              <td align="center" style="background: linear-gradient(90deg, #007bff, #00b4d8); padding: 30px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 0.5px;">
                  🎉 Selamat Datang di <strong>RBY</strong>!
                </h1>
              </td>
            </tr>

            <!-- Body -->
            <tr>
              <td style="padding: 40px 30px; color: #333333;">
                <h2 style="margin-top: 0; color: #007bff;">Halo, {{ $username }} 👋</h2>
                <p style="font-size: 16px; line-height: 1.6;">
                  Registrasi kamu di <strong>RBY</strong> telah berhasil! 🎊<br>
                  Silakan login menggunakan akun yang sudah kamu daftarkan untuk mulai menggunakan sistem.
                </p>

                <div style="text-align: center; margin: 35px 0;">
                  <a href="{{ url('/login') }}" 
                     style="background-color: #007bff; color: #ffffff; text-decoration: none; 
                            padding: 12px 25px; border-radius: 6px; font-weight: bold; 
                            display: inline-block;">
                    🔐 Login Sekarang
                  </a>
                </div>

                <p style="font-size: 15px; color: #555;">
                  Jika kamu tidak merasa mendaftar akun ini, abaikan saja email ini.
                </p>
              </td>
            </tr>

            <!-- Footer -->
            <tr>
              <td align="center" style="background-color: #f1f3f5; padding: 20px;">
                <p style="margin: 0; font-size: 14px; color: #777;">
                  Terima kasih,<br>
                  <strong>Tim RBY</strong>
                </p>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
