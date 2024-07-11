import React, { useEffect, useState } from 'react';
import api from '../services/api';

const Home = () => {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        api.get('/books')
            .then(response => {
                setBooks(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the books!', error);
            });
    }, []);

    return (
        <div>
            <h1>Books</h1>
            <ul>
                {books.map(book => (
                    <li key={book.id}>{book.title} by {book.author.name}</li>
                ))}
            </ul>
        </div>
    );
};

export default Home;
