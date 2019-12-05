## System Installation Manual 

I. System Requirements
    
    Hardware Requirements
        Processor               Intel Core i5 or higher
        Memory                  4 GB RAM or higher
        SSD/HDD                 1 GB Disk Space
        Processor Type          64 bit
        Processor Speed         2.60 Ghz or higher

    Software Requirements
        PHP                     ver. 7.1.33 or higher
        Web Server              Apache ver. 2.4.41
        MySQL                   ver. 10.    4.8
        Git Bash                ver. 2.20
        Composer                ver. 1.8.0
        OS                      Windows

**Default Account**

	Email Address: admin@gmail.com

	Password: password

II. Installation

    Step 1. Download and install the latest version of XAMPP on their website
		(https://www.apachefriends.org/download.html).

    Step 2. Open a web browser and go to https://git-scm.com/downloads, choose the OS that matches your machine
		then download and install git bash.

    Step 3. Go to https://getcomposer.org/download/, download and install composer in your machine.

    Step 4. After installing XAMPP, go to the location where the XAMPP folder is located and open the file
        named xampp-control.exe.

    Step 5. A windows will appear. Click on Start Apache and MySQL.

    Step 6. Go to https://github.com/gshockxd/Amplifier-repo on your web browser, click "clone or download"
        and copy link below clone with HTTPS.

    Step 7. Once the URL is copied, open Git Bash and change the directory by typing the command "cd" and the
        directory as to where "xampp/htdocs" (e.g. "cd C:/xampp/htdocs) is located and press ENTER. Write the
        command "git clone" and past the URL you just copied by pressing SHIFT + ENTER on your keyboad and
        hit ENTER.

    Step 8. Once the clone is complete, write a command "cd project-folder" (e.g. cd Amplifier-repo).

    Step 9. Open your web browser and type the url "localhost" and locate the project folder
        "Amplifier-repo".

    Step 10. Open new tab by pressing CTRL + T and type "localhost/phpmyadmin" in your web browser, click
        "Databases", create new database name "Amplifier", select collation type as "utf8mb4_general_ci".
    
    Step 11. Click "Import", Click "Choose file" and find SQL file name "amplifier.sql" under
        "Amplifier-repo/sql" and scroll on the bottom of the page and hit GO.

    Step 12. Go to application/config.php;

    Step 13. Under line 28 - 37, change the $config['base_url'] = 'http://<SERVER_NAME>/<FOLDER>/>';
    