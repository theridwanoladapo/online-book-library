# Online Book Library

A responsive web application for managing an online book library using a RESTful API. This project includes features for managing books and authors, user authentication, and search functionality.

## Features
- Manage Books (Create, Retrieve, Update, Delete)
- Manage Authors (Create, Retrieve, Update, Delete)
- User Authentication
- Search Functionality

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/online-book-library.git
   ```
2. Navigate to the project directory:
    ```bash
    cd online-book-library
    ```
3. Install Dependencies:
    ```bash
    composer install
    ```
    Navigate to the project frontend directory and install dependencies
    ```bash
    cd frontend
    npm install
    ```
4. Set up environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Configure the database settings in the .env file.
6. Run database migrations:
    ```bash
    php artisan migrate
    ```
7. Start the development server:
    ```bash
    php artisan serve
    ```
    Navigate to the frontend and run development 
    ```bash
    npm run dev
    ```
To run the tests, execute the following command:
```bash
php artisan test 
```

## Usage

- Open your browser and navigate to `http://localhost:3000`.

## API Documentation
### Books API Endpoints
1. **GET /api/books**
- **Description**: Retrieve a list of all books.
- **Request**:
    - Method: **GET**
    - URL: `/api/books`
    - Authentication: Required (JWT)
- **Response**:
    - **200 OK**
    ```bash
    [
        {
            "id": 1,
            "title": "Book Title",
            "description": "Book Description",
            "author": {
                "id": 1,
                'name': 'Author Name',
                'email': 'author@example.com',
                'biography': 'Author Biography'
            },
        },
    ...
    ]
    ```
2. **POST /api/books**
- **Description**: Create a new book.
- **Request**:
    - Method: **POST**
    - URL: `/api/books`
    - Authentication: Required (JWT)
    - Body Parameters:
    ```bash
    {
        "title": "Book Title",
        "author_id": 1,
        "description": "Book Description"
    }
    ```
- **Response**:
    - **201 Created**
    ```bash
    {
        "id": 1,
        "title": "Book Title",
        "author_id": 1,
        "description": "Book Description"
    }
    ```
3. **GET /api/books/{id}**
- **Description**: Retrieve a specific book.
- **Request**:
    - Method: **GET**
    - URL: `/api/books/{id}`
    - Authentication: Required (JWT)
- **Response**:
    - **200 OK**
    ```bash
    {
        "id": 1,
        "title": "Book Title",
        "author_id": 1,
        "description": "Book Description"
    }
    ```
4. **PUT/PATCH /api/books/{id}**
- **Description**: Update a specific book.
- **Request**:
    - Method: **PUT/PATCH**
    - URL: `/api/books/{id}`
    - Authentication: Required (JWT)
    - Body Parameters:
    ```bash
    {
        "title": "Updated Book Title",
        "author_id": 1,
        "description": "Updated Book Description"
    }
    ```
- **Response**:
    - **200 OK**
    ```bash
    {
        "id": 1,
        "title": "Updated Book Title",
        "author_id": 1,
        "description": "Updated Book Description"
    }
    ```
5. **DELETE /api/books/{id}**
**Description**: Delete a specific book.
**Request**:
    - Method: **DELETE**
    - URL: `/api/books/{id}`
    - Authentication: Required (JWT)
**Response**:
    - **204 No Content**

### Authors API Endpoints
1. **GET /api/authors**
- **Description**: Retrieve a list of all authors.
- **Request**:
    - Method: **GET**
    - URL: `/api/authors`
    - Authentication: Required (JWT)
- **Response**:
    - **200 OK**
    ```bash
    [
        {
            "id": 1,
            'name': 'Author Name',
            'email': 'author@example.com',
            'biography': 'Author Biography'
        },
    ...
    ]
    ```
2. **POST /api/authors**
- **Description**: Create a new book.
- **Request**:
    - Method: **POST**
    - URL: `/api/authors`
    - Authentication: Required (JWT)
    - Body Parameters:
    ```bash
    {
        'name': 'Author Name',
        'email': 'author@example.com',
        'biography': 'Author Biography'
    }
    ```
- **Response**:
    - **201 Created**
    ```bash
    {
        "id": 1,
        "name": "Author Name",
        "email": "author@example.com",
        "biography": "Author Biography"
    }
    ```
3. **GET /api/authors/{id}**
- **Description**: Retrieve a specific book.
- **Request**:
    - Method: **GET**
    - URL: `/api/authors/{id}`
    - Authentication: Required (JWT)
- **Response**:
    - **200 OK**
    ```bash
    {
        "id": 1,
        "name": "Author Name",
        "email": "author@example.com",
        "biography": "Author Biography"
    }
    ```
4. **PUT/PATCH /api/authors/{id}**
- **Description**: Update a specific book.
- **Request**:
    - Method: **PUT/PATCH**
    - URL: `/api/authors/{id}`
    - Authentication: Required (JWT)
    - Body Parameters:
    ```bash
    {
        "name": "Updated Author Name",
        "email": "author@example.com",
        "biography": "Updated Author Biography"
    }
    ```
- **Response**:
    - **200 OK**
    ```bash
    {
        "id": 1,
        "name": "Updated Author Name",
        "email": "author@example.com",
        "biography": "Updated Author Biography"
    }
    ```
5. **DELETE /api/authors/{id}**
**Description**: Delete a specific book.
**Request**:
    - Method: **DELETE**
    - URL: `/api/authors/{id}`
    - Authentication: Required (JWT)
**Response**:
    - **204 No Content**

