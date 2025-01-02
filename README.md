# This system is in development. Do not use this for now!  
I will update the status when this panel is ready to use.   

# Important Info  
Main Branch has multiple packages  
Single Branch has single Package Support

# Setup The Project (In Development)  
Get Google Console OAuth Keys, make sure to Name it to your company  
```
https://console.cloud.google.com/apis/credentials
```
Run command to link storage with public folder  
```
php artisan storage:link
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
1. Install Wing In The server
2. In the Wing, create 50GB of Swap Space
3. Create Wing as a node on the panel 
    - Copy the config
    - Paste the config on Wing in /etc/pterodactyl/config.yml
    - Restart the Wings.servic
    - Check In Panel if Node is working
    - In Node setting, increase 'Maximum Web Upload Filesize'
4. Add Ports for the Wing 28015-28090
```
