# BLOG PAGE

This Blog Page is a web application for reading and exploring blog entries. Users can view blogs, search for specific topics, and navigate through paginated content.

## Features

- **Read Blogs:** Users can read blog entries with detailed information and images.
- **Search Functionality:** Search for blogs based on titles or content.
- **Pagination:** Navigate through multiple pages of blog entries.
- **Admin Dashboard:** Admin users can add, edit, and delete blogs.

## Technologies Used

- HTML
- CSS
- JS (JavaScript)
- PHP
- MySQL

## Setup Instructions

1. Clone the repository:

    ```bash
    git clone https://github.com/Sathvik-Murarishetty/Blog.git
    ```

2. Set up your database:

    - Create a new database named `blog`.
    - Import the provided SQL file (`blog.sql`) into your database.

3. Set up the project:

    - Move the project files to your web server directory (e.g., `htdocs` for XAMPP).

4. Access the application:

    - Open a web browser and navigate to `http://localhost/your-blog-folder`.

## Database Structure

The database includes the following tables:

- `blogs`: Stores blog entries with titles, content, images, date published, and author details.
- `users`: Stores user information, including admins who can publish blogs.

## Usage

### For Clients (Viewing Blogs):

1. **Explore Blogs:**
   - Navigate through the blog page to explore various blog entries.

2. **Search for Blogs:**
   - Use the search bar to find blogs based on titles or content.

3. **Pagination:**
   - Navigate through different pages to view more blog entries.

### For Admins (Publishing and Managing Blogs):

1. **Admin Login:**
   - Select "Admin" as the user type.
   - Enter your username and password.

2. **Admin Dashboard:**
   - View all blogs.
   - Add new blogs.
   - Edit existing blogs.
   - Delete blogs.

## Contributing

If you'd like to contribute to this project, please follow these guidelines.

1. Fork the project.
2. Create a new branch: `git checkout -b feature/your-feature-name`.
3. Commit your changes: `git commit -m 'Add new feature'`.
4. Push to the branch: `git push origin feature/your-feature-name`.
5. Submit a pull request.
