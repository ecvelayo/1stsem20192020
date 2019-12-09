1.1	System Requirements
1.1.1 Hardware Requirements
•	Android Phone
•	Internet Connection
       1.1.2 Software Requirements
•	Google Play Store

1.2	Installation
•	Sign in to your Google Account.
•	Search and download the Coche or Coche Partner Application from Google Play Store.
•	Install the Application


USER MANUAL

1.	Open the xampp control panel then start Apache and MySQL Buttons.

2.	Creating a local domain for Laravel so it doesn’t have to type ‘php artisan serve’ on cmd in order to do that, modifying the hosts file of Windows located in C:\Windows\System32\drivers\etc\hosts in Administrator rights, otherwise it would not be able to save changes. Then add the host using a custom host on the system, in this case an alias of coche.localhost.

3.	Then, configure the virtual host appending the following snippet at the end of the content of the httpd.conf	file located in the xampp folder \xampp\apache\conf\extra	.



4.	Visit the project from browser, coche.localhost.


5.	Lastly, log in to the Admin Account.




COCHE PARTNER APP

1.	Open the CochePartner application.




2.	Then register as a Car service company with the choices that are Carwash, Repair or Tow.



3.	After submitting the form, the car service company would wait for the Admin’s Approval.

4.	After it has been approved, log in to the account. 


5.	The Reservation panel shows how many vehicle owners have reserved to accept it or decline.



6.	The Approved panel shows the complete and decline.


7.	The Profile panel shows the transactions.


8.	That can also add a service.



9.	Edit the profile

 
10.	And Logout.


 

COCHE APP

This app is for Vehicle Owners, they can login and register with Facebook and Google social logins. 

Selecting Continue with Facebook, there will be popups that will ask for permission.


        

By pressing Allow, the Vehicle Owner permits the application to use these actions that will be needed by the Vehicle Owner.






1. Repair Tab

 


After logging in with Facebook or Google, the Vehicle Owner will be automatically be redirected to the Repair Tab.

1. Repair Tab – on this tab, the Vehicle Owner can Reserve for Repair Services and Locate the nearest auto repair companies. 

2. Carwash Tab – on this tab, the Vehicle Owner can Reserve for Carwash Services and Locate the nearest carwash companies.

3. Tow Tab – on this tab, the Vehicle Owner can Locate the nearest Tow Company and can contact the company’s number.

4. Profile Tab – on this tab, the Vehicle Owner can Edit/Update his information and view Recent Transactions. 
 








      
Screen 1            Screen 2				Screen 3

1)	Pin Location –  the application, with permission, will know the Vehicle Owner’s location (shown with the Pin Locator) with Google Map on Screen 1. 

2)	Book A Repair Service – By clicking Reserve, the page will pop for the Vehicle Owner to select which vehicle to choose by its plate number. After clicking Submit on Screen 2, it will now redirect to Screen 3 to select the desired Date, Time and type of repair service. After selecting, it will redirect it with the selected company to pay the repair services and fees.






3)	Payment Method – clicking the PAY NOW will redirect the Vehicle Owner to the payment method screen.














       

Screen 	1				  Screen 2					Screen 3

4)	Payment Method  – By clicking Pay with Paypal on Screen 1, it will redirect to Screen 2 to login with the Vehicle Owner’s Paypal account. After clicking Log In, it will redirect it to Screen 3 with the amount to be paid. By clicking Pay, it will redirect it to the Repair Tab.


5)	Successfully Reserved Notification – after payment, the application will toast a message that the reservation was successful on the Repair Tab. 


















Screen 2				Screen 3			    	Screen 1

6)	Cancel Reservation – By clicking Cancel on Screen 1 a dialogue box will appear asking for confirmation of the cancellation on Screen 2. After selecting YES, it will then redirect to Screen 3, toasting a message that the cancellation is successful.


2. Carwash Tab

       
Screen 1				Screen 2					Screen 3

1)	Pin Location –  the application, with permission, will know the Vehicle Owner’s location (shown with the Pin Locator) with Google Map on Screen 1. 

2)	Book A Carwash Service – Select date for the reservation on Screen 2. After clicking OK, the dialogue will close and redirect back to Carwash Tab to select the nearest Carwash Company on Screen 3. By clicking Reserve on the selected company, a new dialogue box will appear that is on Screen 4. 

On Screen 4, select the needed details on each drop down (plate number, type of carwash service and the time selected) . After clicking Submit it will redirect on the Carwash Tab and will toast a message that it was successfully reserved.



Screen 4

          
Screen 1								Screen 2

3)	Successfully Reserved Notification – after payment, the application will toast a message that the reservation was successful back on the Carwash Tab (Screen1). It will also still need to be approved on the CochePartner application. After approving, on Screen 2, the Vehicle Owner can now pay after pressing PAY NOW. Upon approval, the Carwash Company will notify the vehicle owner via SMS and will remind about payment.

4)	Payment Method – by clicking the PAY NOW on Screen 2, it will redirect the Vehicle Owner to the payment method screen.

       

Screen 	1				  Screen 2					Screen 3

5)	Payment Method  – By clicking Pay with Paypal on Screen 1, it will redirect to Screen 2 to login with the Vehicle Owner’s Paypal account. After clicking Log In, it will redirect it to Screen 3 with the amount to be paid. By clicking Pay, it will redirect it to the Repair Tab.

       
Screen 1					Screen 2				Screen 3

6)	Cancel Reservation – By clicking Cancel on Screen 1 a dialogue box will appear asking for confirmation of the cancellation on Screen 2. After selecting YES, it will then redirect to Screen 3, toasting a message that the cancellation is successful. Including a reminder that there is a penalty for cancellation which is P50.00.





3.  Tow Tab

       
Screen 1					Screen 2				Screen 3

1) Find the nearest Tow Company  – after clicking the Tow Tab on Screen 1, it will directly find the nearest tow company from the Vehicle Owner’s location as seen on Screen 2. By clicking Accept it will automatically contact and call the nearest tow company. 



4. Profile Tab


     
Screen 1							Screen 2

1) View Recent Transactions  – by clicking the Profile Tab, the Vehicle Owner can view the recent transactions including the Date, service selected, selected company and the status of the reservation. The Vehicle Owner can add a new vehicle with its Car Brand, Model and Plate number.


