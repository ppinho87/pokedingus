# Interactive-Website
A modern, responsive web application designed for trading card game (TCG) vendors to showcase inventory, manage products, and provide customers with a seamless online shopping experience. The platform focuses on clean design, fast performance, and an intuitive user experience, making it easy for collectors and players to browse, search, and purchase cards and sealed products.

---

### SMTP configuration (.env)

To enable SMTP delivery (used by public/php/send.php via PHPMailer), create a file named `.env` in the project root (next to package.json) with the following variables.

Example — Gmail (use an app password, not your regular account password):

SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=your@gmail.com
SMTP_PASS=your_app_password
SMTP_SECURE=tls

Example — SendGrid:

SMTP_HOST=smtp.sendgrid.net
SMTP_PORT=587
SMTP_USER=apikey
SMTP_PASS=your_sendgrid_api_key
SMTP_SECURE=tls

Notes:
- Place the `.env` file in the project root. The loader at `public/php/load_env.php` reads it automatically when the contact form is submitted.
- Do NOT commit `.env` to version control. Add it to your `.gitignore`.
- Ensure PHP has the OpenSSL extension enabled for TLS/SSL SMTP connections.
- If using Gmail, create an App Password and use that as SMTP_PASS. Google no longer accepts plain account passwords for less-secure apps.

After adding the `.env`, test the contact form and check the HTTP response and server logs for any errors.

### Technologies used

- Node.js
- React

### Built With

* Intellij - Text Editor

### Copyright

Paul Pinho © 2018. All Rights Reserved.