1. Download and install a recent version of XAMPP at https://www.apachefriends.org/download.html.

2. Clone this repo to the empty htdocs folder, or paste the contents of downloaded zip file there.

3. The teachersdatabase.sql file includes the full database along with some dummy data. Please go to localhost/phpmyadmin, create a "teachersdatabase" schema, and use the included sql file to import the database.

4. You can now access the website through localhost in your browser.

5. You can add users of type "student" and "tutor" through the registration pages (by filling the resgistration forms then approving the accounts from the admin account). However, admin accounts are not created on the website and are manually added to the database if needed.
There is one admin account in the dummy data. You can access it by logging in with the following credentials:
email: "admin@teachers.edu"
password: "Adm1nAcc0unt!"
without the quotes.

Moreover, please note that you can always test any other existing student/tutor accounts, and that is by using the Forgot Password feature. Just make sure you type in the email of the account you want on the login page and then click "Forgot password". If you did not set configure XAMPP to send emails, you can simply access the verification code in the database under the temp_codes table (use the "code" value of the most recent row).