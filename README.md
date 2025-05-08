![Screenshot 2025-05-08 014655](https://github.com/user-attachments/assets/0e4b0ccb-1c67-4e63-a2ee-e73d447f7315)# 🌍🗺️📖Traveler Memory Map

Traveler Memory Map is a web application built using Laravel that allows users to save and visualize their travel memories on an interactive map. 
Users can add memories with locations, photos, and descriptions, and view them as markers on the map.

## Features

- Add new travel memories with title, description, location, and photos.
- Interactive map to visualize travel memories.
- Filter memories by year.
- Display markers with user-uploaded images.
- Responsive design with a modern UI.
- Year-wise filtering for better navigation.

## Installation Instructions

### Step 1: Clone the Repository
```bash
git clone https://github.com/yahuaiii0923/traveler-memory-map
cd traveler-memory-map
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install JavaScript Dependencies
```bash
npm install
npm run dev
```

### Step 4: Copy Environment File
```bash
cp .env.example .env
```

### Step 5: Generate the Application Key
```bash
php artisan key:generate
```

## Configuration and Setup

### Step 6: Database Configuration
This project uses MySQL. Update the `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=traveler_map_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 7: Run Migrations
```bash
php artisan migrate
```

### Step 8: Seed the Database
```bash
php artisan db:seed
```

### Step 9: Link Storage (For Uploaded Images)
```bash
php artisan storage:link
```

## Running the Application

### Step 10: Start the Laravel Development Server
```bash
php artisan serve
```
Access the application at `http://127.0.0.1:8000`.

## Usage Instructions

### Adding a New Memory
1. Click the **"+" button** on the map.
2. Fill out the memory details: Title, Description, Location, and Photos.
3. Click **"Save"**.

### Viewing Memories
- All saved memories will appear as markers on the map.
- Click on a marker to view the memory details.

### Filtering Memories by Year
- Use the year filter at the bottom to view memories from a specific year.

## Screenshots

### Home Page
![WhatsApp Image 2025-05-08 at 09 03 31_d8bc1581](https://github.com/user-attachments/assets/91a7212e-0930-498b-884c-c9e695fcc234)


### Adding a Memory
![WhatsApp Image 2025-05-08 at 07 51 52_cfaf3361](https://github.com/user-attachments/assets/c3962163-6c08-400f-92ba-202490f70657)


## Troubleshooting

### Issue: Images Not Showing on Map
- Ensure you have run the storage link command:
  ```bash
  php artisan storage:link
  ```
- Verify that your images are stored in the `public/storage` directory.
- Check the image URL in your browser:
  ```
  http://127.0.0.1:8000/storage/images/your_image.jpg
  ```

### Issue: Map Markers Not Displaying
- Check the browser console for errors.
- Make sure your API key is correctly set in the `.env` file:
  ```
  GOOGLE_MAPS_API_KEY=your_api_key
  ```

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature_branch
   ```
3. Make your changes and commit:
   ```bash
   git commit -m "Add new feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature_branch
   ```
5. Create a Pull Request.

## License

This project is licensed under the MIT License.

## Acknowledgments

- Laravel Documentation: [Laravel](https://laravel.com/)
- Google Maps API: [Google Maps](https://developers.google.com/maps)
- Authors:
  - **Siew Ya Huai** - [GitHub](https://github.com/yahuaiii0923)
  - **Priyanka Achoki** - [GitHub](https://github.com/Priachoki)
