The backend files are in the backend folder. Change the default Db details in the .env file.
To create the db and generate db fake user data , run php artisan migrate --seed
To run vite, use npm install && npm run dev
To run the app, use php artisan serve
To generate fresh tickets every minute and processed ones every 5 minutes, run php artisan schedule:work
Please note that the you must run both npm run dev and php artisan serve for the frontend to communicate with the endpoint api.
The reactjs frontend files are in the frontend folder.
To run the frontend, use npm install && npm start
