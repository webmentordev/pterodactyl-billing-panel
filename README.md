# This system is Ready to USE!  
This system is ready to use and is open-source. It currently supports a single package for orders. Stay tuned for updates to the main branch code. I will update the working info in the future.   

# Important Info  
Main Branch has multiple packages  
Single Branch has single Package Support

# Setup The Project (Ready for Production)  
Get Google Console OAuth Keys, make sure to Name it to your company  
```
https://console.cloud.google.com/apis/credentials
```
Run command to link storage with public folder  
```
php artisan storage:link
```  
# Billing Project Installation & Setup  
Follow these steps to properly this panel
### Setup Overall Queue Worker  
```
sudo nano /etc/systemd/system/laravel-worker.service
---------------------
[Unit]
Description=Overall Worker Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable laravel-worker
systemctl restart laravel-worker
```  
### Setup Reminder Queue Worker  
```
sudo nano /etc/systemd/system/reminder-queue.service
---------------------
[Unit]
Description=Reminder Emailing Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --queue=reminder --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable reminder-queue
systemctl restart reminder-queue
```  
### Setup Server Suspend Worker  
```
sudo nano /etc/systemd/system/suspend-queue.service
---------------------
[Unit]
Description=Server Suspend Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --queue=suspend --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable suspend-queue
systemctl restart suspend-queue
```  
### Setup Server Refund Worker  
```
sudo nano /etc/systemd/system/refund-queue.service
---------------------
[Unit]
Description=Refund Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --queue=refund --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable refund-queue
systemctl restart refund-queue
``` 
### Setup Server Emaling Worker  
```
sudo nano /etc/systemd/system/email-queue.service
---------------------
[Unit]
Description=Emailing Renew Reminder Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --queue=emailing --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable email-queue
systemctl restart email-queue
``` 
### Setup Trial order server Worker  
```
sudo nano /etc/systemd/system/trial-queue.service
---------------------
[Unit]
Description=Trial Server Job Queue
After=network.target

[Service]
User=root
Group=root
Restart=always
ExecStart=/usr/bin/php /var/www/laravel/artisan queue:work --queue=trial --env=production
WorkingDirectory=/var/www/laravel

[Install]
WantedBy=multi-user.target
---------------------
systemctl daemon-reload
systemctl enable trial-queue
systemctl restart trial-queue
``` 
### Setup Cronjob for Timed tasks  
```
sudo crontab -e
---------------------
* * * * * cd /var/www/laravel && php artisan schedule:run >> /dev/null 2>&1
---------------------
```  

# Panel Installation & Setup  
Follow these steps to properly setup Panel
```
1. Go to Application API and Generate API Key
2. Go to settings, update the company name
3. Add new Location in Panel
4. Delete All Nests in Nests tab
5. Create new Nest, name & description, then copy ID of Nest to .env
6. Go to Nest, Import Egg, select Egg, select next you created then save
7. Setup SMTP Credientials and Name in Emails in settings
8. Go to panel server in /var/www/pterodactyl/config/cors.php
    - Update explode(',', env('APP_CORS_ALLOWED_ORIGINS') ?? '') to 'allowed_origins' => ['your-complete-domain-here']
```
# Wing Installation & Setup  
Follow these steps to properly setup Wings
```
1. Install package: 
    - sudo apt-get install libgdiplus lib32gcc-s1
2. Install Wing In The server with Database Setup
3. In the Wing, create 32GB of Swap Space
4. Create Wing as a node on the panel 
    - Copy the config
    - Paste the config on Wing in /etc/pterodactyl/config.yml
    - Restart the Wings.servic
    - Check In Panel if Node is working
    - In Node setting, increase 'Maximum Web Upload Filesize'
5. Add Ports for the Wing / Node 28015-28090
6. Boost Server to Max Performance / GHz
    - sudo apt install cpufrequtils -y
    - sudo cpufreq-set -g performance
    - sudo apt install stress
    - stress --cpu 16 --timeout 30s
    - watch -n 1 "cat /proc/cpuinfo | grep 'MHz'"
7. Check RAM Requency / MHz
    - sudo dmidecode --type memory | grep -i "speed"
```
